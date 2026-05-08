<?php

namespace App\Controllers;

use App\Models\CodeModel;

class CodeController extends BaseController {

    public function redeem($id_code, $id_user) {
        $codemodel = new CodeModel();
        $code = $codemodel->findCodeById($id_code);
        if(!$code){

        }
    }   
}

?>