<?php ob_start(); ?>

<div class="form-wrapper">
    <h1 class="page-title">Paiement 💳</h1>

    <?php if (!empty($error)): ?>
        <p class="alert alert--error"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <p class="text-center">Total : <strong><?= number_format($total, 2) ?> €</strong></p>

    <form method="POST" class="form">
        <input type="hidden" name="csrf" value="<?= $_SESSION['csrf'] ?>">
        <div class="form__group">
            <label>Numéro de carte</label>
            <input type="text" name="card" placeholder="1234 5678 9012 3456" required maxlength="19">
        </div>
        <div class="form__group">
            <label>Expiration</label>
            <input type="text" name="exp" placeholder="MM/AA" required maxlength="5">
        </div>
        <div class="form__group">
            <label>CVV</label>
            <input type="text" name="cvv" placeholder="123" required maxlength="4">
        </div>
        <div class="form__actions">
            <button type="submit" class="btn btn--primary">✅ Confirmer la commande</button>
            <a href="index.php?action=cart" class="btn btn--secondary">Retour</a>
        </div>
    </form>
</div>

<?php $content = ob_get_clean();
require __DIR__ . '/../layout/layout.php'; ?>
