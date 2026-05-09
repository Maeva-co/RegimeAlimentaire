<!-- Codes Form View -->
<div class="form-card">
    <div class="card-header">
        <div class="card-header-left">
            <div class="card-icon"><i class="fas fa-<?= isset($code) ? 'pen' : 'plus' ?>"></i></div>
            <div>
                <h3><?= isset($code) ? 'Modifier le code' : 'Ajouter un code' ?></h3>
                <div class="card-sub"><?= isset($code) ? esc($code['code']) : 'Nouveau code promotionnel' ?></div>
            </div>
        </div>
        <button class="btn btn-secondary btn-sm" onclick="navigateTo('/admin/codes')">
            <i class="fas fa-arrow-left"></i> Retour
        </button>
    </div>
    <div class="card-body">

        <form id="codeForm" onsubmit="event.preventDefault(); submitCodeForm('/admin/codes/<?= isset($code) ? "update/{$code['id']}" : 'store' ?>');">
            
            <?= csrf_field() ?>
            
            <div class="form-row-3">
                <div class="form-group">
                    <label><i class="fas fa-hashtag"></i> Code promo *</label>
                    <input type="text" name="code" id="code"
                           value="<?= old('code', $code['code'] ?? '') ?>"
                           placeholder="Ex: BIENVENUE20"
                           style="text-transform:uppercase;"
                           required>
                    <div class="form-hint"><i class="fas fa-info-circle"></i> Min. 3 caractères</div>
                </div>
                <div class="form-group">
                    <label><i class="fas fa-euro-sign"></i> Valeur (€) *</label>
                    <input type="number" step="0.01" name="valeur" id="valeur"
                           value="<?= old('valeur', $code['valeur'] ?? '') ?>"
                           placeholder="Ex: 10.00" 
                           required>
                </div>
                <div class="form-group">
                    <label><i class="fas fa-calendar-alt"></i> Date d'expiration</label>
                    <input type="date" name="expire_le" id="expire_le"
                           value="<?= old('expire_le', $code['expire_le'] ?? '') ?>">
                    <div class="form-hint"><i class="fas fa-info-circle"></i> Optionnel</div>
                </div>
            </div>

            <div class="form-actions">
                <button type="button" class="btn btn-secondary" onclick="navigateTo('/admin/codes')">
                    <i class="fas fa-times"></i> Annuler
                </button>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-check"></i> <?= isset($code) ? 'Mettre à jour' : 'Enregistrer' ?>
                </button>
            </div>

        </form>
    </div>
</div>