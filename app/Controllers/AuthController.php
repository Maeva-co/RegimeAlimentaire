<?php

namespace App\Controllers;

use App\Models\UserModel;

class AuthController extends BaseController
{
    public function loginForm()
    {
        return view('auth/login');
    }
    
    public function login()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        
        $model = new UserModel();
        $user = $model->where('email', $email)->first();
        
        
        if (!$user || $user['password'] != $password) {
            return redirect()->back()->with('erreur', 'Email ou mot de passe incorrect');
        }
        
        
        session()->set('user', [
            'id'    => $user['id'],
            'nom'   => $user['nom'],
            'email' => $user['email'],
            'role'  => $user['role']
        ]);
        
        
        if ($user['role'] === 'admin') {
            return redirect()->to('/admin/dashboard');
        } else {
            return redirect()->to('/');
        }
    }
    
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}