<?php

namespace App\Controllers;

use App\Models\CodeModel;

class CodeController extends BaseController
{
    public function redeemForm()
    {
        $sessionUser = session()->get('user');

        if (!$sessionUser) {
            return redirect()->to('/login');
        }

        if ($sessionUser['role'] === 'admin') {
            return redirect()->to('/admin/dashboard');
        }

        return view('code/redeem');
    }

    public function redeem()
    {
        $sessionUser = session()->get('user');
        $userId = session()->get('user_id') ?? ($sessionUser['id'] ?? null);

        if (!$sessionUser || !$userId) {
            return redirect()->to('/login');
        }

        if ($sessionUser['role'] === 'admin') {
            return redirect()->to('/admin/dashboard');
        }

        $codeInput = (string) $this->request->getPost('code');
        $codeModel = new CodeModel();
        $result = $codeModel->redeemForUser($codeInput, (int) $userId);

        if ($result['success']) {
            return redirect()->to('/code/redeem')->with('success', $result['message']);
        }

        return redirect()->back()->with('erreur', $result['message'])->withInput();
    }
}