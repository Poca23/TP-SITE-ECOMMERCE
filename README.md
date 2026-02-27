````markdown
# 🦄 UnicornShop

Site e-commerce de licornes développé en PHP natif (architecture MVC).

## Stack

- **Back-end** : PHP 8.1+ (MVC maison)
- **Base de données** : MySQL
- **Front-end** : HTML, CSS (mobile-first), JS vanilla
- **Conteneurisation** : Docker

## Installation

```bash
# 1. Cloner le projet
git clone https://github.com/votre-user/unicornshop.git
cd unicornshop

# 2. Créer la base de données
mysql -u root -p < sql/init.sql

# 3. Configurer les variables d'environnement
cp .env.example .env
# → Éditer .env avec vos identifiants

# 4. Lancer le serveur de développement
php -S localhost:8000
```
````

### Avec Docker

```bash
docker build -t unicornshop .
docker run -p 8000:8000 unicornshop
```

## Structure

```
├── assets/
│   ├── css/                  # Feuilles de style (mobile-first)
│   │   ├── style.css         # Variables globales + reset
│   │   ├── navbar.css
│   │   ├── footer.css
│   │   ├── card.css
│   │   ├── cart.css
│   │   ├── form.css
│   │   ├── home.css
│   │   └── toast.css
│   ├── js/
│   │   ├── cart.js           # Badge panier
│   │   ├── navbar.js         # Burger menu
│   │   ├── password.js       # Toggle show/hide
│   │   └── toast.js          # Notifications
│   └── uploads/              # Images uploadées (admin)
├── config/
│   └── database.php          # Singleton PDO
├── controllers/
│   ├── AuthController.php    # Connexion / inscription / déconnexion
│   ├── CartController.php    # Panier session
│   ├── HomeController.php    # Page d'accueil
│   ├── OrderController.php   # Checkout + confirmation
│   ├── ProductController.php # CRUD produits (admin)
│   └── ProfileController.php # Profil utilisateur
├── models/
│   ├── Cart.php
│   ├── Order.php
│   ├── Product.php
│   └── User.php
├── templates/
│   ├── layout/
│   │   ├── layout.php        # Wrapper HTML
│   │   ├── navbar.php
│   │   └── footer.php
│   ├── partials/
│   │   ├── flash.php         # Notifications toast
│   │   ├── pagination.php
│   │   └── product-card.php
│   ├── auth/
│   ├── cart/
│   ├── home/
│   ├── order/
│   ├── products/
│   └── profile/
├── sql/
│   └── init.sql              # Schéma + données de test
├── index.php                 # Point d'entrée unique (routeur)
└── Dockerfile
```

## Fonctionnalités

- Affichage des produits avec pagination
- Panier stocké en session PHP
- Checkout avec paiement fictif → commande enregistrée en BDD
- Connexion / inscription / déconnexion
- Profil utilisateur + historique des commandes
- Changement de mot de passe depuis le profil
- Espace admin : ajout, modification, suppression de produits
- Upload d'image sécurisé (PNG, JPG, WEBP — max 2 Mo)
- Protection CSRF sur tous les formulaires POST
- Notifications toast
- Design féérique mobile-first

## Comptes de test

> ⚠️ À changer impérativement en production.

| Username | Email                | Mot de passe  | Rôle  |
| -------- | -------------------- | ------------- | ----- |
| admin    | admin@unicornshop.fr | Password1234! | admin |
| alice    | alice@unicornshop.fr | Password1234! | user  |

## Sécurité

- CSRF token sur tous les formulaires POST
- `password_hash` / `password_verify` (bcrypt, cost 12)
- PDO prepared statements
- `htmlspecialchars()` sur tous les outputs
- `session_regenerate_id()` à la connexion
- Vérification MIME réelle sur les uploads
- Vérification du rôle dans chaque contrôleur

## Licence

MIT
