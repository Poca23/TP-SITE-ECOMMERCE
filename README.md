# 🦄 UnicornShop

Site e-commerce de licornes développé en PHP natif (architecture MVC).

## Stack

- **Back-end** : PHP 8+ (MVC maison)
- **Base de données** : MySQL
- **Front-end** : HTML, CSS (mobile-first), JS vanilla

## Installation

```bash
# 1. Cloner le projet
git clone https://github.com/votre-user/unicornshop.git
cd unicornshop

# 2. Créer la base de données
mysql -u root -p < init.sql

# 3. Configurer la connexion BDD
cp config/database.example.php config/database.php
# → Éditer config/database.php avec vos identifiants

# 4. Lancer le serveur de développement
php -S localhost:8000
```

## Structure

```
├── config/
│   └── database.php          # Connexion PDO (à ne pas committer)
├── controllers/
│   ├── AuthController.php    # Connexion / inscription / déconnexion
│   └── ProductController.php # CRUD produits
├── models/
│   ├── Product.php
│   └── User.php
├── templates/
│   ├── layout.php
│   ├── navbar.php
│   ├── footer.php
│   ├── product-card.php
│   ├── auth/
│   │   ├── login.php
│   │   └── register.php
│   └── products/
│       ├── list.php
│       └── form.php
├── assets/
│   ├── css/style.css
│   └── js/cart.js
├── index.php                 # Point d'entrée unique
└── init.sql                  # Script d'initialisation BDD
```

## Fonctionnalités

- Affichage des produits avec pagination
- Panier local (localStorage)
- Connexion / inscription utilisateur
- Espace admin : ajout, modification, suppression de produits
- Protection CSRF sur tous les formulaires

## Compte admin par défaut

> À changer impérativement en production.

| Email                | Mot de passe       |
| -------------------- | ------------------ |
| admin@unicornshop.fr | Admin1234! (Admin) |
| alice@unicornshop.fr | Alice1234! (User)  |

## Licence

MIT
