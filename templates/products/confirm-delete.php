<?php
ob_start();
?>

<div class="form-wrapper">
    <h1 class="page-title">Supprimer un produit</h1>
    <p class="alert alert--warning">
        Voulez-vous vraiment supprimer <strong><?= htmlspecialchars($product['name']) ?></strong> ?
        Cette action est irréversible.
    </p>
    <form method="POST" class="form__actions">
        <input type="hidden" name="csrf" value="<?= $_SESSION['csrf'] ?>">
        <button type="submit" class="btn-delete">🗑️ Confirmer la suppression</button>
        <a href="index.php" class="btn-secondary">Annuler</a>
    </form>
</div>

<?php
$content = ob_get_clean();
require __DIR__ . '/../layout.php';
