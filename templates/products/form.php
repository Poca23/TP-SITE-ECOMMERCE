<?php
ob_start();
?>

<div class="form-wrapper">
    <h1 class="page-title"><?= htmlspecialchars($formTitle) ?></h1>

    <?php if (!empty($error)): ?>
        <p class="alert alert--error"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form method="POST" class="form" novalidate>
        <input type="hidden" name="csrf" value="<?= $_SESSION['csrf'] ?>">

        <div class="form__group">
            <label for="name">Nom du produit *</label>
            <input type="text" id="name" name="name" required maxlength="100"
                   value="<?= htmlspecialchars($product['name'] ?? '') ?>">
        </div>

        <div class="form__group">
            <label for="desc">Description</label>
            <textarea id="desc" name="desc" rows="3"><?= htmlspecialchars($product['description'] ?? '') ?></textarea>
        </div>

        <div class="form__group">
            <label for="price">Prix (€) *</label>
            <input type="number" id="price" name="price" step="0.01" min="0" required
                   value="<?= htmlspecialchars((string)($product['price'] ?? '')) ?>">
        </div>

        <div class="form__group">
            <label for="img">URL de l'image</label>
            <input type="url" id="img" name="img" maxlength="255"
                   value="<?= htmlspecialchars($product['img'] ?? '') ?>">
        </div>

        <div class="form__actions">
            <button type="submit" class="btn-primary">💾 Enregistrer</button>
            <a href="index.php" class="btn-secondary">Annuler</a>
        </div>
    </form>
</div>

<?php
$content = ob_get_clean();
require __DIR__ . '/../layout.php';
