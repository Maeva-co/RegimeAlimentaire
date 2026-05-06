<div class="form-card">
    <div class="card-header"><h3><i class="fas fa-<?= isset($code) ? 'edit' : 'plus' ?>"></i> <?= isset($code) ? 'Modifier' : 'Ajouter' ?> un code</h3><button class="btn-secondary" onclick="window.location.href='/admin/codes'"><i class="fas fa-arrow-left"></i> Retour</button></div>
    <div class="card-body">
        <form id="codeForm" onsubmit="event.preventDefault(); submitCodeForm('/admin/codes/<?= isset($code) ? "update/{$code['id']}" : 'store' ?>');">
            <div class="form-row-3">
                <div class="form-group"><label><i class="fas fa-code"></i> Code *</label><input type="text" name="code" id="code" value="<?= old('code', $code['code'] ?? '') ?>" required><small>Ex: PROMO20, BIENVENUE10</small></div>
                <div class="form-group"><label><i class="fas fa-euro-sign"></i> Valeur (€) *</label><input type="number" step="0.01" name="valeur" id="valeur" value="<?= old('valeur', $code['valeur'] ?? '') ?>" required></div>
                <div class="form-group"><label><i class="fas fa-calendar"></i> Date d'expiration</label><input type="date" name="expire_le" value="<?= old('expire_le', $code['expire_le'] ?? '') ?>"><small>Optionnel</small></div>
            </div>
            <div class="form-actions"><button type="submit" class="btn-primary"><i class="fas fa-save"></i> <?= isset($code) ? 'Mettre à jour' : 'Enregistrer' ?></button><button type="button" class="btn-secondary" onclick="window.location.href='/admin/codes'"><i class="fas fa-times"></i> Annuler</button></div>
        </form>
    </div>
</div>