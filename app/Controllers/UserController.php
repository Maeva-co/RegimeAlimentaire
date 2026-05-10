<?php

namespace App\Controllers;

use App\Models\UserModel;

class UserController extends BaseController
{
    public function register()
    {
        return view('register_personal');
    }

    public function registerPost()
    {
        $rules = [
            'nom' => 'required|min_length[2]',
            'email' => 'required|valid_email|is_unique[User.email]',
            'password' => 'required|min_length[4]',
            'genre' => 'required|in_list[homme,femme]'
        ];

        $messages = [
            'nom' => [
                'required' => 'Le nom est obligatoire',
                'min_length' => 'Le nom doit contenir au moins 2 caracteres'
            ],
            'email' => [
                'required' => 'L\'email est obligatoire',
                'valid_email' => 'Email invalide',
                'is_unique' => 'Cet email est deja utilise'
            ],
            'password' => [
                'required' => 'Le mot de passe est obligatoire',
                'min_length' => 'Le mot de passe doit contenir au moins 4 caracteres'
            ],
            'genre' => [
                'required' => 'Le genre est obligatoire',
                'in_list' => 'Genre invalide'
            ]
        ];

        if (! $this->validate($rules, $messages)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $signupData = [
            'nom' => trim((string) $this->request->getPost('nom')),
            'email' => trim((string) $this->request->getPost('email')),
            'password' => (string) $this->request->getPost('password'),
            'genre' => (string) $this->request->getPost('genre')
        ];

        session()->set('signup_data', $signupData);

        return redirect()->to('/register/health');
    }

    public function registerHealth()
    {
        if (! session()->get('signup_data')) {
            return redirect()->to('/register')
                ->with('erreur', 'Veuillez completer vos informations personnelles.');
        }

        return view('register_health');
    }

    public function registerHealthPost()
    {
        $signupData = session()->get('signup_data');

        if (! $signupData) {
            return redirect()->to('/register')
                ->with('erreur', 'Veuillez completer vos informations personnelles.');
        }

        $rules = [
            'taille' => 'required|numeric|greater_than[0]',
            'poids' => 'required|numeric|greater_than[0]'
        ];

        $messages = [
            'taille' => [
                'required' => 'La taille est obligatoire',
                'numeric' => 'La taille doit etre un nombre valide',
                'greater_than' => 'La taille doit etre superieure a 0'
            ],
            'poids' => [
                'required' => 'Le poids est obligatoire',
                'numeric' => 'Le poids doit etre un nombre valide',
                'greater_than' => 'Le poids doit etre superieur a 0'
            ]
        ];

        if (! $this->validate($rules, $messages)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $taille = (float) $this->request->getPost('taille');
        $poids = (float) $this->request->getPost('poids');

        $imc = round($poids / ($taille * $taille), 2);
        $tailleCm = $taille * 100;

        $userModel = new UserModel();
        $userModel->skipValidation(true);

        $insertedId = $userModel->insert([
            'nom' => $signupData['nom'],
            'email' => $signupData['email'],
            'password' => $signupData['password'],
            'genre' => $signupData['genre'],
            'taille' => $tailleCm,
            'poids' => $poids,
            'IMC' => $imc,
            'role' => 'user',
            'balance' => 0
        ], true);

        if (! $insertedId) {
            return redirect()->back()
                ->withInput()
                ->with('erreur', 'Impossible de creer le compte.');
        }

        session()->remove('signup_data');

        return redirect()->to('/login')
            ->with('success', 'Inscription reussie. Vous pouvez vous connecter.');
    }
}
