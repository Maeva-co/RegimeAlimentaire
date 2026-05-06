<?php

namespace App\Models;

use CodeIgniter\Model;

class CodeModel extends Model
{
    protected $table = 'Code';
    protected $primaryKey = 'id';
    protected $allowedFields = ['code', 'valeur', 'utilise', 'expire_le'];
    
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = null;
    
    protected $validationRules = [
        'code' => 'required|min_length[3]|is_unique[Code.code,id,{id}]',
        'valeur' => 'required|numeric|greater_than[0]'
    ];
    
    protected $validationMessages = [
        'code' => [
            'required' => 'Le code est obligatoire',
            'min_length' => 'Le code doit contenir au moins 3 caractères',
            'is_unique' => 'Ce code existe déjà'
        ],
        'valeur' => [
            'required' => 'La valeur est obligatoire',
            'numeric' => 'La valeur doit être un nombre',
            'greater_than' => 'La valeur doit être supérieure à 0'
        ]
    ];
    
    public function getCodesDisponibles()
    {
        return $this->where('utilise', 0)
                    ->where('expire_le >=', date('Y-m-d'))
                    ->orWhere('expire_le IS NULL')
                    ->findAll();
    }
    
    public function getCodesUtilises()
    {
        return $this->where('utilise', 1)->findAll();
    }
}