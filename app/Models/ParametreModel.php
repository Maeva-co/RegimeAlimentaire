<?php

namespace App\Models;

use CodeIgniter\Model;

class ParametreModel extends Model
{
    protected $table = 'Parametre';
    protected $primaryKey = 'id';
    protected $allowedFields = ['cle', 'valeur', 'description'];
    
    public function getByCle($cle)
    {
        return $this->where('cle', $cle)->first();
    }
    
    public function setByCle($cle, $valeur)
    {
        return $this->where('cle', $cle)->set(['valeur' => $valeur])->update();
    }
}