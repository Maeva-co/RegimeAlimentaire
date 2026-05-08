<!-- Welcome Banner -->
<div class="welcome-banner">
    <div class="welcome-text">
        <h2>Bonjour, <?= esc(session()->get('user')['nom'] ?? 'Admin') ?> 👋</h2>
        <p>Voici un aperçu de votre plateforme aujourd'hui · <?= date('d F Y') ?></p>
    </div>
    <div class="welcome-emoji">🥗</div>
</div>

<!-- Stats Grid -->
<div class="stats-grid">

    <div class="stat-card">
        <div class="stat-icon blue"><i class="fas fa-users"></i></div>
        <div class="stat-info">
            <div class="stat-value"><?= $totalUsers ?? 0 ?></div>
            <div class="stat-label">Utilisateurs inscrits</div>
            <div class="stat-trend up"><i class="fas fa-arrow-up"></i> Actifs</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon green"><i class="fas fa-apple-alt"></i></div>
        <div class="stat-info">
            <div class="stat-value"><?= $totalRegimes ?? 0 ?></div>
            <div class="stat-label">Régimes disponibles</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon orange"><i class="fas fa-running"></i></div>
        <div class="stat-info">
            <div class="stat-value"><?= $totalSports ?? 0 ?></div>
            <div class="stat-label">Activités sportives</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon purple"><i class="fas fa-ticket-alt"></i></div>
        <div class="stat-info">
            <div class="stat-value"><?= $codesUtilises ?? 0 ?><span style="font-size:16px;font-weight:400;color:var(--ink-muted);">/<?= $totalCodes ?? 0 ?></span></div>
            <div class="stat-label">Codes utilisés</div>
        </div>
    </div>

</div>

<!-- Charts Row -->
<div class="charts-row">

    <div class="chart-card">
        <div class="card-header">
            <div class="card-header-left">
                <div class="card-icon"><i class="fas fa-chart-bar"></i></div>
                <div>
                    <h3>Régimes alimentaires</h3>
                    <div class="card-sub">Variation de poids en g/jour</div>
                </div>
            </div>
        </div>
        <div class="chart-body">
            <canvas id="regimesChart" height="220"></canvas>
        </div>
    </div>

    <div class="chart-card">
        <div class="card-header">
            <div class="card-header-left">
                <div class="card-icon"><i class="fas fa-chart-line"></i></div>
                <div>
                    <h3>Activités sportives</h3>
                    <div class="card-sub">Variation de poids en g/séance</div>
                </div>
            </div>
        </div>
        <div class="chart-body">
            <canvas id="sportsChart" height="220"></canvas>
        </div>
    </div>

</div>

<!-- Recent Users -->
<div class="data-card">
    <div class="card-header">
        <div class="card-header-left">
            <div class="card-icon"><i class="fas fa-user-plus"></i></div>
            <div>
                <h3>Dernières inscriptions</h3>
                <div class="card-sub">Utilisateurs récemment inscrits</div>
            </div>
        </div>
    </div>
    <div class="card-body" style="padding:0;">
        <div class="data-table-wrap">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Utilisateur</th>
                        <th>Email</th>
                        <th>Rôle</th>
                        <th>Balance</th>
                        <th>Inscription</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($recentUsers ?? [] as $user): ?>
                    <tr>
                        <td>
                            <div style="display:flex;align-items:center;gap:10px;">
                                <div style="
                                    width:32px;height:32px;border-radius:10px;
                                    background:var(--jade-light);color:var(--jade-deep);
                                    display:flex;align-items:center;justify-content:center;
                                    font-weight:700;font-size:13px;flex-shrink:0;">
                                    <?= strtoupper(substr($user['nom'], 0, 1)) ?>
                                </div>
                                <strong><?= esc($user['nom']) ?></strong>
                            </div>
                        </td>
                        <td><?= esc($user['email']) ?></td>
                        <td>
                            <span class="role-pill <?= $user['role'] === 'admin' ? 'admin' : 'user' ?>">
                                <?= esc($user['role']) ?>
                            </span>
                        </td>
                        <td><strong><?= number_format($user['balance'], 2) ?> €</strong></td>
                        <td style="color:var(--ink-muted);font-size:13px;">
                            <?= date('d/m/Y H:i', strtotime($user['created_at'])) ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>