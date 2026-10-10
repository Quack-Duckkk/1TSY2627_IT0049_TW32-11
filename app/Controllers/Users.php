<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\SaleModel;

class Users extends BaseController
{
    // Same rule for Create and Edit: JPG, PNG, WebP; max 2MB
    private function avatarRule(): string
    {
        return 'uploaded[avatar]'
            . '|max_size[avatar,2048]'
            . '|mime_in[avatar,image/jpeg,image/png,image/webp]'
            . '|ext_in[avatar,jpg,jpeg,png,webp]'
            . '|is_image[avatar]';
    }

    // Moves the file to public/uploads, makes it 150x150, returns filename only.
    private function saveAvatar($avatar): string
    {
        $extension = match ($avatar->getMimeType()) {
            'image/jpeg' => 'jpg',
            'image/png'  => 'png',
            'image/webp' => 'webp',
        };

        $newName = bin2hex(random_bytes(16)) . '.' . $extension;

        $avatar->move(FCPATH . 'uploads', $newName);

        service('image')
            ->withFile(FCPATH . 'uploads/' . $newName)
            ->fit(150, 150, 'center')
            ->save(FCPATH . 'uploads/' . $newName);

        return $newName;
    }

    // Deletes an old avatar file from disk (safe if it is missing)
    private function deleteAvatarFile(?string $filename): void
    {
        if (! empty($filename)) {
            $path = FCPATH . 'uploads/' . basename($filename);

            if (is_file($path)) {
                unlink($path);
            }
        }
    }

    public function index()
    {
        $model = new UserModel();

        return view('users/index', [
            'users' => $model->findAll(),
        ]);
    }

    public function new()
    {
        return view('users/new');
    }

    public function create()
    {
        $rules = [
            'username'         => 'required|min_length[3]|max_length[50]|is_unique[users.username]',
            'full_name'        => 'required|min_length[3]|max_length[100]',
            'password'         => 'required|min_length[8]',
            'password_confirm' => 'required|matches[password]',
        ];

        $avatar  = $this->request->getFile('avatar');
        $hasFile = $avatar !== null && $avatar->getError() !== UPLOAD_ERR_NO_FILE;

        if ($hasFile) {
            $rules['avatar'] = $this->avatarRule();
        }

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput();
        }

        $data = [
            'username'   => $this->request->getPost('username'),
            'full_name'  => $this->request->getPost('full_name'),
            'password'   => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'created_at' => date('Y-m-d H:i:s'),
        ];

        if ($hasFile) {
            $data['avatar'] = $this->saveAvatar($avatar);
        }

        (new UserModel())->insert($data);

        return redirect()->to('/users');
    }

    public function edit($id)
    {
        $model = new UserModel();
        $user  = $model->find($id);

        if (! $user) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('users/edit', ['user' => $user]);
    }

    public function update($id)
    {
        $model = new UserModel();
        $user  = $model->find($id);

        if (! $user) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $rules = [
            'username'         => "required|min_length[3]|max_length[50]|is_unique[users.username,id,{$id}]",
            'full_name'        => 'required|min_length[3]|max_length[100]',
            'password'         => 'permit_empty|min_length[8]',
            'password_confirm' => 'matches[password]',
        ];

        $avatar  = $this->request->getFile('avatar');
        $hasFile = $avatar !== null && $avatar->getError() !== UPLOAD_ERR_NO_FILE;

        if ($hasFile) {
            $rules['avatar'] = $this->avatarRule();
        }

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput();
        }

        $data = [
            'username'  => $this->request->getPost('username'),
            'full_name' => $this->request->getPost('full_name'),
        ];

        $newPassword = $this->request->getPost('password');

        if ($newPassword !== null && $newPassword !== '') {
            $data['password'] = password_hash($newPassword, PASSWORD_DEFAULT);
        }

        if ($hasFile) {
            $data['avatar'] = $this->saveAvatar($avatar);
            $this->deleteAvatarFile($user['avatar'] ?? null);
        }

        $model->update($id, $data);

        return redirect()->to('/users');
    }

    public function delete($id)
    {
        $model = new UserModel();
        $user  = $model->find($id);

        if (! $user) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        if ((int) $id === (int) session()->get('user_id')) {
            return redirect()->to('/users')
                ->with('error', "You can't delete your own account while you're logged in.");
        }

        $salesCount = (new SaleModel())
            ->where('sold_by', $id)
            ->countAllResults();

        if ($salesCount > 0) {
            return redirect()->to('/users')
                ->with('error', "Can't delete {$user['username']}: they recorded {$salesCount} sale(s).");
        }

        $this->deleteAvatarFile($user['avatar'] ?? null);
        $model->delete($id);

        return redirect()->to('/users')
            ->with('success', "{$user['username']} was deleted.");
    }
}