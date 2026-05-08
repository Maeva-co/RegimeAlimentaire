<!-- Regimes Form View -->
<div class="form-card">
    <div class="card-header">
        <div class="card-header-left">
            <div class="card-icon"><i class="fas fa-<?= $regime ? 'pen' : 'plus' ?>"></i></div>
            <div>
                <h3><?= $regime ? 'Modifier le régime' : 'Ajouter un régime' ?></h3>
                <div class="card-sub"><?= $regime ? esc($regime['nom']) : 'Nouveau programme nutritionnel' ?></div>
            </div>
        </div>
        <button class="btn btn-secondary btn-sm" onclick="navigateTo('/admin/regimes')">
            <i class="fas fa-arrow-left"></i> Retour
        </button>
    </div>
    <div class="card-body">

        <form id="regimeForm" onsubmit="event.preventDefault(); submitRegimeForm('/admin/regimes/<?= $regime ? "update/{$regime['id']}" : 'store' ?>');">

            <div class="form-row">
                <div class="form-group">
                    <label><i class="fas fa-tag"></i> Nom du régime *</label>
                    <input type="text" name="nom"
                           value="<?= old('nom', $regime['nom'] ?? '') ?>"
                           placeholder="Ex: Régime cétogène, Méditerranéen…"
                           required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label><i class="fas fa-align-left"></i> Description</label>
                    <textarea name="description" rows="3" placeholder="Décrivez ce régime, ses bénéfices…"><?= old('description', $regime['description'] ?? '') ?></textarea>
                </div>
            </div>

            <div class="form-row-3">
                <div class="form-group">
                    <label><i class="fas fa-euro-sign"></i> Prix par jour (€) *</label>
                    <input type="number" step="0.01" name="prix_par_jour"
                           value="<?= old('prix_par_jour', $regime['prix_par_jour'] ?? '') ?>"
                           placeholder="Ex: 15.00" required>
                </div>
                <div class="form-group">
                    <label><i class="fas fa-clock"></i> Durée (jours) *</label>
                    <input type="number" name="duree_jours"
                           value="<?= old('duree_jours', $regime['duree_jours'] ?? '') ?>"
                           placeholder="Ex: 30" required>
                </div>
                <div class="form-group">
                    <label><i class="fas fa-weight"></i> Variation poids (g/jour) *</label>
                    <input type="number" name="variation_poids_grammes"
                           value="<?= old('variation_poids_grammes', $regime['variation_poids_grammes'] ?? '') ?>"
                           placeholder="Ex: -100 ou +50" required>
                    <div class="form-hint"><i class="fas fa-info-circle"></i> Négatif = perte, positif = prise</div>
                </div>
            </div>

            <!-- Composition section -->
            <div class="form-section">
                <div class="form-section-title">
                    <i class="fas fa-chart-pie"></i>
                    Composition protéique — total doit être 100 %
                </div>
                <div class="form-row-3">
                    <div class="form-group">
                        <label><i class="fas fa-drumstick-bite"></i> % Viande</label>
                        <input type="number" step="0.01" name="viande_pourc" id="viande"
                               value="<?= old('viande_pourc', $viande_pourc ?? 33) ?>"
                               min="0" max="100" required>
                    </div>
                    <div class="form-group">
                        <label><i class="fas fa-fish"></i> % Poisson</label>
                        <input type="number" step="0.01" name="poisson_pourc" id="poisson"
                               value="<?= old('poisson_pourc', $poisson_pourc ?? 33) ?>"
                               min="0" max="100" required>
                    </div>
                    <div class="form-group">
                        <label><i class="fas fa-egg"></i> % Volaille</label>
                        <input type="number" step="0.01" name="volaille_pourc" id="volaille"
                               value="<?= old('volaille_pourc', $volaille_pourc ?? 34) ?>"
                               min="0" max="100" required>
                    </div>
                </div>
                <div class="total-badge" id="totalDisplay">
                    Total : <span id="totalPourcent">0</span> %
                </div>
            </div>

            <div class="form-actions">
                <button type="button" class="btn btn-secondary" onclick="navigateTo('/admin/regimes')">
                    <i class="fas fa-times"></i> Annuler
                </button>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-check"></i> <?= $regime ? 'Mettre à jour' : 'Enregistrer' ?>
                </button>
            </div>

        </form>
    </div>
</div>