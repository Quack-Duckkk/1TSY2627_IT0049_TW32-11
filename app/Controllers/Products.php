<?php

namespace App\Controllers;

use App\Models\ProductModel;

class Products extends BaseController
{
    // Rules shared by create and update
    private function productRules(): array
    {
        return [
            'name'           => 'required|min_length[2]|max_length[100]',
            'price'          => 'required|numeric|greater_than[0]',
            'stock_quantity' => 'required|is_natural',
        ];
    }

    // Optional image: JPG, PNG, WebP; max 2MB
    private function imageRule(): string
    {
        return 'uploaded[image]'
            . '|max_size[image,2048]'
            . '|mime_in[image,image/jpeg,image/png,image/webp]'
            . '|ext_in[image,jpg,jpeg,png,webp]'
            . '|is_image[image]';
    }

    // Stores a resized 300x300 image and returns the filename only.
    private function storeImage($file): string
    {
        $extension = match ($file->getMimeType()) {
            'image/jpeg' => 'jpg',
            'image/png'  => 'png',
            'image/webp' => 'webp',
        };

        $newName = bin2hex(random_bytes(16)) . '.' . $extension;

        $file->move(FCPATH . 'uploads', $newName);

        service('image')
            ->withFile(FCPATH . 'uploads/' . $newName)
            ->fit(300, 300, 'center')
            ->save(FCPATH . 'uploads/' . $newName);

        return $newName;
    }

    private function deleteImageFile(?string $filename): void
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
        $model = new ProductModel();

        return view('products/index', [
            'products' => $model->orderBy('id', 'DESC')->findAll(),
        ]);
    }

    public function new()
    {
        return view('products/new');
    }

    public function create()
    {
        $rules = $this->productRules();

        $image   = $this->request->getFile('image');
        $hasFile = $image !== null && $image->getError() !== UPLOAD_ERR_NO_FILE;

        if ($hasFile) {
            $rules['image'] = $this->imageRule();
        }

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput();
        }

        $data = [
            'name'           => $this->request->getPost('name'),
            'price'          => $this->request->getPost('price'),
            'stock_quantity' => (int) $this->request->getPost('stock_quantity'),
            'is_active'      => 1,
            'created_at'     => date('Y-m-d H:i:s'),
        ];

        if ($hasFile) {
            $data['image'] = $this->storeImage($image);
        }

        (new ProductModel())->insert($data);

        return redirect()->to('/products');
    }

    public function edit($id)
    {
        $model   = new ProductModel();
        $product = $model->find($id);

        if (! $product) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('products/edit', ['product' => $product]);
    }

    public function update($id)
    {
        $model   = new ProductModel();
        $product = $model->find($id);

        if (! $product) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $rules = $this->productRules();

        $image   = $this->request->getFile('image');
        $hasFile = $image !== null && $image->getError() !== UPLOAD_ERR_NO_FILE;

        if ($hasFile) {
            $rules['image'] = $this->imageRule();
        }

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput();
        }

        $data = [
            'name'           => $this->request->getPost('name'),
            'price'          => $this->request->getPost('price'),
            'stock_quantity' => (int) $this->request->getPost('stock_quantity'),
        ];

        if ($hasFile) {
            $data['image'] = $this->storeImage($image);
            $this->deleteImageFile($product['image'] ?? null);
        }

        $model->update($id, $data);

        return redirect()->to('/products');
    }

    // Archive instead of deleting, so past sales keep their product reference.
    public function archive($id)
    {
        $model   = new ProductModel();
        $product = $model->find($id);

        if (! $product) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $model->update($id, ['is_active' => 0]);

        return redirect()->to('/products');
    }

    public function restore($id)
    {
        $model   = new ProductModel();
        $product = $model->find($id);

        if (! $product) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $model->update($id, ['is_active' => 1]);

        return redirect()->to('/products');
    }
}