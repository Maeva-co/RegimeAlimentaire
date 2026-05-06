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
            'nom' => $this->request->getPost('nom'),
            'description' => $this->request->getPost('description'),
            'variation_poids_grammes' => $this->request->getPost('variation_poids_grammes'),
            'calories_par_heure' => $this->request->getPost('calories_par_heure')
        ];
        
        if (empty($data['nom']) || strlen($data['nom']) < 3) {
            return redirect()->back()->with('erreur', 'Le nom doit contenir au moins 3 caractères')->withInput();
        }
        
        $model->insert($data);
        return redirect()->to('/admin/sports')->with('success', 'Sport ajouté avec succès');
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
        
        $data = [
            'nom' => $this->request->getPost('nom'),
            'description' => $this->request->getPost('description'),
            'variation_poids_grammes' => $this->request->getPost('variation_poids_grammes'),
            'calories_par_heure' => $this->request->getPost('calories_par_heure')
        ];
        
        $model->update($id, $data);
        return redirect()->to('/admin/sports')->with('success', 'Sport modifié avec succès');
    }
    
    public function delete($id)
    {
        $model = new SportModel();
        $model->delete($id);
        return redirect()->to('/admin/sports')->with('success', 'Sport supprimé');
    }
}