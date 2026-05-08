<!-- Parametres Form View -->
<div class="form-card">
    <div class="card-header">
        <div class="card-header-left">
            <div class="card-icon"><i class="fas fa-sliders-h"></i></div>
            <div>
                <h3>Modifier le paramètre</h3>
                <div class="card-sub"><?= esc($parametre['cle']) ?></div>
            </div>
        </div>
        <button class="btn btn-secondary btn-sm" onclick="navigateTo('/admin/parametres')">
            <i class="fas fa-arrow-left"></i> Retour
        </button>
    </div>
    <div class="card-body">

        <form id="parametreForm" onsubmit="event.preventDefault(); submitParametreForm('/admin/parametres/update/<?= $parametre['id'] ?>');">

            <div class="form-row">
                <div class="form-group">
                    <label><i class="fas fa-key"></i> Clé</label>
                    <input type="text" value="<?= esc($parametre['cle']) ?>" disabled>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label><i class="fas fa-pencil-alt"></i> Valeur *</label>
                    <input type="text" name="valeur" id="valeur"
                           value="<?= old('valeur', $parametre['valeur']) ?>"
                           required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label><i class="fas fa-circle-info"></i> Description</label>
                    <textarea rows="2" disabled><?= esc($parametre['description']) ?></textarea>
                </div>
            </div>

            <div class="form-actions">
                <button type="button" class="btn btn-secondary" onclick="navigateTo('/admin/parametres')">
                    <i class="fas fa-times"></i> Annuler
                </button>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-check"></i> Mettre à jour
                </button>
            </div>

        </form>
    </div>
</div>