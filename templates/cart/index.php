<?php ob_start(); ?>

<h1 class="page-title">Mon Panier 🛒</h1>

<?php if (empty($items)): ?>
    <p class="text-center">Votre panier est vide. <a href="index.php?action=products">Voir la boutique</a></p>
<?php else: ?>
    <div class="cart">
        <?php foreach ($items as $item): ?>
        <div class="cart__row">
            <span class="cart__name"><?= htmlspecialchars($item['name']) ?></span>
            <form method="POST" action="index.php?action=cart.update" class="cart__qty-form">
                <input type="hidden" name="csrf" value="<?= $_SESSION['csrf'] ?>">
                <input type="hidden" name="id"   value="<?= (int)$item['id'] ?>">
                <input type="number" name="qty"  value="<?= (int)$item['qty'] ?>" min="0" class="cart__qty-input">
                <button type="submit" class="btn btn--sm">Mettre à jour</button>
            </form>
            <span class="cart__price"><?= number_format($item['price'] * $item['qty'], 2) ?> €</span>
            <form method="POST" action="index.php?action=cart.remove">
                <input type="hidden" name="csrf" value="<?= $_SESSION['csrf'] ?>">
                <input type="hidden" name="id"   value="<?= (int)$item['id'] ?>">
                <button type="submit" class="btn btn--sm btn--danger">✕</button>
            </form>
        </div>
        <?php endforeach; ?>

        <div class="cart__total">Total : <strong><?= number_format($total, 2) ?> €</strong></div>

        <div class="cart__actions">
            <form method="POST" action="index.php?action=cart.clear">
                <input type="hidden" name="csrf" value="<?= $_SESSION['csrf'] ?>">
                <button type="submit" class="btn btn--secondary">Vider le panier</button>
            </form>
            <?php if (!empty($_SESSION['user_id'])): ?>
                <a href="index.php?action=checkout" class="btn btn--primary">Commander →</a>
            <?php else: ?>
                <a href="index.php?action=login" class="btn btn--primary">Connexion pour commander</a>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>

<?php $content = ob_get_clean();
require __DIR__ . '/../layout/layout.php'; ?>
