<?php

namespace App\Controllers;

use App\Models\RegimeModel;

class RegimeController extends BaseController
{
    public function perdre()
    {
        return $this->renderPage('perdre');
    }

    public function gagner()
    {
        return $this->renderPage('gagner');
    }

    public function imc()
    {
        return $this->renderPage('imc');
    }

    private function renderPage(string $mode)
    {
        $user = session()->get('user');

        if (!$user) {
            return redirect()->to('/login');
        }

        if ($user['role'] === 'admin') {
            return redirect()->to('/admin/dashboard');
        }

        $regimeModel = new RegimeModel();
        $regimes = [];
        $titre = '';
        $intro = '';

        if ($mode === 'perdre') {
            $titre = 'Perdre du poids';
            $intro = 'Regimes avec une variation negative pour une perte de poids progressive.';
            $regimes = $regimeModel
                ->where('variation_poids_grammes <', 0)
                ->orderBy('variation_poids_grammes', 'ASC')
                ->findAll();
        } elseif ($mode === 'gagner') {
            $titre = 'Gagner du poids';
            $intro = 'Regimes avec une variation positive pour soutenir la prise de poids.';
            $regimes = $regimeModel
                ->where('variation_poids_grammes >', 0)
                ->orderBy('variation_poids_grammes', 'DESC')
                ->findAll();
        } else {
            $titre = 'Atteindre son IMC';
            $intro = 'Objectif IMC ideal. Les recommandations arrive bientot.';
        }

        return view('regime/index', [
            'mode' => $mode,
            'titre' => $titre,
            'intro' => $intro,
            'user' => $user,
            'regimes' => $regimes
        ]);
    }
}
