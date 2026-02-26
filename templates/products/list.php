<?php
ob_start();
?>

<h1 class="page-title">Nos Licornes ✨</h1>

<div class="product-grid">
    <?php foreach ($data['items'] as $product): ?>
        <?php require __DIR__ . '/../product-card.php'; ?>
    <?php endforeach; ?>
</div>

<?php if ($data['totalPages'] > 1): ?>
<nav class="pagination" aria-label="Pagination">
    <?php for ($i = 1; $i <= $data['totalPages']; $i++): ?>
        <a href="?page=<?= $i ?>"
           class="page-btn <?= $i === $data['currentPage'] ? 'active' : '' ?>"
           aria-current="<?= $i === $data['currentPage'] ? 'page' : 'false' ?>">
            <?= $i ?>
        </a>
    <?php endfor; ?>
</nav>
<?php endif; ?>

<?php
$content = ob_get_clean();
require __DIR__ . '/../layout.php';
