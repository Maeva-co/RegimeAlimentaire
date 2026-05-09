<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($titre) ?></title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:wght@500;600;700&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link href="/assets/css/regime.css" rel="stylesheet">
</head>
<body class="regime-page">
    <header class="regime-hero">
        <div>
            <a class="back-link" href="/hero">Retour aux objectifs</a>
            <h1><?= esc($titre) ?></h1>
            <p><?= esc($intro) ?></p>
        </div>
        <div class="hero-chip"><?= esc($mode) ?></div>
    </header>

    <main class="regime-layout">
        <section class="user-summary">
            <h2>Bilan utilisateur</h2>
            <div class="summary-grid">
                <div>
                    <span>Nom</span>
                    <strong><?= esc($user['nom']) ?></strong>
                </div>
                <div>
                <span>Genre</span>
                    <strong><?= esc($user['genre']) ?></strong>
                </div>
                <div>
                    <span>Poids</span>
                    <strong><?= esc($user['poids']) ?> kg</strong>
                </div>
                <div>
                    <span>Taille</span>
                    <strong><?= esc($user['taille']) ?> cm</strong>
                </div>
                <div>
                    <span>IMC</span>
                    <strong><?= esc($user['IMC']) ?></strong>
                </div>
            </div>
        </section>

        <section class="regime-results">
            <div class="section-head">
                <h2>Recommandations</h2>
                <span><?= count($regimes) ?> regime(s)</span>
            </div>

            <?php if ($mode === 'imc'): ?>
                <div class="empty-state">
                    Les recommandations pour l'IMC ideal seront disponibles bientot.
                </div>
            <?php elseif (!$regimes): ?>
                <div class="empty-state">
                    Aucun regime disponible pour cet objectif.
                </div>
            <?php else: ?>
                <div class="regime-grid">
                    <?php foreach ($regimes as $regime): ?>
                        <article class="regime-card">
                            <div class="regime-title">
                                <?= esc($regime['nom']) ?>
                                <span class="tag">
                                    <?= esc($regime['variation_poids_grammes']) ?> g/j
                                </span>
                            </div>
                            <p><?= esc($regime['description']) ?></p>
                            <div class="regime-meta">
                                <span><?= esc($regime['duree_jours']) ?> jours</span>
                                <span><?= esc($regime['prix_par_jour']) ?> $/jour</span>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </section>
    </main>
</body>
</html>
