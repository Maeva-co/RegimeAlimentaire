<div class="data-card">
    <div class="card-header"><h3><i class="fas fa-list"></i> Liste des régimes</h3><button class="btn-primary" onclick="window.location.href='/admin/regimes/create'"><i class="fas fa-plus"></i> Nouveau régime</button></div>
    <div class="card-body">
        <table class="data-table" id="regimesTable">
            <thead><tr><th>ID</th><th>Nom</th><th>Description</th><th>Prix/jour</th><th>Durée</th><th>Variation</th><th>Composition</th><th>Actions</th></tr></thead>
            <tbody>
                <?php foreach($regimes as $regime): ?>
                <tr id="row-<?= $regime['id'] ?>">
                    <td><?= $regime['id'] ?></td>
                    <td><strong><?= esc($regime['nom']) ?></strong></td>
                    <td><?= substr(esc($regime['description'] ?? ''), 0, 50) ?>...</td>
                    <td><?= number_format($regime['prix_par_jour'], 2) ?> €</td>
                    <td><?= $regime['duree_jours'] ?> jours</td>
                    <td><span class="variation-badge <?= $regime['variation_poids_grammes'] > 0 ? 'positive' : 'negative' ?>"><?= $regime['variation_poids_grammes'] > 0 ? '+' : '' ?><?= $regime['variation_poids_grammes'] / 1000 ?> kg/j</span></td>
                    <td><?php $comps = (new \App\Models\RegimeCompositionModel())->where('idRegime', $regime['id'])->findAll(); foreach($comps as $comp) echo '<span class="comp-badge">' . $comp['type_viande'] . ': ' . $comp['pourcentage'] . '%</span>'; ?></td>
                    <td class="actions"><button class="btn-icon edit" onclick="window.location.href='/admin/regimes/edit/<?= $regime['id'] ?>'"><i class="fas fa-edit"></i></button><button class="btn-icon delete" onclick="deleteRegime(<?= $regime['id'] ?>, '<?= esc($regime['nom']) ?>')"><i class="fas fa-trash"></i></button></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>