<!-- Codes Index View -->
<div class="data-card">
    <div class="card-header">
        <div class="card-header-left">
            <div class="card-icon"><i class="fas fa-ticket-alt"></i></div>
            <div>
                <h3>Codes promotionnels</h3>
                <div class="card-sub">Gérez vos codes de réduction</div>
            </div>
        </div>
        <button class="btn btn-primary btn-sm" onclick="navigateTo('/admin/codes/create')">
            <i class="fas fa-plus"></i> Nouveau code
        </button>
    </div>
    <div class="card-body" style="padding:0;">
        <div class="data-table-wrap">
            <table class="data-table" id="codesTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Code</th>
                        <th>Valeur</th>
                        <th>Statut</th>
                        <th>Expiration</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($codes as $code): ?>
                    <tr id="row-<?= $code['id'] ?>">
                        <td style="color:var(--ink-muted);font-size:12px;"><?= $code['id'] ?></td>
                        <td><code><?= esc($code['code']) ?></code></td>
                        <td>
                            <strong style="color:var(--jade-deep);"><?= number_format($code['valeur'], 2) ?> €</strong>
                        </td>
                        <td>
                            <span class="status-badge <?= $code['utilise'] ? 'used' : 'available' ?>">
                                <i class="fas fa-<?= $code['utilise'] ? 'times-circle' : 'check-circle' ?>"></i>
                                <?= $code['utilise'] ? 'Utilisé' : 'Disponible' ?>
                            </span>
                        </td>
                        <td style="font-size:13px;color:var(--ink-muted);">
                            <?= $code['expire_le'] ? date('d/m/Y', strtotime($code['expire_le'])) : '<span style="color:var(--ink-faint);">Jamais</span>' ?>
                        </td>
                        <td>
                            <div class="actions">
                                <button class="btn-icon edit" onclick="navigateTo('/admin/codes/edit/<?= $code['id'] ?>')" title="Modifier">
                                    <i class="fas fa-pen"></i>
                                </button>
                                <button class="btn-icon delete" onclick="deleteCode(<?= $code['id'] ?>)" title="Supprimer">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>