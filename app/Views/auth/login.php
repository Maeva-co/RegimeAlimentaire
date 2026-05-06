<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Regime Expert</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="/assets/css/admin.css" rel="stylesheet">
    <link href="/assets/css/login.css" rel="stylesheet">
</head>
<body class="login-page">
    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <div class="logo-icon"><i class="fas fa-leaf"></i></div>
                <h1>Regime Expert</h1>
                <p>Administration Back Office</p>
            </div>
            
            <?php if(session()->getFlashdata('erreur')): ?>
                <div class="alert alert-error"><i class="fas fa-exclamation-circle"></i> <?= session()->getFlashdata('erreur') ?></div>
            <?php endif; ?>
            
            <?php if(session()->getFlashdata('success')): ?>
                <div class="alert alert-success"><i class="fas fa-check-circle"></i> <?= session()->getFlashdata('success') ?></div>
            <?php endif; ?>
            
            <form action="/login" method="POST">
                <?= csrf_field() ?>
                <div class="form-group"><label><i class="fas fa-envelope"></i> Email</label><input type="email" name="email" placeholder="admin@regime.com" required></div>
                <div class="form-group"><label><i class="fas fa-lock"></i> Mot de passe</label><input type="password" name="password" placeholder="1234" required></div>
                <button type="submit" class="btn-login"><i class="fas fa-sign-in-alt"></i> Se connecter</button>
            </form>
            
            <div class="demo-info">
                <p><i class="fas fa-info-circle"></i> Comptes de démonstration</p>
                <div class="demo-accounts">
                    <span><strong>Admin:</strong> admin@regime.com / 1234</span>
                    <span><strong>User:</strong> jean@email.com / 1234</span>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="/assets/js/admin.js"></script>
</body>
</html>