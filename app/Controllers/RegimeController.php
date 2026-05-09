<?php

namespace App\Controllers;

use App\Models\RegimeModel;
use App\Models\SportModel;
use App\Models\UserModel;

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
        $sessionUser = session()->get('user');
        $userId = session()->get('user_id') ?? ($sessionUser['id'] ?? null);

        if (!$sessionUser || !$userId) {
            return redirect()->to('/login');
        }

        if ($sessionUser['role'] === 'admin') {
            return redirect()->to('/admin/dashboard');
        }

        $userModel = new UserModel();
        $user = $userModel->findUserById((int) $userId);

        if (!$user) {
            return redirect()->to('/login');
        }

        $regimeModel = new RegimeModel();
        $sportModel = new SportModel();
        $regimes = [];
        $sports = [];
        $titre = '';
        $intro = '';

        if ($mode === 'perdre') {
            $titre = 'Perdre du poids';
            $intro = 'Regimes avec une variation negative pour une perte de poids progressive.';
            $regimes = $regimeModel->getRegimesPertePoids();
            $sports = $sportModel->getSportsPertePoids();
        } elseif ($mode === 'gagner') {
            $titre = 'Gagner du poids';
            $intro = 'Regimes avec une variation positive pour soutenir la prise de poids.';
            $regimes = $regimeModel->getRegimesGainPoids();
            $sports = $sportModel->getSportsGainPoids();
        } else {
            $titre = 'Atteindre son IMC';
            $intro = 'Un IMC ideal se trouve entre 18,5 et 24,9 , voici ce qu\'on propose';

            $imc = is_numeric($user['IMC']) ? (float) $user['IMC'] : null;

            $regimes = $regimeModel->getRegimesForImc($imc);
        }

        return view('regime/index', [
            'mode' => $mode,
            'titre' => $titre,
            'intro' => $intro,
            'user' => $user,
            'regimes' => $regimes,
            'sports' => $sports
        ]);
    }
}
