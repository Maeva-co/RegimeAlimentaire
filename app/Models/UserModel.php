<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'User';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nom', 'email', 'password', 'genre', 
        'taille', 'poids', 'IMC', 'balance', 'role'
    ];
    
    protected $useTimestamps = false;
    
    protected $validationRules = [
        'nom' => 'required|min_length[2]',
        'email' => 'required|valid_email|is_unique[User.email,id,{id}]',
        'password' => 'required|min_length[3]'
    ];
    
    protected $validationMessages = [
        'nom' => [
            'required' => 'Le nom est obligatoire',
            'min_length' => 'Le nom doit contenir au moins 2 caractères'
        ],
        'email' => [
            'required' => 'L\'email est obligatoire',
            'valid_email' => 'Email invalide',
            'is_unique' => 'Cet email est déjà utilisé'
        ],
        'password' => [
            'required' => 'Le mot de passe est obligatoire',
            'min_length' => 'Le mot de passe doit contenir au moins 3 caractères'
        ]
    ];
}