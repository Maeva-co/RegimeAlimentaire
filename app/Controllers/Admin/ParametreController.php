<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ParametreModel;

class ParametreController extends BaseController
{
    public function index()
    {
        $model = new ParametreModel();
        $data = [
            'title' => 'Paramètres',
            'parametres' => $model->findAll()
        ];
        
        return view('admin/layouts/admin_layout', [
            'content' => view('admin/parametres/index', $data),
            'title' => $data['title']
        ]);
    }
    
    public function edit($id)
    {
        $model = new ParametreModel();
        $parametre = $model->find($id);
        
        if (!$parametre) {
            return redirect()->to('/admin/parametres')->with('erreur', 'Paramètre non trouvé');
        }
        
        $data = [
            'title' => 'Modifier un paramètre',
            'parametre' => $parametre
        ];
        
        return view('admin/layouts/admin_layout', [
            'content' => view('admin/parametres/form', $data),
            'title' => $data['title']
        ]);
    }
    
    public function update($id)
    {
        $model = new ParametreModel();
        
        $data = [
            'valeur' => $this->request->getPost('valeur')
        ];
        
        $model->update($id, $data);
        return redirect()->to('/admin/parametres')->with('success', 'Paramètre modifié avec succès');
    }
}