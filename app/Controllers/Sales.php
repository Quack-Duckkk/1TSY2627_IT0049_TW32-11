<?php

namespace App\Controllers;

use App\Models\CustomerModel;
use App\Models\ProductModel;
use App\Models\SaleModel;

class Sales extends BaseController
{
    // Shows the Record Sale form
    public function new()
    {
        $data = [
            // Archived products must not be sellable
            'products'  => (new ProductModel())->where('is_active', 1)->orderBy('name')->findAll(),
            'customers' => (new CustomerModel())->orderBy('full_name')->findAll(),
        ];

        return view('sales/new', $data);
    }

    // Handles the form submit
    public function create()
    {
        $rules = [
            'product_id'  => 'required|is_natural_no_zero|is_not_unique[products.id]',
            'customer_id' => 'permit_empty|is_natural_no_zero|is_not_unique[customers.id]',
            'quantity'    => 'required|is_natural_no_zero',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput();
        }

        $productId  = (int) $this->request->getPost('product_id');
        $quantity   = (int) $this->request->getPost('quantity');
        $customerId = $this->request->getPost('customer_id');
        $customerId = ($customerId === null || $customerId === '') ? null : (int) $customerId;

        $product = (new ProductModel())
            ->where('id', $productId)
            ->where('is_active', 1)
            ->first();

        if (! $product) {
            return redirect()->back()->withInput()->with('error', 'That product is not available.');
        }

        // Clear message when asking for more than we have
        if ($quantity > (int) $product['stock_quantity']) {
            return redirect()->back()->withInput()->with(
                'error',
                'Not enough stock for ' . $product['name'] . '. Only ' . $product['stock_quantity'] . ' left.'
            );
        }

        // The server calculates the total, never the form
        $total = round((float) $product['price'] * $quantity, 2);

        $db = db_connect();
        $db->transStart();

        // Lower the stock ONLY IF there is still enough (safe even if two sales happen at once)
        $db->table('products')
            ->set('stock_quantity', 'stock_quantity - ' . $quantity, false)
            ->where('id', $productId)
            ->where('stock_quantity >=', $quantity)
            ->update();

        $stockUpdated = $db->affectedRows();

        if ($stockUpdated === 1) {
            (new SaleModel())->insert([
                'product_id'  => $productId,
                'customer_id' => $customerId,
                'sold_by'     => session()->get('user_id'),
                'quantity'    => $quantity,
                'total_price' => $total,
                'created_at'  => date('Y-m-d H:i:s'),
            ]);
        }

        $db->transComplete();

        if ($stockUpdated !== 1 || $db->transStatus() === false) {
            return redirect()->back()->withInput()->with('error', 'Could not record the sale. Please try again.');
        }

        return redirect()->to('/sales/record')->with(
            'success',
            'Sale recorded: ' . $quantity . ' x ' . $product['name'] . ' = ₱' . number_format($total, 2)
        );
    }

    // Sales History page
    public function history()
    {
        $data = [
            'sales' => (new SaleModel())->getHistory(),
        ];

        return view('sales/index', $data);
    }
}