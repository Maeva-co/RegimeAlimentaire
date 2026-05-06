// ============================================
// ADMIN JS GLOBAL 2026
// ============================================

// Global functions
function showLoader() { 
    $('#loadingOverlay').fadeIn(200); 
}

function hideLoader() { 
    $('#loadingOverlay').fadeOut(200); 
}

function showNotification(type, message) {
    let notification = $(`
        <div class="notification ${type}">
            <i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'}"></i>
            <span>${message}</span>
        </div>
    `);
    $('body').append(notification);
    notification.fadeIn(200);
    setTimeout(() => {
        notification.fadeOut(300, () => notification.remove());
    }, 3000);
}

$(document).ready(function() {
    // Auto-hide alerts after 4 seconds
    setTimeout(() => {
        $('.alert').fadeOut(500);
    }, 4000);
    
    // Smooth page transitions
    $(document).on('click', 'a:not([target="_blank"]):not([href^="http"]):not(.no-loader)', function(e) {
        let href = $(this).attr('href');
        if(href && href !== '#' && !href.startsWith('javascript')) {
            e.preventDefault();
            showLoader();
            setTimeout(() => {
                window.location.href = href;
            }, 300);
        }
    });
});