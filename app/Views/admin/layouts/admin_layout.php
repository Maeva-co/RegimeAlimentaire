<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Back Office') ?> — Regime Expert</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700;800&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;1,9..40,400&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

    <!-- App CSS -->
    <link href="/assets/css/admin.css" rel="stylesheet">
    <link href="/assets/css/responsive.css" rel="stylesheet">
</head>
<body>
<div class="admin-wrapper">

    <!-- ══ SIDEBAR ════════════════════════════ -->
    <aside class="sidebar">

        <div class="sidebar-header">
            <a href="/admin/dashboard" class="logo no-loader">
                <div class="logo-mark"><i class="fas fa-leaf"></i></div>
                <div class="logo-text">
                    <strong>DietBalance</strong>
                    <small>Back Office</small>
                </div>
            </a>
            <div class="role-badge">Administrateur</div>
        </div>

        <nav class="sidebar-nav">
            <span class="nav-section-label">Navigation</span>

            <a href="/admin/dashboard"
               class="nav-link <?= current_url() == base_url('/admin/dashboard') ? 'active' : '' ?>">
                <span class="nav-icon"><i class="fas fa-chart-line"></i></span>
                <span class="nav-label">Dashboard</span>
            </a>

            <a href="/admin/regimes"
               class="nav-link <?= strpos(current_url(), '/admin/regimes') !== false ? 'active' : '' ?>">
                <span class="nav-icon"><i class="fas fa-apple-alt"></i></span>
                <span class="nav-label">Régimes</span>
            </a>

            <a href="/admin/sports"
               class="nav-link <?= strpos(current_url(), '/admin/sports') !== false ? 'active' : '' ?>">
                <span class="nav-icon"><i class="fas fa-running"></i></span>
                <span class="nav-label">Sports</span>
            </a>

            <a href="/admin/codes"
               class="nav-link <?= strpos(current_url(), '/admin/codes') !== false ? 'active' : '' ?>">
                <span class="nav-icon"><i class="fas fa-ticket-alt"></i></span>
                <span class="nav-label">Codes promo</span>
            </a>

            <span class="nav-section-label">Système</span>

            <a href="/admin/parametres"
               class="nav-link <?= strpos(current_url(), '/admin/parametres') !== false ? 'active' : '' ?>">
                <span class="nav-icon"><i class="fas fa-sliders-h"></i></span>
                <span class="nav-label">Paramètres</span>
            </a>
        </nav>

        <div class="sidebar-footer">
            <div class="user-card">
                <div class="user-avatar">
                    <?= strtoupper(substr(session()->get('user')['nom'] ?? 'A', 0, 1)) ?>
                </div>
                <div class="user-info">
                    <strong><?= esc(session()->get('user')['nom'] ?? 'Administrateur') ?></strong>
                    <small><?= esc(session()->get('user')['email'] ?? '') ?></small>
                </div>
            </div>
            <a href="/logout" class="logout-btn no-loader">
                <i class="fas fa-sign-out-alt"></i>
                <span>Déconnexion</span>
            </a>
        </div>

    </aside>

    <!-- ══ MAIN CONTENT ═══════════════════════ -->
    <main class="main-content">

        <!-- Topbar -->
        <div class="content-topbar">
            <div class="topbar-left">
                <h1><?= esc($title ?? 'Tableau de bord') ?></h1>
                <div class="breadcrumb">
                    <i class="fas fa-home" style="color:var(--jade);font-size:11px;"></i>
                    Admin › <?= esc($title ?? 'Dashboard') ?>
                </div>
            </div>
            <div class="topbar-right">
                <div class="topbar-date">
                    <i class="far fa-calendar-alt"></i>
                    <?= date('d M Y') ?>
                </div>
            </div>
        </div>

        <!-- Page body -->
        <div class="content-body">
            <?= $content ?? '' ?>
        </div>

    </main>

</div>

<!-- Loading overlay (created by JS) -->

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- DataTables -->
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<!-- Admin JS -->
<script src="/assets/js/admin.js"></script>

<!-- Conditional JS per page -->
<?php if ($title === 'Tableau de bord'): ?>
<script src="/assets/js/dashboard.js"></script>
<?php elseif (strpos($title ?? '', 'égime') !== false): ?>
<script src="/assets/js/regimes.js"></script>
<?php elseif (strpos($title ?? '', 'port') !== false): ?>
<script src="/assets/js/sports.js"></script>
<?php elseif (strpos($title ?? '', 'ode') !== false): ?>
<script src="/assets/js/codes.js"></script>
<?php elseif (strpos($title ?? '', 'aram') !== false): ?>
<script src="/assets/js/parametres.js"></script>
<?php endif; ?>

</body>
</html>