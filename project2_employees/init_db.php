<?php
/**
 * Database Initialization Script for Employee Management
 * Run this script once to create the SQLite database and tables
 */

$dbPath = __DIR__ . '/writable/database.db';

// Create directory if not exists
if (!is_dir(dirname($dbPath))) {
    mkdir(dirname($dbPath), 0777, true);
}

try {
    $db = new SQLite3($dbPath);
    
    // Create employees table
    $db->exec("
        CREATE TABLE IF NOT EXISTS employees (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            first_name VARCHAR(100) NOT NULL,
            last_name VARCHAR(100) NOT NULL,
            email VARCHAR(255) NOT NULL UNIQUE,
            phone VARCHAR(20),
            department VARCHAR(100),
            position VARCHAR(100),
            salary DECIMAL(10,2) DEFAULT 0.00,
            hire_date DATE,
            address TEXT,
            status VARCHAR(20) DEFAULT 'active',
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            updated_at DATETIME DEFAULT CURRENT_TIMESTAMP
        )
    ");
    
    // Check if table is empty, then insert sample data
    $result = $db->querySingle("SELECT COUNT(*) FROM employees");
    if ($result == 0) {
        $db->exec("
            INSERT INTO employees (first_name, last_name, email, phone, department, position, salary, hire_date, address, status) VALUES
            ('Clifford', 'John', 'clifford.john@company.com', '555-0101', 'Engineering', 'Senior Developer', 85000.00, '2022-03-15', '123 Tech Street, Silicon Valley', 'active'),
            ('John', 'Ramos', 'john.ramos@company.com', '555-0102', 'Marketing', 'Marketing Manager', 72000.00, '2021-07-20', '456 Market Ave, Downtown', 'active'),
            ('Marvin', 'Cars', 'marvin.cars@company.com', '555-0103', 'Human Resources', 'HR Specialist', 55000.00, '2023-01-10', '789 HR Plaza, Business District', 'active'),
            ('Porman', 'Barangs', 'porman.barangs@company.com', '555-0104', 'Finance', 'Financial Analyst', 68000.00, '2022-09-01', '321 Finance Road, Uptown', 'active'),
            ('Joel', 'La Forte', 'joel.laforte@company.com', '555-0105', 'Engineering', 'Junior Developer', 55000.00, '2024-02-28', '654 Code Lane, Tech Park', 'active')
        ");
        echo "Sample data inserted successfully!\n";
    }
    
    echo "Database initialized successfully at: $dbPath\n";
    $db->close();
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
