<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\UserModel;

class CodeModel extends Model
{
    protected $table = 'Code';
    protected $primaryKey = 'id';
    protected $allowedFields = ['code', 'valeur', 'utilise', 'expire_le'];
    
    protected $useTimestamps = false;
    
    protected $validationRules = [
        'code' => 'required|min_length[3]|is_unique[Code.code,id,{id}]',
        'valeur' => 'required|numeric|greater_than[0]'
    ];
    
    protected $validationMessages = [
        'code' => [
            'required' => 'Le code est obligatoire',
            'min_length' => 'Le code doit contenir au moins 3 caractères',
            'is_unique' => 'Ce code existe déjà'
        ],
        'valeur' => [
            'required' => 'La valeur est obligatoire',
            'numeric' => 'La valeur doit être un nombre',
            'greater_than' => 'La valeur doit être supérieure à 0'
        ]
    ];
    
    public function getCodesDisponibles()
    {
        return $this->where('utilise', 0)
                    ->where('expire_le >=', date('Y-m-d'))
                    ->orWhere('expire_le IS NULL')
                    ->findAll();
    }
    
    public function getCodesUtilises()
    {
        return $this->where('utilise', 1)->findAll();
    }

    public function findValidCode(string $code): ?array
    {
        $code = strtoupper(trim($code));

        if ($code === '') {
            return null;
        }

        return $this
            ->where('code', $code)
            ->where('utilise', 0)
            ->groupStart()
                ->where('expire_le >=', date('Y-m-d'))
                ->orWhere('expire_le', null)
            ->groupEnd()
            ->first();
    }

    public function markAsUsed(int $codeId): bool
    {
        return (bool) $this->update($codeId, ['utilise' => 1]);
    }

    public function redeemForUser(string $codeInput, int $userId): array
    {
        $userModel = new UserModel();
        $user = $userModel->findUserById($userId);

        if (!$user) {
            return ['success' => false, 'message' => 'Utilisateur introuvable.'];
        }

        $code = $this->findValidCode($codeInput);

        if (!$code) {
            return ['success' => false, 'message' => 'Code invalide ou deja utilise.'];
        }

        $db = $this->db;
        $db->transStart();

        $currentBalance = is_numeric($user['balance']) ? (float) $user['balance'] : 0.0;
        $newBalance = $currentBalance + (float) $code['valeur'];

        $userModel->update($userId, ['balance' => $newBalance]);
        $this->markAsUsed((int) $code['id']);

        $db->transComplete();

        if ($db->transStatus() === false) {
            return ['success' => false, 'message' => 'Echec de la mise a jour.'];
        }

        return ['success' => true, 'message' => 'Code applique avec succes.'];
    }
}