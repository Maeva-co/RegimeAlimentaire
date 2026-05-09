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

        <?php if ($mode === 'perdre' || $mode === 'gagner'): ?>
            <?php $exportUrl = $mode === 'perdre' ? '/regime/perdre/pdf' : '/regime/gagner/pdf'; ?>
            <section class="programme-form">
                <div>
                    <h2>Choisissez votre programme maintenant</h2>
                    <p>Indiquez la variation de poids desiree pour generer votre PDF.</p>
                </div>

                <?php if (session()->getFlashdata('erreur')): ?>
                    <div class="alert alert-error">
                        <?= esc(session()->getFlashdata('erreur')) ?>
                    </div>
                <?php endif; ?>

                <form action="<?= esc($exportUrl) ?>" method="POST">
                    <?= csrf_field() ?>
                    <label for="target_kg">Variation (kg)</label>
                    <div class="programme-input">
                        <input
                            type="number"
                            id="target_kg"
                            name="target_kg"
                            min="0.1"
                            step="0.1"
                            value="<?= esc(old('target_kg') ?? '') ?>"
                            required>
                        <button type="submit">Exporter le PDF</button>
                    </div>
                </form>
            </section>
        <?php endif; ?>

        <section class="regime-results">
            <div class="section-head">
                <h2>Recommandations</h2>
                <span><?= count($regimes) ?> regime(s)</span>
            </div>

            <?php if ($mode === 'imc'): ?>
                <div class="empty-state">
                    Un IMC ideal se trouve entre 18,5 et 24,9 , voici ce qu'on propose
                </div>
            <?php endif; ?>

            <?php if (!$regimes): ?>
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

        <?php if ($mode === 'perdre' || $mode === 'gagner'): ?>
            <section class="regime-results">
                <div class="section-head">
                    <h2>Sports recommandes</h2>
                    <span><?= count($sports) ?> sport(s)</span>
                </div>

                <?php if (!$sports): ?>
                    <div class="empty-state">
                        Aucun sport disponible pour cet objectif.
                    </div>
                <?php else: ?>
                    <div class="regime-grid">
                        <?php foreach ($sports as $sport): ?>
                            <article class="regime-card">
                                <div class="regime-title">
                                    <?= esc($sport['nom']) ?>
                                    <span class="tag">
                                        <?= esc($sport['variation_poids_grammes']) ?> g/j
                                    </span>
                                </div>
                                <p><?= esc($sport['description']) ?></p>
                                <div class="regime-meta">
                                    <?php if (!empty($sport['calories_par_heure'])): ?>
                                        <span><?= esc($sport['calories_par_heure']) ?> cal/heure</span>
                                    <?php else: ?>
                                        <span>Activite sportive</span>
                                    <?php endif; ?>
                                </div>
                            </article>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </section>
        <?php endif; ?>
    </main>
</body>
</html>
