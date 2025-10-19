CREATE DATABASE IF NOT EXISTS fontis_db;
USE fontis_db;

-- USERS TABLE
CREATE TABLE IF NOT EXISTS users (
  id INT(100) NOT NULL AUTO_INCREMENT,
  name VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL,
  password VARCHAR(255) NOT NULL,
  user_type VARCHAR(20) NOT NULL DEFAULT 'user',
  PRIMARY KEY (id)
);

-- PRODUCTS TABLE
CREATE TABLE IF NOT EXISTS products (
  id INT(100) NOT NULL AUTO_INCREMENT,
  name VARCHAR(100) NOT NULL,
  price INT(100) NOT NULL,
  image VARCHAR(100) NOT NULL,
  description TEXT DEFAULT NULL,
  category VARCHAR(100) DEFAULT NULL,
  PRIMARY KEY (id)
);

-- CART TABLE
-- Only logged-in users can have carts; guests cannot.
CREATE TABLE IF NOT EXISTS cart (
  id INT(100) NOT NULL AUTO_INCREMENT,
  user_id INT(100) NOT NULL,
  name VARCHAR(100) NOT NULL,
  price INT(100) NOT NULL,
  quantity INT(100) NOT NULL,
  image VARCHAR(100) NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- ORDERS TABLE
-- Only registered users can place orders.
CREATE TABLE IF NOT EXISTS orders (
  id INT(100) NOT NULL AUTO_INCREMENT,
  user_id INT(100) NOT NULL,
  name VARCHAR(100) NOT NULL,
  number VARCHAR(12) NOT NULL,
  method VARCHAR(50) NOT NULL,
  total_products VARCHAR(1000) NOT NULL,
  total_price INT(100) NOT NULL,
  placed_on VARCHAR(50) NOT NULL,
  payment_status VARCHAR(20) NOT NULL DEFAULT 'pending',
  PRIMARY KEY (id),
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- MESSAGES TABLE
-- Allow guests to send contact messages (user_id can be NULL)
CREATE TABLE IF NOT EXISTS message (
  id INT(100) NOT NULL AUTO_INCREMENT,
  user_id INT(100) NULL,
  name VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL,
  number VARCHAR(12) NOT NULL,
  message VARCHAR(500) NOT NULL,
  sent_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
);

-- INSERT DEFAULT ADMIN USER
INSERT INTO users (name, email, password, user_type)
VALUES ('Admin', 'admin@gmail.com', '$2y$10$h5tnY6JxuDN5kwInKr4i0erl7gI2BHvfCpnpYPZLxSw6xNir4u5Cy', 'admin')
ON DUPLICATE KEY UPDATE email = email;
-- Password: adminpass
