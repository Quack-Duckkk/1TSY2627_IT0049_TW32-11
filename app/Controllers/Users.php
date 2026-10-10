<?php

namespace App\Controllers;

use App\Models\UserModel;

class Users extends BaseController
{
    public function index()
    {
        $model = new UserModel();

        $data = [
            'users' => $model->findAll(),
        ];

        return view('users/index', $data);
    }

    public function new()
    {
        return view('users/new');
    }

    public function create()
    {
        $rules = [
            'username'  => 'required|min_length[3]|max_length[50]|is_unique[users.username]',
            'full_name' => 'required|min_length[3]|max_length[100]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput();
        }

        $model = new UserModel();
        $model->insert([
            'username'   => $this->request->getPost('username'),
            'full_name'  => $this->request->getPost('full_name'),
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to('/users');
    }

    public function edit($id)
    {
        $model = new UserModel();
        $user = $model->find($id);

        if (! $user) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('users/edit', ['user' => $user]);
    }

    public function update($id)
    {
        $rules = [
            'username'  => "required|min_length[3]|max_length[50]|is_unique[users.username,id,{$id}]",
            'full_name' => 'required|min_length[3]|max_length[100]',
        ];

        // Only check the avatar if the user actually picked a file
        $avatar  = $this->request->getFile('avatar');
        $hasFile = $avatar !== null && $avatar->getError() !== UPLOAD_ERR_NO_FILE;

        if ($hasFile) {
            $rules['avatar'] = 'uploaded[avatar]|max_size[avatar,2048]|mime_in[avatar,image/jpeg,image/png]|is_image[avatar]';
        }

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput();
        }

        $data = [
            'username'  => $this->request->getPost('username'),
            'full_name' => $this->request->getPost('full_name'),
        ];

        if ($hasFile) {
            $newName = $avatar->getRandomName();
            $avatar->move(FCPATH . 'uploads', $newName);

            // Make a display-ready 150x150 thumbnail (replaces the big original)
            service('image')
                ->withFile(FCPATH . 'uploads/' . $newName)
                ->fit(150, 150, 'center')
                ->save(FCPATH . 'uploads/' . $newName);

            $data['avatar'] = $newName;   // filename only, no path
        }

        $model = new UserModel();
        $model->update($id, $data);

        return redirect()->to('/users');
    }
}