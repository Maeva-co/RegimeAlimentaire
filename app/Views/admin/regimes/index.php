<!-- Regimes Index View -->
<div class="data-card">
    <div class="card-header">
        <div class="card-header-left">
            <div class="card-icon"><i class="fas fa-apple-alt"></i></div>
            <div>
                <h3>Régimes alimentaires</h3>
                <div class="card-sub">Gérez vos programmes nutritionnels</div>
            </div>
        </div>
        <button class="btn btn-primary btn-sm" onclick="navigateTo('/admin/regimes/create')">
            <i class="fas fa-plus"></i> Nouveau régime
        </button>
    </div>
    <div class="card-body" style="padding:0;">
        <div class="data-table-wrap">
            <table class="data-table" id="regimesTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nom</th>
                        <th>Prix/jour</th>
                        <th>Durée</th>
                        <th>Variation</th>
                        <th>Composition</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($regimes as $regime): ?>
                    <tr id="row-<?= $regime['id'] ?>">
                        <td style="color:var(--ink-muted);font-size:12px;"><?= $regime['id'] ?></td>
                        <td>
                            <strong><?= esc($regime['nom']) ?></strong>
                            <?php if ($regime['description'] ?? ''): ?>
                            <div style="font-size:12px;color:var(--ink-muted);margin-top:2px;">
                                <?= substr(esc($regime['description']), 0, 45) ?>…
                            </div>
                            <?php endif; ?>
                        </td>
                        <td>
                            <strong style="color:var(--jade-deep);"><?= number_format($regime['prix_par_jour'], 2) ?> €</strong>
                            <div style="font-size:11px;color:var(--ink-faint);">par jour</div>
                        </td>
                        <td>
                            <span style="font-weight:600;"><?= $regime['duree_jours'] ?></span>
                            <span style="color:var(--ink-muted);font-size:12px;"> jours</span>
                        </td>
                        <td>
                            <span class="variation-badge <?= $regime['variation_poids_grammes'] >= 0 ? 'positive' : 'negative' ?>">
                                <i class="fas fa-<?= $regime['variation_poids_grammes'] >= 0 ? 'arrow-up' : 'arrow-down' ?>"></i>
                                <?= $regime['variation_poids_grammes'] > 0 ? '+' : '' ?><?= $regime['variation_poids_grammes'] / 1000 ?> kg/j
                            </span>
                        </td>
                        <td>
                            <?php
                                $comps = (new \App\Models\RegimeCompositionModel())->where('idRegime', $regime['id'])->findAll();
                                foreach ($comps as $comp):
                            ?>
                            <span class="comp-badge"><?= esc($comp['type_viande']) ?> <?= $comp['pourcentage'] ?>%</span>
                            <?php endforeach; ?>
                        </td>
                        <td>
                            <div class="actions">
                                <button class="btn-icon edit" onclick="navigateTo('/admin/regimes/edit/<?= $regime['id'] ?>')" title="Modifier">
                                    <i class="fas fa-pen"></i>
                                </button>
                                <button class="btn-icon delete" onclick="deleteRegime(<?= $regime['id'] ?>, '<?= esc($regime['nom']) ?>')" title="Supprimer">
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