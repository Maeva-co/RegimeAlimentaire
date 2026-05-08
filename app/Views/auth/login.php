<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion — Regime Expert</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700;800&family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500;9..40,600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <link href="/assets/css/admin.css" rel="stylesheet">
    <link href="/assets/css/login.css" rel="stylesheet">
</head>
<body class="login-page">

    <!-- ── Hero Panel (Left) ────────────────── -->
    <!-- <div class="login-hero">
        <div class="hero-content">
            <div class="hero-logo">
                <i class="fas fa-leaf"></i>
            </div>
            <h1>Regime Expert</h1>
            <p>Gérez vos régimes alimentaires, activités sportives et utilisateurs depuis un espace centralisé.</p>

            <div class="hero-features">
                <div class="hero-feature">
                    <div class="hero-feature-icon"><i class="fas fa-chart-bar"></i></div>
                    <span>Tableaux de bord en temps réel</span>
                </div>
                <div class="hero-feature">
                    <div class="hero-feature-icon"><i class="fas fa-apple-alt"></i></div>
                    <span>Gestion des régimes personnalisés</span>
                </div>
                <div class="hero-feature">
                    <div class="hero-feature-icon"><i class="fas fa-running"></i></div>
                    <span>Suivi des activités sportives</span>
                </div>
                <div class="hero-feature">
                    <div class="hero-feature-icon"><i class="fas fa-ticket-alt"></i></div>
                    <span>Codes promotionnels intégrés</span>
                </div>
            </div>
        </div>
    </div> -->

    <!-- ── Form Panel (Right) ──────────────── -->
    <div class="login-form-panel">
        <div class="login-container">

            <div class="login-header">
                <div class="back-tag">
                    <i class="fas fa-leaf"></i>
                    Administration
                </div>
                <h2>Bon retour 👋</h2>
                <p>Connectez-vous à votre espace administrateur</p>
            </div>

            <?php if (session()->getFlashdata('erreur')): ?>
                <div class="alert alert-error">
                    <i class="fas fa-exclamation-circle"></i>
                    <?= esc(session()->getFlashdata('erreur')) ?>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i>
                    <?= esc(session()->getFlashdata('success')) ?>
                </div>
            <?php endif; ?>

            <form action="/login" method="POST" class="login-form">
                <?= csrf_field() ?>

                <div class="form-group">
                    <label for="email">
                        <i class="fas fa-envelope"></i>
                        Adresse e-mail
                    </label>
                    <div class="input-wrap">
                        <i class="fas fa-envelope input-icon"></i>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            placeholder="admin@regime.com"
                            autocomplete="email"
                            required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password">
                        <i class="fas fa-lock"></i>
                        Mot de passe
                    </label>
                    <div class="input-wrap">
                        <i class="fas fa-lock input-icon"></i>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="••••••••"
                            autocomplete="current-password"
                            required>
                    </div>
                </div>

                <button type="submit" class="btn-login">
                    <i class="fas fa-arrow-right-to-bracket"></i>
                    Se connecter
                </button>
            </form>

            <div class="demo-info">
                <div class="demo-title">
                    <i class="fas fa-circle-info"></i>
                    Comptes de démonstration
                </div>
                <div class="demo-accounts">
                    <span><strong>Admin :</strong> admin@regime.com / 1234</span>
                    <span><strong>User :</strong>  jean@email.com / 1234</span>
                </div>
            </div>

        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="/assets/js/admin.js"></script>
</body>
</html>