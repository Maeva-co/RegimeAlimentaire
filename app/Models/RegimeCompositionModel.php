<?php

namespace App\Models;

use CodeIgniter\Model;

class RegimeCompositionModel extends Model
{
    protected $table = 'RegimeComposition';
    protected $primaryKey = 'id';
    protected $allowedFields = ['idRegime', 'type_viande', 'pourcentage'];
    
    public function getPourcentages($idRegime)
    {
        $result = $this->where('idRegime', $idRegime)->findAll();
        $pourcentages = [];
        foreach ($result as $row) {
            $pourcentages[$row['type_viande']] = $row['pourcentage'];
        }
        return $pourcentages;
    }
    
    public function verifierSomme($viande, $poisson, $volaille)
    {
        return abs(($viande + $poisson + $volaille) - 100) < 0.01;
    }
}