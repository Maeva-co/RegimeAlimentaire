<?php

namespace App\Models;

use CodeIgniter\Model;

class SportModel extends Model
{
    protected $table = 'Sport';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nom', 'description', 'variation_poids_grammes', 'calories_par_heure'
    ];
    
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = null;
    
    protected $validationRules = [
        'nom' => 'required|min_length[3]',
        'variation_poids_grammes' => 'required|integer'
    ];
    
    protected $validationMessages = [
        'nom' => [
            'required' => 'Le nom du sport est obligatoire',
            'min_length' => 'Le nom doit contenir au moins 3 caractères'
        ]
    ];
}