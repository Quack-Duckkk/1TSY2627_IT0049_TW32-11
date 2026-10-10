<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    // Show the login form
    public function login()
    {
        // Already logged in? No need to see the form again.
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/customers');
        }

        return view('auth/login');
    }

    // Handle the form submit
    public function attempt()
    {
        // 1. Validate first (same habit as TFA3)
        $rules = [
            'username' => 'required',
            'password' => 'required',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput();
        }

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // 2. Find the user by username
        $user = (new UserModel())->where('username', $username)->first();

        // 3. Verify the password against the stored hash
        if ($user === null || ! password_verify($password, $user['password'] ?? '')) {
            return redirect()->back()->withInput()
                ->with('error', 'Invalid username or password.');
        }

        // 4. Success: start the session (small identifiers only!)
        session()->regenerate();
        session()->set([
            'isLoggedIn' => true,
            'user_id'    => $user['id'],
            'username'   => $user['username'],
        ]);

        return redirect()->to('/customers')
            ->with('message', 'Welcome back, ' . $user['username'] . '!');
    }

    // Log out: wipe the whole session
    public function logout()
    {
        session()->destroy();

        return redirect()->to('/login');
    }
}