<header class="navbar">
    <a href="index.php" class="navbar__brand">🦄 UnicornShop</a>

    <input type="checkbox" id="nav-toggle" class="nav-toggle" hidden>
    <label for="nav-toggle" class="nav-burger">&#9776;</label>

    <nav class="navbar__links">
        <a href="index.php">Accueil</a>
        <a href="index.php?action=products">Boutique</a>
        <?php if (!empty($_SESSION['user_id'])): ?>
            <?php if ($_SESSION['role'] === 'admin'): ?>
                <a href="index.php?action=product.create">+ Produit</a>
            <?php endif; ?>
            <a href="index.php?action=profile">👤 <?= htmlspecialchars($_SESSION['username']) ?></a>
            <a href="index.php?action=logout">Déconnexion</a>
        <?php else: ?>
            <a href="index.php?action=login">Connexion</a>
            <a href="index.php?action=register">Inscription</a>
        <?php endif; ?>
        <a href="index.php?action=cart" class="navbar__cart">
            🛒 <span class="cart-count">0</span>
        </a>
    </nav>
</header>
