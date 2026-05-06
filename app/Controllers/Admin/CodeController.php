<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CodeModel;

class CodeController extends BaseController
{
    public function index()
    {
        $model = new CodeModel();
        $data = [
            'title' => 'Gestion des codes',
            'codes' => $model->findAll()
        ];
        
        return view('admin/layouts/admin_layout', [
            'content' => view('admin/codes/index', $data),
            'title' => $data['title']
        ]);
    }
    
    public function create()
    {
        $data = ['title' => 'Ajouter un code'];
        
        return view('admin/layouts/admin_layout', [
            'content' => view('admin/codes/form', $data),
            'title' => $data['title']
        ]);
    }
    
    public function store()
    {
        $model = new CodeModel();
        
        $data = [
            'code' => strtoupper($this->request->getPost('code')),
            'valeur' => $this->request->getPost('valeur'),
            'utilise' => 0,
            'expire_le' => $this->request->getPost('expire_le') ?: null
        ];
        
        $existing = $model->where('code', $data['code'])->first();
        if ($existing) {
            return redirect()->back()->with('erreur', 'Ce code existe déjà')->withInput();
        }
        
        $model->insert($data);
        return redirect()->to('/admin/codes')->with('success', 'Code ajouté avec succès');
    }
    
    public function edit($id)
    {
        $model = new CodeModel();
        $code = $model->find($id);
        
        if (!$code) {
            return redirect()->to('/admin/codes')->with('erreur', 'Code non trouvé');
        }
        
        $data = [
            'title' => 'Modifier un code',
            'code' => $code
        ];
        
        return view('admin/layouts/admin_layout', [
            'content' => view('admin/codes/form', $data),
            'title' => $data['title']
        ]);
    }
    
    public function update($id)
    {
        $model = new CodeModel();
        
        $data = [
            'code' => strtoupper($this->request->getPost('code')),
            'valeur' => $this->request->getPost('valeur'),
            'expire_le' => $this->request->getPost('expire_le') ?: null
        ];
        
        $model->update($id, $data);
        return redirect()->to('/admin/codes')->with('success', 'Code modifié avec succès');
    }
    
    public function delete($id)
    {
        $model = new CodeModel();
        $model->delete($id);
        return redirect()->to('/admin/codes')->with('success', 'Code supprimé');
    }
}