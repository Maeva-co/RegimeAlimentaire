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
        
        // Rediriger vers login au lieu d'afficher home.php
        return redirect()->to('/login');
    }
}