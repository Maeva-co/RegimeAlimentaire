<div class="stats-grid">
    <div class="stat-card"><div class="stat-icon blue"><i class="fas fa-users"></i></div><div class="stat-data"><h3><?= $totalUsers ?? 0 ?></h3><p>Utilisateurs</p></div></div>
    <div class="stat-card"><div class="stat-icon green"><i class="fas fa-apple-alt"></i></div><div class="stat-data"><h3><?= $totalRegimes ?? 0 ?></h3><p>Régimes</p></div></div>
    <div class="stat-card"><div class="stat-icon orange"><i class="fas fa-running"></i></div><div class="stat-data"><h3><?= $totalSports ?? 0 ?></h3><p>Sports</p></div></div>
    <div class="stat-card"><div class="stat-icon purple"><i class="fas fa-ticket-alt"></i></div><div class="stat-data"><h3><?= $codesUtilises ?? 0 ?>/<?= $totalCodes ?? 0 ?></h3><p>Codes utilisés</p></div></div>
</div>

<div class="charts-row">
    <div class="chart-card"><div class="chart-header"><h3><i class="fas fa-chart-bar"></i> Variation de poids par régime</h3></div><div class="chart-body"><canvas id="regimesChart" height="250"></canvas></div></div>
    <div class="chart-card"><div class="chart-header"><h3><i class="fas fa-chart-line"></i> Impact des sports</h3></div><div class="chart-body"><canvas id="sportsChart" height="250"></canvas></div></div>
</div>

<div class="data-card">
    <div class="card-header"><h3><i class="fas fa-user-plus"></i> Derniers utilisateurs inscrits</h3></div>
    <div class="card-body">
        <table class="data-table">
            <thead><tr><th>Nom</th><th>Email</th><th>Rôle</th><th>Balance</th><th>Date d'inscription</th></tr></thead>
            <tbody>
                <?php foreach($recentUsers ?? [] as $user): ?>
                <tr><td><?= esc($user['nom']) ?></td><td><?= esc($user['email']) ?></td><td><span class="variation-badge <?= $user['role'] === 'admin' ? 'positive' : 'negative' ?>"><?= $user['role'] ?></span></td><td><?= number_format($user['balance'], 2) ?> €</td><td><?= date('d/m/Y H:i', strtotime($user['created_at'])) ?></td></tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>