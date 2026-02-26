<header class="navbar">
    <div class="navbar__brand">
        <a href="index.php" class="navbar__brand-link">
            <span class="navbar__logo">🦄</span>
            <span class="navbar__name">UnicornShop</span>
        </a>
    </div>

    <input type="checkbox" id="nav-toggle" class="nav-toggle" hidden>
    <label for="nav-toggle" class="nav-burger" aria-label="Menu">&#9776;</label>

    <nav class="navbar__links">
        <a href="index.php">Accueil</a>
        <?php if (isset($_SESSION['user_id'])): ?>
            <?php if ($_SESSION['role'] === 'admin'): ?>
                <a href="index.php?action=create" class="btn-admin">+ Produit</a>
            <?php endif; ?>
            <span class="navbar__user">👤 <?= htmlspecialchars($_SESSION['username']) ?></span>
            <a href="index.php?action=logout">Déconnexion</a>
        <?php else: ?>
            <a href="index.php?action=login">Connexion</a>
            <a href="index.php?action=register">Inscription</a>
        <?php endif; ?>
    </nav>

    <button class="navbar__cart" aria-label="Panier">
        🛒 <span class="cart-count">0</span>
    </button>
</header>
