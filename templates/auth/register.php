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
            <input type="text" name="username" required maxlength="50" placeholder="Votre nom"
            value="<?= htmlspecialchars($_POST['username'] ?? '') ?>">
        </div>
        
        <div class="form__group">
            <label>Email</label>
            <input type="email" name="email" required placeholder="votre@email.fr"
            value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
        </div>

        <div class="form__group">
            <label>Mot de passe <small>(min. 12 car.)</small></label>
                <div class="input-eye">
                <input type="password" name="password" id="reg_password" required minlength="12" placeholder="Minimum 12 caractères">
                <button type="button" class="eye-btn" data-toggle-password="#reg_password">👁️</button>
        </div>

        <div class="form__group">
            <label>Confirmer</label>
            <div class="input-eye">
            <input type="password" name="confirm" id="reg_confirm" required minlength="12" placeholder="Répétez le mot de passe">
            <button type="button" class="eye-btn" data-toggle-password="#reg_confirm">👁️</button>
        </div>

        <div class="form__actions">
            <button type="submit" class="btn btn--primary">Créer mon compte</button>
        </div>
    </form>
    <p class="form__link">Déjà un compte ? <a href="index.php?action=login">Se connecter</a></p>
</div>

<?php $content = ob_get_clean();
require __DIR__ . '/../layout/layout.php'; ?>
