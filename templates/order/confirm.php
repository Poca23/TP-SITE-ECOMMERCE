<?php ob_start(); ?>

<div class="text-center" style="padding:3rem 1rem">
    <div style="font-size:4rem">🦄</div>
    <h1 class="page-title">Commande confirmée !</h1>
    <?php if ($order): ?>
        <p>Commande n°<strong><?= (int)$order['id'] ?></strong> — <?= number_format((float)$order['total'], 2) ?> €</p>
    <?php endif; ?>
    <p>Merci pour votre achat magique ✨</p>
    <a href="index.php?action=products" class="btn btn--primary" style="margin-top:1.5rem">Continuer mes achats</a>
</div>

<?php $content = ob_get_clean();
require __DIR__ . '/../layout/layout.php'; ?>
