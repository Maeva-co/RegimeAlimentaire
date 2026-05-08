<!-- Parametres Index View -->
<div class="data-card">
    <div class="card-header">
        <div class="card-header-left">
            <div class="card-icon"><i class="fas fa-sliders-h"></i></div>
            <div>
                <h3>Paramètres généraux</h3>
                <div class="card-sub">Configuration de la plateforme</div>
            </div>
        </div>
    </div>
    <div class="card-body" style="padding:0;">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Clé</th>
                    <th>Valeur</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($parametres as $param): ?>
                <tr>
                    <td>
                        <code><?= esc($param['cle']) ?></code>
                    </td>
                    <td><strong><?= esc($param['valeur']) ?></strong></td>
                    <td style="color:var(--ink-muted);font-size:13px;"><?= esc($param['description']) ?></td>
                    <td>
                        <button class="btn-icon edit" onclick="navigateTo('/admin/parametres/edit/<?= $param['id'] ?>')" title="Modifier">
                            <i class="fas fa-pen"></i>
                        </button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>