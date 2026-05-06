<div class="form-card">
    <div class="card-header"><h3><i class="fas fa-cog"></i> Modifier le paramètre</h3><button class="btn-secondary" onclick="window.location.href='/admin/parametres'"><i class="fas fa-arrow-left"></i> Retour</button></div>
    <div class="card-body">
        <form id="parametreForm" onsubmit="event.preventDefault(); submitParametreForm('/admin/parametres/update/<?= $parametre['id'] ?>');">
            <div class="form-row">
                <div class="form-group"><label><i class="fas fa-key"></i> Clé</label><input type="text" value="<?= esc($parametre['cle']) ?>" disabled style="background: #f5f5f5;"></div>
                <div class="form-group"><label><i class="fas fa-value"></i> Valeur *</label><input type="text" name="valeur" id="valeur" value="<?= old('valeur', $parametre['valeur']) ?>" required></div>
                <div class="form-group"><label><i class="fas fa-info-circle"></i> Description</label><textarea rows="2" disabled style="background: #f5f5f5;"><?= esc($parametre['description']) ?></textarea></div>
            </div>
            <div class="form-actions"><button type="submit" class="btn-primary"><i class="fas fa-save"></i> Mettre à jour</button><button type="button" class="btn-secondary" onclick="window.location.href='/admin/parametres'"><i class="fas fa-times"></i> Annuler</button></div>
        </form>
    </div>
</div>