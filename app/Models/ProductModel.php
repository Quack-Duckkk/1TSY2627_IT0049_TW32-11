<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table         = 'products';
    protected $primaryKey    = 'id';
    protected $returnType    = 'array';
    protected $useTimestamps = false;   // we set created_at ourselves in the controller

    protected $allowedFields = [
        'name',
        'price',
        'stock_quantity',
        'image',
        'is_active',
        'created_at',
    ];
}