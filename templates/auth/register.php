<?php ob_start(); ?>

<div class="form-wrapper">
    <h1 class="page-title">Inscription 📝</h1>

    <?php if (!empty($error)): ?>
        <p class="alert alert--error"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form method="POST" class="form">
        <input type="hidden" name="csrf" value="<?= $_SESSION['csrf'] ?>">
        <div class="form__group">
            <label>Nom d'utilisateur</label>
            <input type="text" name="username" required maxlength="50"
                   value="<?= htmlspecialchars($_POST['username'] ?? '') ?>">
        </div>
        <div class="form__group">
            <label>Email</label>
            <input type="email" name="email" required
                   value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
        </div>
        <div class="form__group">
            <label>Mot de passe <small>(min. 8 car.)</small></label>
            <input type="password" name="password" required minlength="8">
        </div>
        <div class="form__group">
            <label>Confirmer</label>
            <input type="password" name="confirm" required minlength="8">
        </div>
        <div class="form__actions">
            <button type="submit" class="btn btn--primary">Créer mon compte</button>
        </div>
    </form>
    <p class="form__link">Déjà un compte ? <a href="index.php?action=login">Se connecter</a></p>
</div>

<?php $content = ob_get_clean();
require __DIR__ . '/../layout/layout.php'; ?>
