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

CREATE TABLE IF NOT EXISTS orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    total DECIMAL(10,2) NOT NULL,
    status ENUM('pending','paid','cancelled') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE IF NOT EXISTS order_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    product_id INT NOT NULL,
    qty INT NOT NULL,
    unit_price DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(id),
    FOREIGN KEY (product_id) REFERENCES products(id)
);

INSERT INTO products (name, description, price, img) VALUES
('Licorne Arc-en-ciel','Une licorne aux couleurs chatoyantes.',29.99,'https://placehold.co/400x300/ffb3de/fff?text=Arc-en-ciel'),
('Licorne Galactique','Voyagez dans les étoiles.',34.99,'https://placehold.co/400x300/b3d4ff/fff?text=Galactique'),
('Licorne des Neiges','Froide et majestueuse.',27.50,'https://placehold.co/400x300/d4f0ff/555?text=Neiges'),
('Licorne Dorée','Symbole de richesse absolue.',49.99,'https://placehold.co/400x300/fff0b3/555?text=Doree'),
('Licorne des Forêts','Gardienne des arbres millénaires.',24.99,'https://placehold.co/400x300/b3ffcc/555?text=Forets'),
('Licorne Magma','Née du volcan, flamme éternelle.',39.90,'https://placehold.co/400x300/ffb3b3/fff?text=Magma'),
('Licorne Cristal','Transparente, elle reflète la lumière.',44.00,'https://placehold.co/400x300/e8d4ff/555?text=Cristal'),
('Licorne Aquatique','Elle nage dans les océans profonds.',31.00,'https://placehold.co/400x300/b3eeff/555?text=Aquatique'),
('Licorne Solaire','Elle puise son énergie du soleil.',36.50,'https://placehold.co/400x300/ffe4b3/555?text=Solaire'),
('Licorne Shadow','Mystérieuse, elle apparaît à minuit.',55.00,'https://placehold.co/400x300/333/fff?text=Shadow');

INSERT INTO users (username, email, password, role) VALUES
('admin','admin@unicornshop.fr', '$2y$12$iuIlvPGP/MTmuq8g1XyxQu9f0EZhjZLicTs2SkijLfwwJnd92UCWq','admin'),
('alice','alice@unicornshop.fr', '$2y$12$iQybs3dDwjDyD4u4d8onge/tfO5I7XLs3itijEmM83acirrCjLR7G','user');
