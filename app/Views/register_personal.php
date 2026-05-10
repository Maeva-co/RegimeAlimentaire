<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription — DietBalance</title>
    <link href="/assets/css/register-layout.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="logo">
            <img src="/assets/images/logoDiet1.jpg" alt="DietBalance">
        </div>

        <h2>Inscription a DietBalance</h2>
        <p>Etape 1 : Informations personnelles</p>

        <?php if (session()->getFlashdata('erreur')): ?>
            <div class="flash error">
                <?= esc(session()->getFlashdata('erreur')) ?>
            </div>
        <?php endif; ?>

        <form action="/registerTreatment" method="post">
            <?= csrf_field() ?>

            <label>Nom</label>
            <input type="text" name="nom" value="<?= esc(old('nom') ?? '') ?>" required>

            <?php if (session()->getFlashdata('errors')['nom'] ?? false): ?>
                <small style="color:red">
                    <?= session()->getFlashdata('errors')['nom'] ?>
                </small>
            <?php endif; ?>

            <label>Email</label>
            <input type="email" name="email" value="<?= esc(old('email') ?? '') ?>" required>

            <?php if (session()->getFlashdata('errors')['email'] ?? false): ?>
                <small style="color:red">
                    <?= session()->getFlashdata('errors')['email'] ?>
                </small>
            <?php endif; ?>

            <label>Mot de passe</label>
            <input type="password" name="password" minlength="4" required>

            <?php if (session()->getFlashdata('errors')['password'] ?? false): ?>
                <small style="color:red">
                    <?= session()->getFlashdata('errors')['password'] ?>
                </small>
            <?php endif; ?>

            <label>Genre</label>
            <select name="genre" required>
                <option value="">Selectionner</option>

                <option value="homme" <?= old('genre') == 'homme' ? 'selected' : '' ?>>
                    Homme
                </option>

                <option value="femme" <?= old('genre') == 'femme' ? 'selected' : '' ?>>
                    Femme
                </option>
            </select>

            <?php if (session()->getFlashdata('errors')['genre'] ?? false): ?>
                <small style="color:red">
                    <?= session()->getFlashdata('errors')['genre'] ?>
                </small>
            <?php endif; ?>

            <button type="submit">Suivant</button>
        </form>

        <div class="step">
            <span class="active">1</span>
            <span>2</span>
        </div>

        <p style="text-align:center; margin-top:20px;">
            Deja un compte ?
            <a href="/login">Se connecter</a>
        </p>
    </div>
</body>
</html>