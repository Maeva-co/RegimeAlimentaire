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
        
        $code = strtoupper(trim($this->request->getPost('code')));
        $valeur = $this->request->getPost('valeur');
        $expire_le = $this->request->getPost('expire_le') ?: null;
        
        // Validation
        if (empty($code) || strlen($code) < 3) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Le code doit contenir au moins 3 caractères'
            ]);
        }
        
        if (empty($valeur) || !is_numeric($valeur) || $valeur <= 0) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'La valeur doit être un nombre positif'
            ]);
        }
        
        // Vérifier si code existe déjà
        $existing = $model->where('code', $code)->first();
        if ($existing) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Ce code existe déjà'
            ]);
        }
        
        $data = [
            'code' => $code,
            'valeur' => $valeur,
            'utilise' => 0,
            'expire_le' => $expire_le
        ];
        
        $model->insert($data);
        
        return $this->response->setJSON([
            'success' => true,
            'message' => 'Code ajouté avec succès'
        ]);
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
        // DEBUG - Affiche tout ce qui se passe
        try {
            $model = new CodeModel();
            
            // 1. Vérifier si le code existe
            $code = $model->find($id);
            if (!$code) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Code ID ' . $id . ' non trouvé'
                ]);
            }
            
            // 2. Récupérer les données POST
            $newCode = strtoupper(trim($this->request->getPost('code')));
            $valeur = $this->request->getPost('valeur');
            $expire_le = $this->request->getPost('expire_le') ?: null;
            
            // 3. Validation simple
            if (empty($newCode)) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Code vide'
                ]);
            }
            
            if (empty($valeur) || $valeur <= 0) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Valeur invalide: ' . $valeur
                ]);
            }
            
            // 4. Tenter la mise à jour DIRECTE avec SQL (contourne le modèle)
            $db = \Config\Database::connect();
            $result = $db->query("
                UPDATE Code 
                SET code = ?, valeur = ?, expire_le = ? 
                WHERE id = ?
            ", [$newCode, $valeur, $expire_le, $id]);
            
            if ($result) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Code modifié avec succès (SQL direct)'
                ]);
            } else {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Erreur SQL: ' . print_r($db->error(), true)
                ]);
            }
            
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Exception: ' . $e->getMessage()
            ]);
        }
    }
    
    public function delete($id)
    {
        $model = new CodeModel();
        $code = $model->find($id);
        
        if (!$code) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Code non trouvé'
            ]);
        }
        
        $model->delete($id);
        
        return $this->response->setJSON([
            'success' => true,
            'message' => 'Code supprimé avec succès'
        ]);
    }
}