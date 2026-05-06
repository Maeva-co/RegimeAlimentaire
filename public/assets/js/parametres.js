// ============================================
// PARAMETRES JS - 2026
// ============================================

function submitParametreForm(url) {
    let valeur = $('#valeur').val().trim();
    if(valeur === '') {
        showNotification('error', 'La valeur ne peut pas être vide');
        return;
    }
    
    $.ajax({
        url: url,
        method: 'POST',
        data: $('#parametreForm').serialize(),
        beforeSend: showLoader,
        success: function(response) {
            showNotification('success', 'Paramètre mis à jour avec succès');
            setTimeout(() => {
                window.location.href = '/admin/parametres';
            }, 1500);
        },
        error: function(xhr) {
            let response = xhr.responseJSON;
            showNotification('error', response?.message || 'Une erreur est survenue');
        },
        complete: hideLoader
    });
}