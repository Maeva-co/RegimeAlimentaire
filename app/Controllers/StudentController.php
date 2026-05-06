<?php

namespace App\Controllers;

use App\Models\StudentModel;

class StudentController extends BaseController {
    // public function index() {
    //     return "Students List";
    // }

    public function index() {
        $model = new StudentModel();
        $content['student'] = $model->findAll();

        return view('student', $content);
        //
    }
}

?>