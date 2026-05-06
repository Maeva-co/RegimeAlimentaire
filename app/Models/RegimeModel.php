<?php

namespace App\Models;

use CodeIgniter\Model;

class RegimeModel extends Model
{
    protected $table = 'Regime';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nom', 'description', 'prix_par_jour', 
        'duree_jours', 'variation_poids_grammes'
    ];
    
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = null;
    
    protected $validationRules = [
        'nom' => 'required|min_length[3]',
        'prix_par_jour' => 'required|numeric|greater_than[0]',
        'duree_jours' => 'required|integer|greater_than[0]',
        'variation_poids_grammes' => 'required|integer'
    ];
    
    protected $validationMessages = [
        'nom' => [
            'required' => 'Le nom du régime est obligatoire',
            'min_length' => 'Le nom doit contenir au moins 3 caractères'
        ],
        'prix_par_jour' => [
            'required' => 'Le prix est obligatoire',
            'numeric' => 'Le prix doit être un nombre',
            'greater_than' => 'Le prix doit être supérieur à 0'
        ],
        'duree_jours' => [
            'required' => 'La durée est obligatoire',
            'integer' => 'La durée doit être un nombre entier',
            'greater_than' => 'La durée doit être supérieure à 0'
        ]
    ];
}