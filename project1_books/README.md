# Book Library System (Project 1)

A CodeIgniter 4 application for managing a book collection.

## 🚀 Quick Start (Standalone)

This project includes a standalone setup script that automatically installs PHP and Composer locally, so you don't need to install anything globally on your system.

### 1. Setup
Double-click `setup.bat` in this folder.
- This will download PHP 8.3 and Composer to `%USERPROFILE%\DevTools`.
- It will install all project dependencies.
- It will attempt to setup the database (requires XAMPP/MySQL running).

### 2. Run
Double-click `run.bat` to start the server.
- The application will be available at: http://localhost:8080

## 🛠 Manual Setup (If you prefer)

1.  **Prerequisites:**
    *   PHP 8.1 or higher
    *   Composer
    *   MySQL Database (XAMPP/WAMP)

2.  **Installation:**
    ```bash
    composer install
    cp env .env
    # Edit .env with your database credentials
    ```

3.  **Database:**
    *   Create a database named `book_library_db`.
    *   Import `database_setup.sql`.

4.  **Run:**
    ```bash
    php spark serve --port 8080
    ```
