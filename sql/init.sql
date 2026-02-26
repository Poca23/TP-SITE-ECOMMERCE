CREATE DATABASE IF NOT EXISTS unicornshop CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE unicornshop;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('user','admin') DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    price DECIMAL(10,2) NOT NULL,
    img VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO products (name, description, price, img) VALUES
('Licorne Arc-en-ciel','Une licorne aux couleurs chatoyantes qui répand la joie.',29.99,'https://placehold.co/400x300/ffb3de/fff?text=Arc-en-ciel'),
('Licorne Galactique','Voyagez dans les étoiles avec cette licorne cosmique.',34.99,'https://placehold.co/400x300/b3d4ff/fff?text=Galactique'),
('Licorne des Neiges','Froide et majestueuse, elle glisse sur les flocons.',27.50,'https://placehold.co/400x300/d4f0ff/555?text=Neiges'),
('Licorne Dorée','Symbole de richesse et de prestige absolu.',49.99,'https://placehold.co/400x300/fff0b3/555?text=Doree'),
('Licorne des Forêts','Gardienne des arbres millénaires et des secrets.',24.99,'https://placehold.co/400x300/b3ffcc/555?text=Forets'),
('Licorne Magma','Née du volcan, elle brûle d\'une flamme éternelle.',39.90,'https://placehold.co/400x300/ffb3b3/fff?text=Magma'),
('Licorne Cristal','Transparente et pure, elle reflète toutes les lumières.',44.00,'https://placehold.co/400x300/e8d4ff/555?text=Cristal'),
('Licorne Aquatique','Elle nage dans les océans profonds et mystérieux.',31.00,'https://placehold.co/400x300/b3eeff/555?text=Aquatique'),
('Licorne Solaire','Elle puise son énergie directement du soleil.',36.50,'https://placehold.co/400x300/ffe4b3/555?text=Solaire'),
('Licorne Shadow','Mystérieuse et rare, elleCREATE DATABASE IF NOT EXISTS unicornshop CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE unicornshop;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('user','admin') DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    price DECIMAL(10,2) NOT NULL,
    img VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO products (name, description, price, img) VALUES
('Licorne Arc-en-ciel','Une licorne aux couleurs chatoyantes qui répand la joie.',29.99,'https://placehold.co/400x300/ffb3de/fff?text=Arc-en-ciel'),
('Licorne Galactique','Voyagez dans les étoiles avec cette licorne cosmique.',34.99,'https://placehold.co/400x300/b3d4ff/fff?text=Galactique'),
('Licorne des Neiges','Froide et majestueuse, elle glisse sur les flocons.',27.50,'https://placehold.co/400x300/d4f0ff/555?text=Neiges'),
('Licorne Dorée','Symbole de richesse et de prestige absolu.',49.99,'https://placehold.co/400x300/fff0b3/555?text=Doree'),
('Licorne des Forêts','Gardienne des arbres millénaires et des secrets.',24.99,'https://placehold.co/400x300/b3ffcc/555?text=Forets'),
('Licorne Magma','Née du volcan, elle brûle d\'une flamme éternelle.',39.90,'https://placehold.co/400x300/ffb3b3/fff?text=Magma'),
('Licorne Cristal','Transparente et pure, elle reflète toutes les lumières.',44.00,'https://placehold.co/400x300/e8d4ff/555?text=Cristal'),
('Licorne Aquatique','Elle nage dans les océans profonds et mystérieux.',31.00,'https://placehold.co/400x300/b3eeff/555?text=Aquatique'),
('Licorne Solaire','Elle puise son énergie directement du soleil.',36.50,'https://placehold.co/400x300/ffe4b3/555?text=Solaire'),
('Licorne Shadow','Mystérieuse et rare, elle n\'apparaît qu\'à minuit.',55.00,'https://placehold.co/400x300/333/fff?text=Shadow');

-- Compte admin par défaut : admin / Admin1234!
INSERT INTO users (username, email, password, role) VALUES
('admin','admin@unicornshop.fr','$2y$12$placeholder_will_be_replaced','admin');
 n\'apparaît qu\'à minuit.',55.00,'https://placehold.co/400x300/333/fff?text=Shadow');

-- Compte admin par défaut : admin / Admin1234!
INSERT INTO users (username, email, password, role) VALUES
('admin','admin@unicornshop.fr','$2y$12$placeholder_will_be_replaced','admin');
