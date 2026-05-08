// ============================================
// CODES JS — Regime Expert 2026
// ============================================

'use strict';

$(document).ready(function() {
    if ($('#codesTable').length) {
        $('#codesTable').DataTable({
            language: { url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/fr-FR.json' },
            pageLength:  10,
            responsive:  true,
            order:       [[0, 'desc']]
        });
    }
});

function submitCodeForm(url) {
    if (!navigator.onLine) {
        showNotification('warning', 'Hors connexion', 'Impossible d\'enregistrer sans connexion');
        return;
    }

    const code = $('#code').val().trim();
    if (code.length < 3) {
        showNotification('error', 'Code invalide', 'Le code doit contenir au moins 3 caractères');
        return;
    }

    const valeur = parseFloat($('#valeur').val());
    if (isNaN(valeur) || valeur <= 0) {
        showNotification('error', 'Valeur invalide', 'La valeur doit être un nombre positif');
        return;
    }

    adminAjax({
        url,
        method: 'POST',
        data:   $('#codeForm').serialize(),
        success: function(res) {
            showNotification('success', 'Code enregistré', res.message || '');
            setTimeout(() => { window.location.href = '/admin/codes'; }, 1600);
        }
    });
}

function deleteCode(id) {
    if (!navigator.onLine) {
        showNotification('warning', 'Hors connexion', 'Impossible de supprimer sans connexion');
        return;
    }

    confirmDelete('Supprimer définitivement ce code promo ?', function() {
        adminAjax({
            url: `/admin/codes/delete/${id}`,
            success: function() {
                showNotification('success', 'Code supprimé');
                $(`#row-${id}`).fadeOut(350, function() { $(this).remove(); });
            }
        });
    });
}