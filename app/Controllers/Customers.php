<?php

namespace App\Controllers;

use App\Models\CustomerModel;
use App\Models\SaleModel;

class Customers extends BaseController
{
    public function index()
    {
        $model = new CustomerModel();

        $data = [
            'customers' => $model->findAll(),
        ];

        return view('customers/index', $data);
    }

    public function new()
    {
        return view('customers/new');
    }

    public function create()
    {
        $rules = [
            'full_name' => 'required|min_length[3]|max_length[100]',
            'email'     => 'required|valid_email|max_length[100]',
            'phone'     => 'permit_empty|max_length[20]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput();
        }

        $model = new CustomerModel();
        $model->insert([
            'full_name'  => $this->request->getPost('full_name'),
            'email'      => $this->request->getPost('email'),
            'phone'      => $this->request->getPost('phone'),
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to('/customers');
    }

    public function edit($id)
    {
        $model    = new CustomerModel();
        $customer = $model->find($id);

        if (! $customer) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('customers/edit', ['customer' => $customer]);
    }

    public function update($id)
    {
        $rules = [
            'full_name' => 'required|min_length[3]|max_length[100]',
            'email'     => 'required|valid_email|max_length[100]',
            'phone'     => 'permit_empty|max_length[20]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput();
        }

        $model = new CustomerModel();
        $model->update($id, [
            'full_name' => $this->request->getPost('full_name'),
            'email'     => $this->request->getPost('email'),
            'phone'     => $this->request->getPost('phone'),
        ]);

        return redirect()->to('/customers');
    }

    public function delete($id)
    {
        $model    = new CustomerModel();
        $customer = $model->find($id);

        if (! $customer) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // Block the delete if this customer already has sales (foreign key!)
        $saleModel = new SaleModel();
        $salesCount = $saleModel->where('customer_id', $id)->countAllResults();

        if ($salesCount > 0) {
            return redirect()->to('/customers')
                ->with('error', "Can't delete {$customer['full_name']}: they have {$salesCount} sale(s) on record.");
        }

        $model->delete($id);

        return redirect()->to('/customers')
            ->with('success', "{$customer['full_name']} was deleted.");
    }
}