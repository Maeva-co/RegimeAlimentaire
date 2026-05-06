// ============================================
// CODES JS - 2026
// ============================================

$(document).ready(function() {
    if($('#codesTable').length) {
        $('#codesTable').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/fr-FR.json'
            },
            pageLength: 10,
            responsive: true,
            order: [[0, 'desc']]
        });
    }
});

function submitCodeForm(url) {
    let code = $('#code').val().trim();
    if(code.length < 3) {
        showNotification('error', 'Le code doit contenir au moins 3 caractères');
        return;
    }
    
    let valeur = parseFloat($('#valeur').val());
    if(isNaN(valeur) || valeur <= 0) {
        showNotification('error', 'La valeur doit être un nombre positif');
        return;
    }
    
    $.ajax({
        url: url,
        method: 'POST',
        data: $('#codeForm').serialize(),
        beforeSend: showLoader,
        success: function(response) {
            showNotification('success', response.message || 'Code enregistré avec succès');
            setTimeout(() => {
                window.location.href = '/admin/codes';
            }, 1500);
        },
        error: function(xhr) {
            let response = xhr.responseJSON;
            showNotification('error', response?.message || 'Une erreur est survenue');
        },
        complete: hideLoader
    });
}

function deleteCode(id) {
    if(confirm('Supprimer définitivement ce code ?')) {
        $.ajax({
            url: `/admin/codes/delete/${id}`,
            method: 'GET',
            beforeSend: showLoader,
            success: function(response) {
                showNotification('success', 'Code supprimé avec succès');
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