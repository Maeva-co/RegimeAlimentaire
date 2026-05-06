<?php

namespace App\Models;

use CodeIgniter\Model;

class StudentModel extends Model {
    protected $table = 'student';
    protected $fields = [
        'nom', 
        'prenom', 
        'date_naissance', 
        'adresse'
        ];
}

?>