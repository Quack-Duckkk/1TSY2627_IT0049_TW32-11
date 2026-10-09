<?php

namespace App\Controllers;

class Customers extends BaseController
{
    public function index(): string
    {
        // Static array = temporary stand-in for a database table
        $customers = [
            ['full_name' => 'Maria Santos',    'email' => 'maria.santos@example.com',  'phone' => '0917-111-2233'],
            ['full_name' => 'Juan Dela Cruz',  'email' => 'juan.delacruz@example.com', 'phone' => '0918-222-3344'],
            ['full_name' => 'Ana Reyes',       'email' => 'ana.reyes@example.com',     'phone' => '0919-333-4455'],
            ['full_name' => 'Carlo Mendoza',   'email' => 'carlo.mendoza@example.com', 'phone' => '0920-444-5566'],
            ['full_name' => 'Lea Villanueva',  'email' => 'lea.v@example.com',         'phone' => '0921-555-6677'],
        ];

        return view('customers/index', [
            'title'     => 'Customer Accounts',
            'customers' => $customers,
        ]);
    }
}