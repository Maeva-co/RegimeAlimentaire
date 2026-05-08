<!-- Sports Index View -->
<div class="data-card">
    <div class="card-header">
        <div class="card-header-left">
            <div class="card-icon"><i class="fas fa-running"></i></div>
            <div>
                <h3>Activités sportives</h3>
                <div class="card-sub">Gérez les sports et leurs impacts</div>
            </div>
        </div>
        <button class="btn btn-primary btn-sm" onclick="navigateTo('/admin/sports/create')">
            <i class="fas fa-plus"></i> Nouveau sport
        </button>
    </div>
    <div class="card-body" style="padding:0;">
        <div class="data-table-wrap">
            <table class="data-table" id="sportsTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nom</th>
                        <th>Description</th>
                        <th>Variation / séance</th>
                        <th>Calories / h</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($sports as $sport): ?>
                    <tr id="row-<?= $sport['id'] ?>">
                        <td style="color:var(--ink-muted);font-size:12px;"><?= $sport['id'] ?></td>
                        <td><strong><?= esc($sport['nom']) ?></strong></td>
                        <td style="color:var(--ink-muted);font-size:13px;max-width:220px;">
                            <?= substr(esc($sport['description'] ?? ''), 0, 60) ?>…
                        </td>
                        <td>
                            <span class="variation-badge <?= $sport['variation_poids_grammes'] >= 0 ? 'positive' : 'negative' ?>">
                                <i class="fas fa-<?= $sport['variation_poids_grammes'] >= 0 ? 'arrow-up' : 'arrow-down' ?>"></i>
                                <?= $sport['variation_poids_grammes'] > 0 ? '+' : '' ?><?= $sport['variation_poids_grammes'] / 1000 ?> kg
                            </span>
                        </td>
                        <td>
                            <?php if ($sport['calories_par_heure']): ?>
                                <span style="font-size:13px;font-weight:600;color:var(--warning);">
                                    <i class="fas fa-fire" style="font-size:11px;"></i>
                                    <?= $sport['calories_par_heure'] ?> kcal
                                </span>
                            <?php else: ?>
                                <span style="color:var(--ink-faint);font-size:13px;">—</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <div class="actions">
                                <button class="btn-icon edit" onclick="navigateTo('/admin/sports/edit/<?= $sport['id'] ?>')" title="Modifier">
                                    <i class="fas fa-pen"></i>
                                </button>
                                <button class="btn-icon delete" onclick="deleteSport(<?= $sport['id'] ?>)" title="Supprimer">
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