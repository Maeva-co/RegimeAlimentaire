<div class="data-card">
    <div class="card-header"><h3><i class="fas fa-cog"></i> Paramètres généraux</h3></div>
    <div class="card-body">
        <table class="data-table">
            <thead><tr><th>Clé</th><th>Valeur</th><th>Description</th><th>Action</th></tr></thead>
            <tbody>
                <?php foreach($parametres as $param): ?>
                <tr>
                    <td><strong><?= esc($param['cle']) ?></strong></td>
                    <td><?= esc($param['valeur']) ?></td>
                    <td><?= esc($param['description']) ?></td>
                    <td><button class="btn-icon edit" onclick="window.location.href='/admin/parametres/edit/<?= $param['id'] ?>'"><i class="fas fa-edit"></i></button></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>