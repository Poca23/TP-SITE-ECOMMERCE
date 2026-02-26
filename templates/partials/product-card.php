<article class="card">
    <img class="card__img"
         src="<?= htmlspecialchars($product['img']) ?>"
         alt="<?= htmlspecialchars($product['name']) ?>"
         loading="lazy">
    <div class="card__body">
        <h2 class="card__title"><?= htmlspecialchars($product['name']) ?></h2>
        <p class="card__desc"><?= htmlspecialchars($product['description']) ?></p>
        <div class="card__footer">
            <span class="card__price"><?= number_format((float)$product['price'], 2) ?> €</span>
            <form method="POST" action="index.php?action=cart.add">
                <input type="hidden" name="csrf" value="<?= $_SESSION['csrf'] ?>">
                <input type="hidden" name="id"   value="<?= (int)$product['id'] ?>">
                <button type="submit" class="btn btn--primary">🛒 Ajouter</button>
            </form>
        </div>
        <?php if (($_SESSION['role'] ?? '') === 'admin'): ?>
        <div class="card__admin">
            <a href="index.php?action=product.edit&id=<?= (int)$product['id'] ?>" class="btn btn--sm">✏️</a>
            <form method="POST" action="index.php?action=product.delete" style="display:inline">
                <input type="hidden" name="csrf" value="<?= $_SESSION['csrf'] ?>">
                <input type="hidden" name="id"   value="<?= (int)$product['id'] ?>">
                <button type="submit" class="btn btn--sm btn--danger" onclick="return confirm('Supprimer ?')">🗑️</button>
            </form>
        </div>
        <?php endif; ?>
    </div>
</article>
