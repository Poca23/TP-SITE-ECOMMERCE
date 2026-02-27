<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UnicornShop 🦄</title>
    <link rel="icon" href="https://fav.farm/🦄" type="image/png">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<?php require __DIR__ . '/navbar.php'; ?>
<main class="container">
    <?php require __DIR__ . '/../partials/flash.php'; ?>
    <?= $content ?>
</main>
<?php require __DIR__ . '/footer.php'; ?>
<script src="assets/js/cart.js"></script>
<script src="assets/js/toast.js"></script>
<script src="assets/js/navbar.js"></script>
<script src="assets/js/password.js"></script>

<?php if (!empty($_SESSION['user_id'])): ?>
<script>
  setTimeout(() => {
    window.location.href = "index.php?action=login&reason=expired";
  }, <?= (int)(getenv('SESSION_LIFETIME') ?: 1800) * 1000 ?>);
</script>
<?php endif; ?>

</body>
</html>
