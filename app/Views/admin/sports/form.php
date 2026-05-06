<div class="form-card">
    <div class="card-header"><h3><i class="fas fa-<?= isset($sport) ? 'edit' : 'plus' ?>"></i> <?= isset($sport) ? 'Modifier' : 'Ajouter' ?> un sport</h3><button class="btn-secondary" onclick="window.location.href='/admin/sports'"><i class="fas fa-arrow-left"></i> Retour</button></div>
    <div class="card-body">
        <form id="sportForm" onsubmit="event.preventDefault(); submitSportForm('/admin/sports/<?= isset($sport) ? "update/{$sport['id']}" : 'store' ?>');">
            <div class="form-row"><div class="form-group"><label><i class="fas fa-tag"></i> Nom du sport *</label><input type="text" name="nom" id="nom" value="<?= old('nom', $sport['nom'] ?? '') ?>" required></div></div>
            <div class="form-row"><div class="form-group"><label><i class="fas fa-align-left"></i> Description</label><textarea name="description" rows="3"><?= old('description', $sport['description'] ?? '') ?></textarea></div></div>
            <div class="form-row-3">
                <div class="form-group"><label><i class="fas fa-weight"></i> Variation (g/séance) *</label><input type="number" name="variation_poids_grammes" value="<?= old('variation_poids_grammes', $sport['variation_poids_grammes'] ?? '') ?>" required><small>Ex: -150 = perte, +100 = prise</small></div>
                <div class="form-group"><label><i class="fas fa-fire"></i> Calories par heure</label><input type="number" name="calories_par_heure" value="<?= old('calories_par_heure', $sport['calories_par_heure'] ?? '') ?>"><small>Optionnel</small></div>
            </div>
            <div class="form-actions"><button type="submit" class="btn-primary"><i class="fas fa-save"></i> <?= isset($sport) ? 'Mettre à jour' : 'Enregistrer' ?></button><button type="button" class="btn-secondary" onclick="window.location.href='/admin/sports'"><i class="fas fa-times"></i> Annuler</button></div>
        </form>
    </div>
</div>