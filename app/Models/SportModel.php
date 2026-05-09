<?php

namespace App\Models;

use CodeIgniter\Model;

class SportModel extends Model
{
    protected $table = 'Sport';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nom', 'description', 'variation_poids_grammes', 'calories_par_heure'
    ];
    
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = null;
    
    protected $validationRules = [
        'nom' => 'required|min_length[3]',
        'variation_poids_grammes' => 'required|integer'
    ];
    
    protected $validationMessages = [
        'nom' => [
            'required' => 'Le nom du sport est obligatoire',
            'min_length' => 'Le nom doit contenir au moins 3 caractères'
        ]
    ];

    public function getSportsPertePoids(): array
    {
        return $this
            ->where('variation_poids_grammes <', 0)
            ->orderBy('variation_poids_grammes', 'ASC')
            ->findAll();
    }

    public function getSportsGainPoids(): array
    {
        return $this
            ->where('variation_poids_grammes >', 0)
            ->orderBy('variation_poids_grammes', 'DESC')
            ->findAll();
    }

    public function getProgrammeParObjectif(string $mode, float $targetKg): array
    {
        if ($targetKg <= 0) {
            return [];
        }

        $items = $mode === 'perdre'
            ? $this->getSportsPertePoids()
            : $this->getSportsGainPoids();

        return $this->buildProgramme($items, $targetKg);
    }

    protected function buildProgramme(array $items, float $targetKg): array
    {
        $targetGrams = $targetKg * 1000;
        $plans = [];

        foreach ($items as $item) {
            $daily = abs((float) $item['variation_poids_grammes']);
            if ($daily <= 0) {
                continue;
            }

            $item['jours_necessaires'] = (int) ceil($targetGrams / $daily);
            $item['variation_jour'] = (float) $item['variation_poids_grammes'];
            $plans[] = $item;
        }

        return $plans;
    }
}