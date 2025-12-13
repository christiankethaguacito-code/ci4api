-- Product Inventory Database Setup
-- Run in phpMyAdmin or MySQL CLI

CREATE DATABASE IF NOT EXISTS product_inventory_db;
USE product_inventory_db;

-- Create products table
CREATE TABLE IF NOT EXISTS products (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    sku VARCHAR(30) NOT NULL,
    category VARCHAR(50) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    cost_price DECIMAL(10, 2) NULL,
    quantity INT(11) NOT NULL DEFAULT 0,
    min_stock INT(11) NOT NULL DEFAULT 10,
    supplier VARCHAR(100) NOT NULL,
    description TEXT NULL,
    status ENUM('in_stock', 'low_stock', 'out_of_stock') DEFAULT 'in_stock',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Sample products
INSERT INTO products (name, sku, category, price, cost_price, quantity, min_stock, supplier, description, status) VALUES
('Wireless Bluetooth Headphones', 'ELEC-001', 'Electronics', 79.99, 45.00, 150, 20, 'TechSupply Co.', 'High-quality wireless headphones with noise cancellation', 'in_stock'),
('Cotton T-Shirt Large', 'CLT-002', 'Clothing', 24.99, 12.00, 8, 15, 'FashionWholesale', 'Premium cotton t-shirt, available in multiple colors', 'low_stock'),
('Office Desk Chair', 'FURN-003', 'Furniture', 189.99, 95.00, 35, 10, 'OfficePlus Ltd', 'Ergonomic office chair with lumbar support', 'in_stock'),
('Protein Powder 2kg', 'FOOD-004', 'Food', 54.99, 32.00, 0, 25, 'NutriFoods Inc', 'Whey protein powder, chocolate flavor', 'out_of_stock'),
('Basketball Size 7', 'SPRT-005', 'Sports', 29.99, 15.00, 75, 20, 'SportsGear Pro', 'Official size basketball for indoor/outdoor use', 'in_stock'),
('Power Drill Set', 'TOOL-006', 'Tools', 129.99, 68.00, 42, 15, 'ToolMaster Supply', '18V cordless drill with 20 piece accessory kit', 'in_stock');

SELECT * FROM products;
