<?php
/**
 * Database Initialization Script for Book Library
 * Run this script once to create the SQLite database and tables
 */

$dbPath = __DIR__ . '/writable/database.db';

// Create directory if not exists
if (!is_dir(dirname($dbPath))) {
    mkdir(dirname($dbPath), 0777, true);
}

try {
    $db = new SQLite3($dbPath);
    
    // Create books table
    $db->exec("
        CREATE TABLE IF NOT EXISTS books (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            title VARCHAR(255) NOT NULL,
            author VARCHAR(255) NOT NULL,
            isbn VARCHAR(20),
            published_year INTEGER,
            genre VARCHAR(100),
            price DECIMAL(10,2) DEFAULT 0.00,
            description TEXT,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            updated_at DATETIME DEFAULT CURRENT_TIMESTAMP
        )
    ");
    
    // Check if table is empty, then insert sample data
    $result = $db->querySingle("SELECT COUNT(*) FROM books");
    if ($result == 0) {
        $db->exec("
            INSERT INTO books (title, author, isbn, published_year, genre, price, description) VALUES
            ('The Great Gatsby', 'Clifford John', '978-0743273565', 1925, 'Classic', 12.99, 'A story of decadence and excess in the Jazz Age.'),
            ('To Kill a Mockingbird', 'John Ramos', '978-0061120084', 1960, 'Fiction', 14.99, 'A powerful story of racial injustice in the American South.'),
            ('1984', 'Marvin Cars', '978-0451524935', 1949, 'Dystopian', 11.99, 'A chilling prophecy about the future.'),
            ('Pride and Prejudice', 'Porman Barangs', '978-0141439518', 1813, 'Romance', 9.99, 'A witty tale of love and social standing.'),
            ('The Catcher in the Rye', 'Joel La Forte', '978-0316769488', 1951, 'Fiction', 13.99, 'The story of teenage alienation and loss of innocence.')
        ");
        echo "Sample data inserted successfully!\n";
    }
    
    echo "Database initialized successfully at: $dbPath\n";
    $db->close();
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
