<article class="card">
    <div class="card__img-wrap">
        <img class="card__img"
             src="<?= htmlspecialchars($product['img']) ?>"
             alt="<?= htmlspecialchars($product['name']) ?>"
             loading="lazy">
    </div>

    <div class="card__body">
        <h2 class="card__title"><?= htmlspecialchars($product['name']) ?></h2>
        <p class="card__desc"><?= htmlspecialchars($product['description']) ?></p>

        <div class="card__footer">
            <span class="card__price"><?= number_format((float)$product['price'], 2) ?> €</span>
            <form method="POST" action="index.php?action=cart.add">
                <input type="hidden" name="csrf" value="<?= $_SESSION['csrf'] ?>">
                <input type="hidden" name="id"   value="<?= (int)$product['id'] ?>">
                <button type="submit" class="btn--add">
                    <span>🛒</span>
                    <span class="btn--add__label">Ajouter</span>
                </button>
            </form>
        </div>

        <?php if (($_SESSION['role'] ?? '') === 'admin'): ?>
        <div class="card__admin">
            <a href="index.php?action=product.edit&id=<?= (int)$product['id'] ?>" class="btn--edit">
                <span>✏️</span><span class="btn__label">Éditer</span>
            </a>
            <form method="POST" action="index.php?action=product.delete">
                <input type="hidden" name="csrf" value="<?= $_SESSION['csrf'] ?>">
                <input type="hidden" name="id"   value="<?= (int)$product['id'] ?>">
                <button type="submit" class="btn--del"
                        onclick="return confirm('Supprimer cette licorne ?')">
                    <span>🗑️</span><span class="btn__label">Supprimer</span>
                </button>
            </form>
        </div>
        <?php endif; ?>
    </div>
</article>
