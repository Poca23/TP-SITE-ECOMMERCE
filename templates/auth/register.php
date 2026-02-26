<?php ob_start(); ?>

<div class="form-wrapper">
    <h1 class="page-title">Inscription 📝</h1>

    <?php if (!empty($error)): ?>
        <p class="alert alert--error"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <?php if (!empty($success)): ?>
        <p class="alert alert--success"><?= $success ?></p>
    <?php endif; ?>

    <form method="POST" class="form" novalidate>
        <input type="hidden" name="csrf" value="<?= htmlspecialchars($_SESSION['csrf']) ?>">

        <div class="form__group">
            <label for="username">Nom d'utilisateur</label>
            <input type="text" id="username" name="username" required maxlength="50"
                   value="<?= htmlspecialchars($_POST['username'] ?? '') ?>">
        </div>

        <div class="form__group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required autocomplete="email"
                   value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
        </div>

        <div class="form__group">
            <label for="password">Mot de passe <small>(min. 8 caractères)</small></label>
            <input type="password" id="password" name="password" required minlength="8">
        </div>

        <div class="form__group">
            <label for="confirm">Confirmer le mot de passe</label>
            <input type="password" id="confirm" name="confirm" required minlength="8">
        </div>

        <div class="form__actions">
            <button type="submit" class="btn-primary">Créer mon compte</button>
        </div>
        <p class="form__link">Déjà un compte ? <a href="index.php?action=login">Se connecter</a></p>
    </form>
</div>

<?php
$content = ob_get_clean();
require __DIR__ . '/../layout.php';
