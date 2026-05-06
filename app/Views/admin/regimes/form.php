<div class="form-card">
    <div class="card-header">
        <h3><i class="fas fa-<?= $regime ? 'edit' : 'plus' ?>"></i> <?= $regime ? 'Modifier' : 'Ajouter' ?> un régime</h3>
        <button class="btn-secondary" onclick="window.location.href='/admin/regimes'"><i class="fas fa-arrow-left"></i> Retour</button>
    </div>
    <div class="card-body">
        <form id="regimeForm" onsubmit="event.preventDefault(); submitRegimeForm('/admin/regimes/<?= $regime ? "update/{$regime['id']}" : 'store' ?>');">
            <div class="form-row"><div class="form-group"><label><i class="fas fa-tag"></i> Nom du régime *</label><input type="text" name="nom" value="<?= old('nom', $regime['nom'] ?? '') ?>" required></div></div>
            <div class="form-row"><div class="form-group"><label><i class="fas fa-align-left"></i> Description</label><textarea name="description" rows="3"><?= old('description', $regime['description'] ?? '') ?></textarea></div></div>
            <div class="form-row-3">
                <div class="form-group"><label><i class="fas fa-euro-sign"></i> Prix par jour (€) *</label><input type="number" step="0.01" name="prix_par_jour" value="<?= old('prix_par_jour', $regime['prix_par_jour'] ?? '') ?>" required></div>
                <div class="form-group"><label><i class="fas fa-clock"></i> Durée (jours) *</label><input type="number" name="duree_jours" value="<?= old('duree_jours', $regime['duree_jours'] ?? '') ?>" required></div>
                <div class="form-group"><label><i class="fas fa-weight"></i> Variation (g/jour) *</label><input type="number" name="variation_poids_grammes" value="<?= old('variation_poids_grammes', $regime['variation_poids_grammes'] ?? '') ?>" required><small>Ex: +150 = prise, -100 = perte</small></div>
            </div>
            <div class="form-section">
                <h4><i class="fas fa-chart-pie"></i> Composition (doit totaliser 100%)</h4>
                <div class="form-row-3">
                    <div class="form-group"><label><i class="fas fa-drumstick-bite"></i> % Viande</label><input type="number" step="0.01" name="viande_pourc" id="viande" value="<?= old('viande_pourc', $viande_pourc ?? 33) ?>" required></div>
                    <div class="form-group"><label><i class="fas fa-fish"></i> % Poisson</label><input type="number" step="0.01" name="poisson_pourc" id="poisson" value="<?= old('poisson_pourc', $poisson_pourc ?? 33) ?>" required></div>
                    <div class="form-group"><label><i class="fas fa-egg"></i> % Volaille</label><input type="number" step="0.01" name="volaille_pourc" id="volaille" value="<?= old('volaille_pourc', $volaille_pourc ?? 34) ?>" required></div>
                </div>
                <div class="total-badge" id="totalDisplay">Total: <span id="totalPourcent">0</span>%</div>
            </div>
            <div class="form-actions"><button type="submit" class="btn-primary"><i class="fas fa-save"></i> <?= $regime ? 'Mettre à jour' : 'Enregistrer' ?></button><button type="button" class="btn-secondary" onclick="window.location.href='/admin/regimes'"><i class="fas fa-times"></i> Annuler</button></div>
        </form>
    </div>
</div>