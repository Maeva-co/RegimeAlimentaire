<?php

namespace App\Models;

use CodeIgniter\Model;

class OptionModel extends Model {
    protected $table = 'Option';
    protected $fields = [
        'id', 
        'label', 
        'prix',
        'reduction'
        ];
}

?>