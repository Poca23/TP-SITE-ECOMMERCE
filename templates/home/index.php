<?php ob_start(); ?>

<section class="hero">
    <h1>Bienvenue chez UnicornShop ✨</h1>
    <p>Découvrez notre collection de licornes magiques</p>
    <a href="index.php?action=products" class="btn btn--primary btn--lg">Voir la boutique</a>
</section>

<h2 class="page-title">Nos coups de cœur 💜</h2>
<div class="product-grid">
    <?php foreach ($featured as $product): ?>
        <?php require __DIR__ . '/../partials/product-card.php'; ?>
    <?php endforeach; ?>
</div>

<?php $content = ob_get_clean();
require __DIR__ . '/../layout/layout.php'; ?>
