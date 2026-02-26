<?php ob_start(); ?>

<div class="form-wrapper">
    <h1 class="page-title">Connexion 🔐</h1>

    <?php if (!empty($error)): ?>
        <p class="alert alert--error"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form method="POST" class="form" novalidate>
        <input type="hidden" name="csrf" value="<?= htmlspecialchars($_SESSION['csrf']) ?>">

        <div class="form__group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required autocomplete="email"
                   value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
        </div>

        <div class="form__group">
            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password" required autocomplete="current-password">
        </div>

        <div class="form__actions">
            <button type="submit" class="btn-primary">Se connecter</button>
        </div>
        <p class="form__link">Pas de compte ? <a href="index.php?action=register">S'inscrire</a></p>
    </form>
</div>

<?php
$content = ob_get_clean();
require __DIR__ . '/../layout.php';
