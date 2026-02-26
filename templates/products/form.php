<?php ob_start(); ?>

<div class="form-wrapper">
    <h1 class="page-title"><?= htmlspecialchars($formTitle) ?></h1>

    <?php if (!empty($error)): ?>
        <p class="alert alert--error"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form method="POST" class="form">
        <input type="hidden" name="csrf" value="<?= $_SESSION['csrf'] ?>">

        <div class="form__group">
            <label>Nom</label>
            <input type="text" name="name" required value="<?= htmlspecialchars($product['name'] ?? '') ?>">
        </div>
        <div class="form__group">
            <label>Description</label>
            <textarea name="desc" rows="3"><?= htmlspecialchars($product['description'] ?? '') ?></textarea>
        </div>
        <div class="form__group">
            <label>Prix (€)</label>
            <input type="number" name="price" step="0.01" min="0" required value="<?= htmlspecialchars((string)($product['price'] ?? '')) ?>">
        </div>
        <div class="form__group">
            <label>URL Image</label>
            <input type="text" name="img" value="<?= htmlspecialchars($product['img'] ?? '') ?>">
        </div>
        <div class="form__actions">
            <button type="submit" class="btn btn--primary">💾 Enregistrer</button>
            <a href="index.php?action=products" class="btn btn--secondary">Annuler</a>
        </div>
    </form>
</div>

<?php $content = ob_get_clean();
require __DIR__ . '/../layout/layout.php'; ?>
