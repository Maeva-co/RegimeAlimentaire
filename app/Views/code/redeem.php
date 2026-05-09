<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Utiliser un code</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:wght@500;600;700&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link href="/assets/css/redeem.css" rel="stylesheet">
</head>
<body class="redeem-page">
    <main class="redeem-shell">
        <header class="redeem-header">
            <a class="back-link" href="/hero">Retour aux objectifs</a>
            <h1>Utiliser un code</h1>
            <p>Entrez votre code pour recharger votre balance.</p>
        </header>

        <?php if (session()->getFlashdata('erreur')): ?>
            <div class="alert alert-error">
                <?= esc(session()->getFlashdata('erreur')) ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success">
                <?= esc(session()->getFlashdata('success')) ?>
            </div>
        <?php endif; ?>

        <form action="/code/redeem" method="POST" class="redeem-form">
            <?= csrf_field() ?>
            <label for="code">Code</label>
            <div class="input-row">
                <input
                    type="text"
                    id="code"
                    name="code"
                    placeholder="EX: BIENVENUE10"
                    value="<?= esc(old('code') ?? '') ?>"
                    required>
                <button type="submit" class="submit-btn">Valider</button>
            </div>
        </form>
    </main>
</body>
</html>
