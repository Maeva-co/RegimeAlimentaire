<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Back Office' ?> - Regime Expert</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link href="/assets/css/admin.css" rel="stylesheet">
    <link href="/assets/css/responsive.css" rel="stylesheet">
</head>
<body>
    <div class="admin-wrapper">
        <aside class="sidebar">
            <div class="sidebar-header">
                <div class="logo"><i class="fas fa-leaf"></i><span>Regime Expert</span></div>
                <div class="role-badge">Administrateur</div>
            </div>
            <nav class="sidebar-nav">
                <a href="/admin/dashboard" class="nav-link <?= current_url() == base_url('/admin/dashboard') ? 'active' : '' ?>"><i class="fas fa-chart-line"></i><span>Dashboard</span></a>
                <a href="/admin/regimes" class="nav-link <?= strpos(current_url(), '/admin/regimes') !== false ? 'active' : '' ?>"><i class="fas fa-apple-alt"></i><span>Régimes</span></a>
                <a href="/admin/sports" class="nav-link <?= strpos(current_url(), '/admin/sports') !== false ? 'active' : '' ?>"><i class="fas fa-running"></i><span>Sports</span></a>
                <a href="/admin/codes" class="nav-link <?= strpos(current_url(), '/admin/codes') !== false ? 'active' : '' ?>"><i class="fas fa-ticket-alt"></i><span>Codes</span></a>
                <a href="/admin/parametres" class="nav-link <?= strpos(current_url(), '/admin/parametres') !== false ? 'active' : '' ?>"><i class="fas fa-cog"></i><span>Paramètres</span></a>
            </nav>
            <div class="sidebar-footer">
                <div class="user-card"><i class="fas fa-user-circle"></i><div class="user-info"><strong><?= session()->get('user')['nom'] ?? 'Admin' ?></strong><small><?= session()->get('user')['email'] ?? '' ?></small></div></div>
                <a href="/logout" class="logout-btn"><i class="fas fa-sign-out-alt"></i><span>Déconnexion</span></a>
            </div>
        </aside>
        
        <main class="main-content">
            <div class="content-header"><h1><?= $title ?? 'Tableau de bord' ?></h1><div class="date-display"><i class="far fa-calendar-alt"></i> <?= date('d/m/Y') ?></div></div>
            <div class="content-body"><?= $content ?? '' ?></div>
        </main>
    </div>
    
    <div class="loading-overlay" id="loadingOverlay"><div class="spinner"></div><p>Chargement...</p></div>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="/assets/js/admin.js"></script>
    
    <?php if($title === 'Tableau de bord'): ?>
    <script src="/assets/js/dashboard.js"></script>
    <?php elseif(strpos($title ?? '', 'régime') !== false || strpos($title ?? '', 'Régime') !== false): ?>
    <script src="/assets/js/regimes.js"></script>
    <?php elseif(strpos($title ?? '', 'sport') !== false || strpos($title ?? '', 'Sport') !== false): ?>
    <script src="/assets/js/sports.js"></script>
    <?php elseif(strpos($title ?? '', 'Code') !== false || strpos($title ?? '', 'code') !== false): ?>
    <script src="/assets/js/codes.js"></script>
    <?php elseif(strpos($title ?? '', 'Paramètre') !== false || strpos($title ?? '', 'paramètre') !== false): ?>
    <script src="/assets/js/parametres.js"></script>
    <?php endif; ?>
</body>
</html>