<div class="data-card">
    <div class="card-header"><h3><i class="fas fa-running"></i> Liste des activités sportives</h3><button class="btn-primary" onclick="window.location.href='/admin/sports/create'"><i class="fas fa-plus"></i> Nouveau sport</button></div>
    <div class="card-body">
        <table class="data-table" id="sportsTable">
            <thead><tr><th>ID</th><th>Nom</th><th>Description</th><th>Variation</th><th>Calories/h</th><th>Actions</th></tr></thead>
            <tbody>
                <?php foreach($sports as $sport): ?>
                <tr id="row-<?= $sport['id'] ?>">
                    <td><?= $sport['id'] ?></td>
                    <td><strong><?= esc($sport['nom']) ?></strong></td>
                    <td><?= substr(esc($sport['description'] ?? ''), 0, 50) ?>...</td>
                    <td><span class="variation-badge <?= $sport['variation_poids_grammes'] > 0 ? 'positive' : 'negative' ?>"><?= $sport['variation_poids_grammes'] > 0 ? '+' : '' ?><?= $sport['variation_poids_grammes'] / 1000 ?> kg/séance</span></td>
                    <td><?= $sport['calories_par_heure'] ?? '-' ?></td>
                    <td class="actions"><button class="btn-icon edit" onclick="window.location.href='/admin/sports/edit/<?= $sport['id'] ?>'"><i class="fas fa-edit"></i></button><button class="btn-icon delete" onclick="deleteSport(<?= $sport['id'] ?>)"><i class="fas fa-trash"></i></button></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>