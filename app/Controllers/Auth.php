<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    // Show the login form
    public function login()
    {
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/customers');
        }

        return view('auth/login');
    }

    // Handle the form submit
    public function attempt()
    {
        $rules = [
            'username' => 'required',
            'password' => 'required',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput();
        }

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = (new UserModel())->where('username', $username)->first();

        if ($user === null || ! password_verify($password, $user['password'] ?? '')) {
            return redirect()->back()->withInput()
                ->with('error', 'Invalid username or password.');
        }

        // Create a new session ID and remove the old one.
        session()->regenerate(true);

        session()->set([
            'isLoggedIn' => true,
            'user_id'    => $user['id'],
            'username'   => $user['username'],
        ]);

        return redirect()->to('/customers')
            ->with('message', 'Welcome back, ' . $user['username'] . '!');
    }

    // We will convert this to POST after checking the navigation view.
    public function logout()
    {
        session()->destroy();

        return redirect()->to('/login');
    }
}