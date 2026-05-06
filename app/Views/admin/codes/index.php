<div class="data-card">
    <div class="card-header"><h3><i class="fas fa-ticket-alt"></i> Codes promotionnels</h3><button class="btn-primary" onclick="window.location.href='/admin/codes/create'"><i class="fas fa-plus"></i> Nouveau code</button></div>
    <div class="card-body">
        <table class="data-table" id="codesTable">
            <thead><tr><th>ID</th><th>Code</th><th>Valeur</th><th>Statut</th><th>Expiration</th><th>Actions</th></tr></thead>
            <tbody>
                <?php foreach($codes as $code): ?>
                <tr id="row-<?= $code['id'] ?>">
                    <td><?= $code['id'] ?></td>
                    <td><code><?= esc($code['code']) ?></code></td>
                    <td><?= number_format($code['valeur'], 2) ?> €</td>
                    <td><span class="status-badge <?= $code['utilise'] ? 'used' : 'available' ?>"><?= $code['utilise'] ? 'Utilisé' : 'Disponible' ?></span></td>
                    <td><?= $code['expire_le'] ?? 'Jamais' ?></td>
                    <td class="actions"><button class="btn-icon edit" onclick="window.location.href='/admin/codes/edit/<?= $code['id'] ?>'"><i class="fas fa-edit"></i></button><button class="btn-icon delete" onclick="deleteCode(<?= $code['id'] ?>)"><i class="fas fa-trash"></i></button></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>