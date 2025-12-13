<?php
/**
 * Database Initialization Script for Product Inventory
 * Run this script once to create the SQLite database and tables
 */

$dbPath = __DIR__ . '/writable/database.db';

// Create directory if not exists
if (!is_dir(dirname($dbPath))) {
    mkdir(dirname($dbPath), 0777, true);
}

try {
    $db = new SQLite3($dbPath);
    
    // Create products table
    $db->exec("
        CREATE TABLE IF NOT EXISTS products (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            name VARCHAR(255) NOT NULL,
            sku VARCHAR(50) NOT NULL UNIQUE,
            category VARCHAR(100),
            price DECIMAL(10,2) DEFAULT 0.00,
            cost_price DECIMAL(10,2) DEFAULT 0.00,
            quantity INTEGER DEFAULT 0,
            min_stock INTEGER DEFAULT 10,
            supplier VARCHAR(255),
            description TEXT,
            status VARCHAR(20) DEFAULT 'active',
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            updated_at DATETIME DEFAULT CURRENT_TIMESTAMP
        )
    ");
    
    // Check if table is empty, then insert sample data
    $result = $db->querySingle("SELECT COUNT(*) FROM products");
    if ($result == 0) {
        $db->exec("
            INSERT INTO products (name, sku, category, price, cost_price, quantity, min_stock, supplier, description, status) VALUES
            ('Wireless Mouse', 'WM-001', 'Electronics', 29.99, 15.00, 150, 20, 'Clifford John', 'Ergonomic wireless mouse with 2.4GHz connectivity', 'active'),
            ('Mechanical Keyboard', 'MK-002', 'Electronics', 89.99, 45.00, 75, 15, 'John Ramos', 'RGB mechanical keyboard with Cherry MX switches', 'active'),
            ('USB-C Hub', 'UC-003', 'Accessories', 49.99, 25.00, 200, 30, 'Marvin Cars', '7-in-1 USB-C hub with HDMI and USB 3.0 ports', 'active'),
            ('Monitor Stand', 'MS-004', 'Furniture', 39.99, 18.00, 50, 10, 'Porman Barangs', 'Adjustable aluminum monitor stand with storage', 'active'),
            ('Webcam HD', 'WC-005', 'Electronics', 69.99, 35.00, 100, 20, 'Joel La Forte', '1080p HD webcam with built-in microphone', 'active')
        ");
        echo "Sample data inserted successfully!\n";
    }
    
    echo "Database initialized successfully at: $dbPath\n";
    $db->close();
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
