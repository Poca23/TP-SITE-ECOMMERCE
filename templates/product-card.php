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
            <button class="btn-cart"
                    data-id="<?= (int)$product['id'] ?>"
                    data-name="<?= htmlspecialchars($product['name']) ?>"
                    data-price="<?= (float)$product['price'] ?>">
                🛒 Ajouter
            </button>
        </div>
        <?php if (($_SESSION['role'] ?? '') === 'admin'): ?>
        <div class="card__admin">
            <a href="index.php?action=edit&id=<?= (int)$product['id'] ?>" class="btn-edit">✏️ Modifier</a>
            <a href="index.php?action=delete&id=<?= (int)$product['id'] ?>" class="btn-delete">🗑️ Supprimer</a>
        </div>
        <?php endif; ?>
    </div>
</article>
