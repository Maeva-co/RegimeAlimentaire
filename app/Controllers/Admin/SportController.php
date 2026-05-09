<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SportModel;

class SportController extends BaseController
{
    public function index()
    {
        $model = new SportModel();
        $data = [
            'title' => 'Gestion des sports',
            'sports' => $model->findAll()
        ];
        
        return view('admin/layouts/admin_layout', [
            'content' => view('admin/sports/index', $data),
            'title' => $data['title']
        ]);
    }
    
    public function create()
    {
        $data = ['title' => 'Ajouter un sport'];
        
        return view('admin/layouts/admin_layout', [
            'content' => view('admin/sports/form', $data),
            'title' => $data['title']
        ]);
    }
    
    public function store()
    {
        $model = new SportModel();
        
        $data = [
            'nom' => trim($this->request->getPost('nom')),
            'description' => $this->request->getPost('description'),
            'variation_poids_grammes' => $this->request->getPost('variation_poids_grammes'),
            'calories_par_heure' => $this->request->getPost('calories_par_heure')
        ];
        
        // Validation
        if (empty($data['nom']) || strlen($data['nom']) < 3) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Le nom doit contenir au moins 3 caractères'
            ]);
        }
        
        if (empty($data['variation_poids_grammes']) || !is_numeric($data['variation_poids_grammes'])) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'La variation de poids est requise et doit être un nombre'
            ]);
        }
        
        $model->insert($data);
        
        return $this->response->setJSON([
            'success' => true,
            'message' => 'Sport ajouté avec succès'
        ]);
    }
    
    public function edit($id)
    {
        $model = new SportModel();
        $sport = $model->find($id);
        
        if (!$sport) {
            return redirect()->to('/admin/sports')->with('erreur', 'Sport non trouvé');
        }
        
        $data = [
            'title' => 'Modifier un sport',
            'sport' => $sport
        ];
        
        return view('admin/layouts/admin_layout', [
            'content' => view('admin/sports/form', $data),
            'title' => $data['title']
        ]);
    }
    
    public function update($id)
    {
        $model = new SportModel();
        
        $sport = $model->find($id);
        if (!$sport) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Sport non trouvé'
            ]);
        }
        
        $data = [
            'nom' => trim($this->request->getPost('nom')),
            'description' => $this->request->getPost('description'),
            'variation_poids_grammes' => $this->request->getPost('variation_poids_grammes'),
            'calories_par_heure' => $this->request->getPost('calories_par_heure')
        ];
        
        // Validation
        if (empty($data['nom']) || strlen($data['nom']) < 3) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Le nom doit contenir au moins 3 caractères'
            ]);
        }
        
        $model->update($id, $data);
        
        return $this->response->setJSON([
            'success' => true,
            'message' => 'Sport modifié avec succès'
        ]);
    }
    
    public function delete($id)
    {
        $model = new SportModel();
        $sport = $model->find($id);
        
        if (!$sport) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Sport non trouvé'
            ]);
        }
        
        $model->delete($id);
        
        return $this->response->setJSON([
            'success' => true,
            'message' => 'Sport supprimé avec succès'
        ]);
    }
}