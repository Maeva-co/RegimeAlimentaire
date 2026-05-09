<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\RegimeModel;
use App\Models\RegimeCompositionModel;

class RegimeController extends BaseController
{
    public function index()
    {
        $model = new RegimeModel();
        $data = [
            'title' => 'Gestion des régimes',
            'regimes' => $model->findAll()
        ];
        
        return view('admin/layouts/admin_layout', [
            'content' => view('admin/regimes/index', $data),
            'title' => $data['title']
        ]);
    }
    
    public function create()
    {
        $data = [
            'title' => 'Ajouter un régime',
            'regime' => null,
            'viande_pourc' => 33,
            'poisson_pourc' => 33,
            'volaille_pourc' => 34
        ];
        
        return view('admin/layouts/admin_layout', [
            'content' => view('admin/regimes/form', $data),
            'title' => $data['title']
        ]);
    }
    
   public function store()
    {
        $model = new RegimeModel();
        
        $data = [
            'nom' => $this->request->getPost('nom'),
            'description' => $this->request->getPost('description'),
            'prix_par_jour' => $this->request->getPost('prix_par_jour'),
            'duree_jours' => $this->request->getPost('duree_jours'),
            'variation_poids_grammes' => $this->request->getPost('variation_poids_grammes')
        ];
        
        // Validation
        if (empty($data['nom']) || strlen($data['nom']) < 3) {
            return $this->response->setJSON([
                'success' => false, 
                'message' => 'Le nom doit contenir au moins 3 caractères'
            ]);
        }
        
        if ($data['prix_par_jour'] <= 0) {
            return $this->response->setJSON([
                'success' => false, 
                'message' => 'Le prix doit être positif'
            ]);
        }
        
        if ($data['duree_jours'] <= 0) {
            return $this->response->setJSON([
                'success' => false, 
                'message' => 'La durée doit être positive'
            ]);
        }
        
        $model->insert($data);
        $idRegime = $model->insertID();
        
        // Gestion des pourcentages
        $viande = $this->request->getPost('viande_pourc');
        $poisson = $this->request->getPost('poisson_pourc');
        $volaille = $this->request->getPost('volaille_pourc');
        
        // Vérifier que la somme fait 100
        if ((float)$viande + (float)$poisson + (float)$volaille != 100) {
            $model->delete($idRegime);
            return $this->response->setJSON([
                'success' => false, 
                'message' => 'La somme des pourcentages doit être égale à 100%'
            ]);
        }
        
        $compModel = new \App\Models\RegimeCompositionModel();
        $compModel->insert(['idRegime' => $idRegime, 'type_viande' => 'viande', 'pourcentage' => $viande]);
        $compModel->insert(['idRegime' => $idRegime, 'type_viande' => 'poisson', 'pourcentage' => $poisson]);
        $compModel->insert(['idRegime' => $idRegime, 'type_viande' => 'volaille', 'pourcentage' => $volaille]);
        
        return $this->response->setJSON([
            'success' => true, 
            'message' => 'Régime ajouté avec succès'
        ]);
    }
    
    public function edit($id)
    {
        $model = new RegimeModel();
        $compModel = new RegimeCompositionModel();
        
        $regime = $model->find($id);
        if (!$regime) {
            return redirect()->to('/admin/regimes')->with('erreur', 'Régime non trouvé');
        }
        
        $compositions = $compModel->where('idRegime', $id)->findAll();
        $pourcentages = [];
        foreach ($compositions as $comp) {
            $pourcentages[$comp['type_viande']] = $comp['pourcentage'];
        }
        
        $data = [
            'title' => 'Modifier un régime',
            'regime' => $regime,
            'viande_pourc' => $pourcentages['viande'] ?? 0,
            'poisson_pourc' => $pourcentages['poisson'] ?? 0,
            'volaille_pourc' => $pourcentages['volaille'] ?? 0
        ];
        
        return view('admin/layouts/admin_layout', [
            'content' => view('admin/regimes/form', $data),
            'title' => $data['title']
        ]);
    }
    
    public function update($id)
    {
        $model = new RegimeModel();
        
        $data = [
            'nom' => $this->request->getPost('nom'),
            'description' => $this->request->getPost('description'),
            'prix_par_jour' => $this->request->getPost('prix_par_jour'),
            'duree_jours' => $this->request->getPost('duree_jours'),
            'variation_poids_grammes' => $this->request->getPost('variation_poids_grammes')
        ];
        
        $model->update($id, $data);
        
        // Mettre à jour les pourcentages
        $viande = $this->request->getPost('viande_pourc');
        $poisson = $this->request->getPost('poisson_pourc');
        $volaille = $this->request->getPost('volaille_pourc');
        
        $compModel = new \App\Models\RegimeCompositionModel();
        $compModel->where('idRegime', $id)->where('type_viande', 'viande')->set(['pourcentage' => $viande])->update();
        $compModel->where('idRegime', $id)->where('type_viande', 'poisson')->set(['pourcentage' => $poisson])->update();
        $compModel->where('idRegime', $id)->where('type_viande', 'volaille')->set(['pourcentage' => $volaille])->update();
        
        return $this->response->setJSON([
            'success' => true, 
            'message' => 'Régime modifié avec succès'
        ]);
    }
    
    public function delete($id)
    {
        $model = new RegimeModel();
        $regime = $model->find($id);
        
        if (!$regime) {
            return $this->response->setJSON([
                'success' => false, 
                'message' => 'Régime non trouvé'
            ]);
        }
        
        $model->delete($id);
        
        return $this->response->setJSON([
            'success' => true, 
            'message' => 'Régime supprimé avec succès'
        ]);
    }
}