<?php ob_start(); ?>

<div class="form-wrapper">
    <h1 class="page-title">Connexion 🔐</h1>

    <?php if (!empty($error)): ?>
        <p class="alert alert--error"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form method="POST" class="form">
        <input type="hidden" name="csrf" value="<?= $_SESSION['csrf'] ?>">
        <div class="form__group">
            <label>Email</label>
            <input type="email" name="email" required autocomplete="email" placeholder="votre@email.fr"
            value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
        </div>
        <div class="form__group">
            <label>Mot de passe</label>
            <input type="password" name="password" required placeholder="Votre mot de passe">

        </div>
        <div class="form__actions">
            <button type="submit" class="btn btn--primary">Se connecter</button>
        </div>
    </form>
    <p class="form__link">Pas de compte ? <a href="index.php?action=register">S'inscrire</a></p>
</div>

<?php $content = ob_get_clean();
require __DIR__ . '/../layout/layout.php'; ?>
