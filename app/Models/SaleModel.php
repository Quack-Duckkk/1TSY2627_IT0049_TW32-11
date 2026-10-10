<?php

namespace App\Models;

use CodeIgniter\Model;

class SaleModel extends Model
{
    protected $table         = 'sales';
    protected $primaryKey    = 'id';
    protected $returnType    = 'array';
    protected $useTimestamps = false;   // we set created_at ourselves in the controller

    protected $allowedFields = [
        'product_id',
        'customer_id',
        'sold_by',
        'quantity',
        'total_price',
        'created_at',
    ];

    // Sales with the names filled in, newest first
    public function getHistory(): array
    {
        return $this->select('sales.*, products.name AS product_name, customers.full_name AS customer_name, users.full_name AS staff_name')
            ->join('products', 'products.id = sales.product_id')
            ->join('customers', 'customers.id = sales.customer_id', 'left')   // left: customer is optional
            ->join('users', 'users.id = sales.sold_by')
            ->orderBy('sales.created_at', 'DESC')
            ->orderBy('sales.id', 'DESC')
            ->findAll();
    }
}