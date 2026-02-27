<?php ob_start(); ?>

<h1 class="page-title">Mon Panier 🛒</h1>

<?php if (empty($items)): ?>
    <p class="text-center">Votre panier est vide 🦄</p>
<?php else: ?>
    <div class="cart">
        <?php foreach ($items as $item): ?>
        <div class="cart__row">
            <span class="cart__name"><?= htmlspecialchars($item['name']) ?></span>
            <span><?= number_format($item['price'], 2) ?> €</span>

            <form method="POST" action="index.php?action=cart.update" class="cart__qty-form">
                <input type="hidden" name="csrf" value="<?= $_SESSION['csrf'] ?>">
                <input type="hidden" name="id"   value="<?= (int)$item['id'] ?>">
                <input type="number"  name="qty"  value="<?= (int)$item['qty'] ?>"
                       min="0" class="cart__qty-input">
                <button type="submit" class="btn btn--secondary">Mettre à jour</button>
            </form>

            <form method="POST" action="index.php?action=cart.remove">
                <input type="hidden" name="csrf" value="<?= $_SESSION['csrf'] ?>">
                <input type="hidden" name="id"   value="<?= (int)$item['id'] ?>">
                <button type="submit" class="btn--del">🗑️</button>
            </form>
        </div>
        <?php endforeach; ?>
    </div>

    <p class="cart__total">Total : <strong><?= number_format($total, 2) ?> €</strong></p>

    <div class="cart__actions">
        <a href="index.php?action=products" class="btn btn--secondary">← Continuer mes achats</a>

        <form method="POST" action="index.php?action=cart.clear">
            <input type="hidden" name="csrf" value="<?= $_SESSION['csrf'] ?>">
            <button type="submit" class="btn btn--secondary">Vider le panier</button>
        </form>

        <?php if (!empty($_SESSION['user_id'])): ?>
            <a href="index.php?action=checkout" class="btn btn--primary">Commander ✅</a>
        <?php else: ?>
            <a href="index.php?action=login" class="btn btn--primary">Se connecter pour commander</a>
        <?php endif; ?>
    </div>
<?php endif; ?>

<?php $content = ob_get_clean();
require __DIR__ . '/../layout/layout.php'; ?>
