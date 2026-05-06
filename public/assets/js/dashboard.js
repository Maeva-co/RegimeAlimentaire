// ============================================
// DASHBOARD JS - 2026
// ============================================

$(document).ready(function() {
    loadDashboardStats();
    
    // Auto-refresh every 30 seconds
    setInterval(loadDashboardStats, 30000);
});

function loadDashboardStats() {
    $.ajax({
        url: '/admin/dashboard/stats',
        method: 'GET',
        dataType: 'json',
        beforeSend: showLoader,
        success: function(data) {
            // Update stats cards if needed
            if(data.stats) {
                $('.stat-card').each(function(index) {
                    let values = [data.stats.users, data.stats.regimes, data.stats.sports, data.stats.codes];
                    $(this).find('h3').text(values[index] || 0);
                });
            }
            
            // Render regimes chart
            if(data.regimes && data.regimes.length) {
                renderChart('regimesChart', 'bar', 
                    data.regimes.map(r => r.nom),
                    data.regimes.map(r => r.variation_poids_grammes),
                    'Variation de poids (g/jour)',
                    '#2ecc71'
                );
            }
            
            // Render sports chart
            if(data.sports && data.sports.length) {
                renderChart('sportsChart', 'bar',
                    data.sports.map(s => s.nom),
                    data.sports.map(s => s.variation_poids_grammes),
                    'Variation (g/séance)',
                    '#3498db'
                );
            }
        },
        error: function() {
            console.error('Erreur chargement statistiques');
        },
        complete: hideLoader
    });
}

function renderChart(canvasId, type, labels, data, label, color) {
    const ctx = document.getElementById(canvasId);
    if(ctx) {
        // Destroy existing chart if any
        if(ctx.chart) {
            ctx.chart.destroy();
        }
        
        ctx.chart = new Chart(ctx.getContext('2d'), {
            type: type,
            data: {
                labels: labels,
                datasets: [{
                    label: label,
                    data: data,
                    backgroundColor: color + '40',
                    borderColor: color,
                    borderWidth: 2,
                    borderRadius: 8,
                    barPercentage: 0.7
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: { font: { size: 12 } }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.raw + ' g';
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        title: { display: true, text: 'Grammes', font: { size: 12 } }
                    },
                    x: {
                        ticks: { rotation: -45, autoSkip: true, maxRotation: 45, minRotation: 45 }
                    }
                }
            }
        });
    }
}