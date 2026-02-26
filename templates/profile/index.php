<?php ob_start(); ?>

<h1 class="page-title">Mon Profil 👤</h1>

<?php if (!empty($error)):   ?><p class="alert alert--error"><?= htmlspecialchars($error) ?></p><?php endif; ?>
<?php if (!empty($success)): ?><p class="alert alert--success"><?= htmlspecialchars($success) ?></p><?php endif; ?>

<div class="form-wrapper">
    <form method="POST" class="form">
        <input type="hidden" name="csrf" value="<?= $_SESSION['csrf'] ?>">
        <div class="form__group">
            <label>Nom d'utilisateur</label>
            <input type="text" name="username" required value="<?= htmlspecialchars($user['username']) ?>">
        </div>
        <div class="form__group">
            <label>Email</label>
            <input type="email" name="email" required value="<?= htmlspecialchars($user['email']) ?>">
        </div>
        <div class="form__actions">
            <button type="submit" class="btn btn--primary">💾 Sauvegarder</button>
        </div>
    </form>
</div>

<?php if (!empty($orders)): ?>
<h2 class="page-title" style="margin-top:2rem">Mes commandes</h2>
<table class="table">
    <thead><tr><th>#</th><th>Total</th><th>Statut</th><th>Date</th></tr></thead>
    <tbody>
    <?php foreach ($orders as $o): ?>
        <tr>
            <td><?= (int)$o['id'] ?></td>
            <td><?= number_format((float)$o['total'], 2) ?> €</td>
            <td><?= htmlspecialchars($o['status']) ?></td>
            <td><?= htmlspecialchars($o['created_at']) ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php endif; ?>

<?php $content = ob_get_clean();
require __DIR__ . '/../layout/layout.php'; ?>
