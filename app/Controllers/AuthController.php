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

        if ($user['IMC'] === null) {
            $tailleCm = $user['taille'];
            $poidsKg = $user['poids'];

            if (is_numeric($tailleCm) && is_numeric($poidsKg) && (float) $tailleCm > 0) {
                $tailleM = (float) $tailleCm / 100;

                if ($tailleM > 0) {
                    $imc = round((float) $poidsKg / ($tailleM * $tailleM), 2);
                    $model->update($user['id'], ['IMC' => $imc]);
                    $user['IMC'] = $imc;
                }
            }
        }
        
        
        session()->set('user', [
            'id'    => $user['id'],
            'nom'   => $user['nom'],
            'email' => $user['email'],
            'role'  => $user['role']
        ]);

        session()->set('user_id', $user['id']);
        
        
        if ($user['role'] === 'admin') {
            return redirect()->to('/admin/dashboard');
        } else {
            return redirect()->to('/hero');
        }
    }
    
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}