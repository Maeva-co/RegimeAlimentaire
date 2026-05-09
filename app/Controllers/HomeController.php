<?php

namespace App\Controllers;

class HomeController extends BaseController
{
    public function index()
    {
        $user = session()->get('user');
        
        if ($user && $user['role'] === 'admin') {
            return redirect()->to('/admin/dashboard');
        }

        if ($user && $user['role'] === 'user') {
            return redirect()->to('/hero');
        }
        
        // Rediriger vers login au lieu d'afficher home.php
        return redirect()->to('/login');
    }

    public function hero()
    {
        $user = session()->get('user');

        if (!$user) {
            return redirect()->to('/login');
        }

        if ($user['role'] === 'admin') {
            return redirect()->to('/admin/dashboard');
        }

        return view('hero');
    }
}