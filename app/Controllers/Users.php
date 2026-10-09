<?php

namespace App\Controllers;

class Users extends BaseController
{
    public function index(): string
    {
        $users = [
            ['username' => 'admin',    'full_name' => 'Roberto Garcia', 'role' => 'Administrator'],
            ['username' => 'mcruz',    'full_name' => 'Mia Cruz',       'role' => 'Manager'],
            ['username' => 'jlopez',   'full_name' => 'Jose Lopez',     'role' => 'Cashier'],
            ['username' => 'atan',     'full_name' => 'Alyssa Tan',     'role' => 'Cashier'],
            ['username' => 'pramos',   'full_name' => 'Paolo Ramos',    'role' => 'Stock Clerk'],
        ];

        return view('users/index', [
            'title' => 'User Accounts',
            'users' => $users,
        ]);
    }
}