<?php if ($data['totalPages'] > 1): ?>
<nav class="pagination">
    <?php for ($i = 1; $i <= $data['totalPages']; $i++): ?>
        <a href="?action=products&page=<?= $i ?>"
           class="page-btn <?= $i === $data['currentPage'] ? 'active' : '' ?>">
            <?= $i ?>
        </a>
    <?php endfor; ?>
</nav>
<?php endif; ?>
