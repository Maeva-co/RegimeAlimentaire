// ============================================
// SPORTS JS - 2026
// ============================================

$(document).ready(function() {
    if($('#sportsTable').length) {
        $('#sportsTable').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/fr-FR.json'
            },
            pageLength: 10,
            responsive: true
        });
    }
});

function submitSportForm(url) {
    let nom = $('#nom').val().trim();
    if(nom.length < 3) {
        showNotification('error', 'Le nom doit contenir au moins 3 caractères');
        return;
    }
    
    $.ajax({
        url: url,
        method: 'POST',
        data: $('#sportForm').serialize(),
        beforeSend: showLoader,
        success: function(response) {
            showNotification('success', response.message || 'Sport enregistré avec succès');
            setTimeout(() => {
                window.location.href = '/admin/sports';
            }, 1500);
        },
        error: function(xhr) {
            let response = xhr.responseJSON;
            showNotification('error', response?.message || 'Une erreur est survenue');
        },
        complete: hideLoader
    });
}

function deleteSport(id) {
    if(confirm('Supprimer définitivement ce sport ?')) {
        $.ajax({
            url: `/admin/sports/delete/${id}`,
            method: 'GET',
            beforeSend: showLoader,
            success: function(response) {
                showNotification('success', 'Sport supprimé avec succès');
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