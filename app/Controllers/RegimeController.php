<?php

namespace App\Controllers;

use App\Libraries\ProgrammePdf;
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

	public function exportPerdrePdf()
	{
		return $this->exportPdf('perdre');
	}

	public function exportGagnerPdf()
	{
		return $this->exportPdf('gagner');
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

	private function exportPdf(string $mode)
	{
		$sessionUser = session()->get('user');
		$userId = session()->get('user_id') ?? ($sessionUser['id'] ?? null);

		if (!$sessionUser || !$userId) {
			return redirect()->to('/login');
		}

		if ($sessionUser['role'] === 'admin') {
			return redirect()->to('/admin/dashboard');
		}

		$targetInput = (string) $this->request->getPost('target_kg');
		$targetInput = str_replace(',', '.', $targetInput);
		$targetKg = (float) $targetInput;

		if ($targetKg <= 0) {
			return redirect()->back()->with('erreur', 'Veuillez saisir une variation valide.')->withInput();
		}

		$userModel = new UserModel();
		$user = $userModel->findUserById((int) $userId);

		if (!$user) {
			return redirect()->to('/login');
		}

		$regimeModel = new RegimeModel();
		$sportModel = new SportModel();

		$regimes = $regimeModel->getProgrammeParObjectif($mode, $targetKg);
		$sports = $sportModel->getProgrammeParObjectif($mode, $targetKg);

		$titre = $mode === 'perdre' ? 'Perdre du poids' : 'Gagner du poids';
		$filename = $mode === 'perdre'
			? 'programme-perte-' . $targetKg . 'kg.pdf'
			: 'programme-gain-' . $targetKg . 'kg.pdf';

		$pdfBuilder = new ProgrammePdf();
		$content = $pdfBuilder->build([
			'titre' => $titre,
			'user' => $user,
			'targetKg' => $targetKg,
			'regimes' => $regimes,
			'sports' => $sports
		]);

		return $this->response
			->setHeader('Content-Type', 'application/pdf')
			->setHeader('Content-Disposition', 'attachment; filename="' . $filename . '"')
			->setBody($content);
	}
}
