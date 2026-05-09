<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\RegimeModel;
use App\Models\SportModel;
use App\Models\CodeModel;

class DashboardController extends BaseController
{
    public function index()
    {
        $userModel = new UserModel();
        $regimeModel = new RegimeModel();
        $sportModel = new SportModel();
        $codeModel = new CodeModel();
        
        $data = [
            'title' => 'Tableau de bord',
            'totalUsers' => $userModel->countAll(),
            'totalRegimes' => $regimeModel->countAll(),
            'totalSports' => $sportModel->countAll(),
            'totalCodes' => $codeModel->countAll(),
            'codesUtilises' => $codeModel->where('utilise', 1)->countAllResults(),
            'recentUsers' => $userModel->orderBy('created_at', 'DESC')->findAll(5)
        ];
        
        return view('admin/layouts/admin_layout', [
            'content' => view('admin/dashboard', $data),
            'title' => $data['title']
        ]);
    }
    
    public function getStats()
    {
        $db = \Config\Database::connect();
        
        // Statistiques pour les graphiques
        $regimesParVariation = $db->query("
            SELECT nom, variation_poids_grammes 
            FROM Regime 
            ORDER BY variation_poids_grammes DESC
        ")->getResult();
        
        $sportsParVariation = $db->query("
            SELECT nom, variation_poids_grammes 
            FROM Sport 
            ORDER BY variation_poids_grammes DESC
        ")->getResult();
        
        // Stats supplémentaires pour les cartes
        $userModel = new UserModel();
        $regimeModel = new RegimeModel();
        $sportModel = new SportModel();
        $codeModel = new CodeModel();
        
        return $this->response->setJSON([
            'stats' => [
                'users' => $userModel->countAll(),
                'regimes' => $regimeModel->countAll(),
                'sports' => $sportModel->countAll(),
                'codes' => $codeModel->countAll()
            ],
            'regimes' => $regimesParVariation,
            'sports' => $sportsParVariation
        ]);
    }
}