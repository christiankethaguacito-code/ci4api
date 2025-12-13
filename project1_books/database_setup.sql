-- Database Setup for Book Library System
-- Run this SQL in phpMyAdmin or MySQL command line

-- Create the database
CREATE DATABASE IF NOT EXISTS book_library_db;
USE book_library_db;

-- Create books table
CREATE TABLE IF NOT EXISTS books (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(200) NOT NULL,
    author VARCHAR(100) NOT NULL,
    isbn VARCHAR(20) NOT NULL,
    published_year INT(4) NOT NULL,
    genre VARCHAR(50) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    description TEXT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert sample data
INSERT INTO books (title, author, isbn, published_year, genre, price, description) VALUES
('The Great Gatsby', 'F. Scott Fitzgerald', '978-0743273565', 1925, 'Fiction', 15.99, 'A story of decadence and excess in the Jazz Age.'),
('To Kill a Mockingbird', 'Harper Lee', '978-0061120084', 1960, 'Fiction', 14.99, 'A gripping tale of racial injustice in the American South.'),
('1984', 'George Orwell', '978-0451524935', 1949, 'Science Fiction', 12.99, 'A dystopian social science fiction novel and cautionary tale.'),
('Pride and Prejudice', 'Jane Austen', '978-0141439518', 1813, 'Romance', 9.99, 'A romantic novel of manners.'),
('The Catcher in the Rye', 'J.D. Salinger', '978-0316769488', 1951, 'Fiction', 11.99, 'A story about teenage angst and alienation.');

-- Verify the data
SELECT * FROM books;
