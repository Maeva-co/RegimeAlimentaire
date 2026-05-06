// ============================================
// REGIMES JS - 2026
// ============================================

$(document).ready(function() {
    // Initialize DataTable
    if($('#regimesTable').length) {
        $('#regimesTable').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/fr-FR.json'
            },
            pageLength: 10,
            responsive: true
        });
    }
    
    // Initialize form validation
    if($('#regimeForm').length) {
        updateTotal();
        $('#viande, #poisson, #volaille').on('input', updateTotal);
    }
});

function updateTotal() {
    let viande = parseFloat($('#viande').val()) || 0;
    let poisson = parseFloat($('#poisson').val()) || 0;
    let volaille = parseFloat($('#volaille').val()) || 0;
    let total = viande + poisson + volaille;
    
    $('#totalPourcent').text(total.toFixed(2));
    
    if(Math.abs(total - 100) > 0.01) {
        $('#totalDisplay').addClass('error');
    } else {
        $('#totalDisplay').removeClass('error');
    }
}

function submitRegimeForm(url) {
    let viande = parseFloat($('#viande').val()) || 0;
    let poisson = parseFloat($('#poisson').val()) || 0;
    let volaille = parseFloat($('#volaille').val()) || 0;
    let total = viande + poisson + volaille;
    
    if(Math.abs(total - 100) > 0.01) {
        showNotification('error', 'La somme des pourcentages doit être égale à 100%');
        return;
    }
    
    $.ajax({
        url: url,
        method: 'POST',
        data: $('#regimeForm').serialize(),
        beforeSend: showLoader,
        success: function(response) {
            if(response.success || response.message) {
                showNotification('success', response.message || 'Régime enregistré avec succès');
                setTimeout(() => {
                    window.location.href = '/admin/regimes';
                }, 1500);
            } else {
                showNotification('success', 'Opération réussie');
                setTimeout(() => {
                    window.location.href = '/admin/regimes';
                }, 1500);
            }
        },
        error: function(xhr) {
            let response = xhr.responseJSON;
            if(response && response.message) {
                showNotification('error', response.message);
            } else {
                showNotification('error', 'Une erreur est survenue');
            }
        },
        complete: hideLoader
    });
}

function deleteRegime(id, nom) {
    if(confirm(`Supprimer définitivement le régime "${nom}" ? Cette action est irréversible.`)) {
        $.ajax({
            url: `/admin/regimes/delete/${id}`,
            method: 'GET',
            beforeSend: showLoader,
            success: function(response) {
                showNotification('success', 'Régime supprimé avec succès');
                $(`#row-${id}`).fadeOut(300, function() {
                    $(this).remove();
                });
            },
            error: function() {
                showNotification('error', 'Erreur lors de la suppression');
            },
            complete: hideLoader
        });
    }
}