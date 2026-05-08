<!-- Sports Form View -->
<div class="form-card">
    <div class="card-header">
        <div class="card-header-left">
            <div class="card-icon"><i class="fas fa-<?= isset($sport) ? 'pen' : 'plus' ?>"></i></div>
            <div>
                <h3><?= isset($sport) ? 'Modifier le sport' : 'Ajouter un sport' ?></h3>
                <div class="card-sub"><?= isset($sport) ? esc($sport['nom']) : 'Nouvel enregistrement' ?></div>
            </div>
        </div>
        <button class="btn btn-secondary btn-sm" onclick="navigateTo('/admin/sports')">
            <i class="fas fa-arrow-left"></i> Retour
        </button>
    </div>
    <div class="card-body">

        <form id="sportForm" onsubmit="event.preventDefault(); submitSportForm('/admin/sports/<?= isset($sport) ? "update/{$sport['id']}" : 'store' ?>');">

            <div class="form-row">
                <div class="form-group">
                    <label><i class="fas fa-tag"></i> Nom du sport *</label>
                    <input type="text" name="nom" id="nom"
                           value="<?= old('nom', $sport['nom'] ?? '') ?>"
                           placeholder="Ex: Course à pied, Natation…"
                           required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label><i class="fas fa-align-left"></i> Description</label>
                    <textarea name="description" rows="3" placeholder="Décrivez cette activité…"><?= old('description', $sport['description'] ?? '') ?></textarea>
                </div>
            </div>

            <div class="form-row-2">
                <div class="form-group">
                    <label><i class="fas fa-weight"></i> Variation de poids (g/séance) *</label>
                    <input type="number" name="variation_poids_grammes"
                           value="<?= old('variation_poids_grammes', $sport['variation_poids_grammes'] ?? '') ?>"
                           placeholder="Ex: -150 ou +100"
                           required>
                    <div class="form-hint"><i class="fas fa-info-circle"></i> Négatif = perte, positif = prise de masse</div>
                </div>
                <div class="form-group">
                    <label><i class="fas fa-fire"></i> Calories brûlées / heure</label>
                    <input type="number" name="calories_par_heure"
                           value="<?= old('calories_par_heure', $sport['calories_par_heure'] ?? '') ?>"
                           placeholder="Ex: 350">
                    <div class="form-hint"><i class="fas fa-info-circle"></i> Optionnel</div>
                </div>
            </div>

            <div class="form-actions">
                <button type="button" class="btn btn-secondary" onclick="navigateTo('/admin/sports')">
                    <i class="fas fa-times"></i> Annuler
                </button>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-check"></i> <?= isset($sport) ? 'Mettre à jour' : 'Enregistrer' ?>
                </button>
            </div>

        </form>
    </div>
</div>