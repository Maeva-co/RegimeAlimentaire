<?php
$signupData = session()->get('signup_data');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription — Informations sante</title>
    <link href="/assets/css/register-layout.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="logo">
            <img src="/assets/images/logoDiet1.jpg" alt="DietBalance">
        </div>

        <h2>Inscription a DietFit</h2>
        <p>Etape 2 : Informations de sante</p>

        <?php if ($signupData): ?>
            <p>
                Nom : <?= esc($signupData['nom']) ?> |
                Email : <?= esc($signupData['email']) ?> |
                Genre : <?= esc($signupData['genre']) ?>
            </p>
        <?php endif; ?>

        <?php if (session()->getFlashdata('erreur')): ?>
            <div class="flash error">
                <?= esc(session()->getFlashdata('erreur')) ?>
            </div>
        <?php endif; ?>

        <form action="/register/health" method="post">
            <?= csrf_field() ?>

            <label>Taille (m)</label>
            <input
                type="number"
                name="taille"
                step="0.01"
                value="<?= esc(old('taille') ?? '') ?>"
                required>

            <?php if (session()->getFlashdata('errors')['taille'] ?? false): ?>
                <small style="color:red">
                    <?= session()->getFlashdata('errors')['taille'] ?>
                </small>
            <?php endif; ?>

            <label>Poids (kg)</label>
            <input
                type="number"
                name="poids"
                step="0.01"
                value="<?= esc(old('poids') ?? '') ?>"
                required>

            <?php if (session()->getFlashdata('errors')['poids'] ?? false): ?>
                <small style="color:red">
                    <?= session()->getFlashdata('errors')['poids'] ?>
                </small>
            <?php endif; ?>

            <div>
                <button type="button" class="back-btn" onclick="window.location.href='/register'">
                    Precedent
                </button>

                <button type="submit">
                    S'inscrire
                </button>
            </div>
        </form>

        <div class="step">
            <span>1</span>
            <span class="active">2</span>
        </div>
    </div>
</body>
</html>