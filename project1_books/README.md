# Book Library Management System

A CodeIgniter 4 CRUD application for managing books with RESTful API support.

## Features

- ✅ Full CRUD operations (Create, Read, Update, Delete)
- ✅ RESTful API endpoints
- ✅ Responsive design with Green/Emerald theme
- ✅ Form validation
- ✅ Flash messages for user feedback
- ✅ Clean and modern UI

## Theme

**Color Scheme:** Green/Emerald
- Primary: #059669
- Secondary: #064e3b
- Accent: #34d399

## Quick Start (Automated Setup)

For a one-click setup that **automatically installs all required tools**, simply run:

### Windows

1. **First-time setup:** Double-click `setup.bat` or run:
   ```cmd
   setup.bat
   ```
   This will automatically:
   - ✅ Install PHP 8.3 (if not found)
   - ✅ Install Composer (if not found)
   - ✅ Detect/configure MySQL (XAMPP, WAMP, or standalone)
   - ✅ Add all tools to your system PATH
   - ✅ Install Composer dependencies
   - ✅ Create the `.env` file
   - ✅ Set up the database (prompts for MySQL credentials)

2. **Run the server:** Double-click `run.bat` or run:
   ```cmd
   run.bat
   ```

> **Tip:** Run `setup.bat` as Administrator for best results.
> 
> **Note:** Tools are installed to `%USERPROFILE%\DevTools`. Restart your terminal after first setup for PATH changes.

---

## Requirements

Please refer to the `requirements.txt` file in the root directory for a list of necessary software.
- PHP >= 8.1
- Composer
- MySQL / MariaDB

## Manual Installation & Setup

### 1. Install Dependencies

Navigate to the project directory and install the required dependencies using Composer:

```bash
cd project1_books
composer install
```

### 2. Database Setup

1.  Open your database management tool (e.g., phpMyAdmin).
2.  Create a new database named `book_library_db`.
3.  Import the `database_setup.sql` file located in this project folder.

### 3. Configuration

1.  Rename the `env` file to `.env` (if it exists) or copy it:
    ```bash
    cp env .env
    ```
2.  Open `.env` and configure your database connection details. Uncomment the lines and set your values:
    ```ini
    database.default.hostname = localhost
    database.default.database = book_library_db
    database.default.username = root
    database.default.password = 
    database.default.DBDriver = MySQLi
    ```
3.  Set the environment to development in `.env`:
    ```ini
    CI_ENVIRONMENT = development
    ```

### 4. Run the Application

Start the local development server:

```bash
php spark serve --port 8080
```

Visit: [http://localhost:8080](http://localhost:8080)

## API Endpoints

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | /api/books | Get all books |
| GET | /api/books/{id} | Get single book |
| POST | /api/books | Create new book |
| PUT | /api/books/{id} | Update book |
| DELETE | /api/books/{id} | Delete book |

### API Example (using curl)

```bash
# Get all books
curl http://localhost:8080/api/books

# Get single book
curl http://localhost:8080/api/books/1

# Create book
curl -X POST http://localhost:8080/api/books \
  -H "Content-Type: application/json" \
  -d '{"title":"New Book","author":"Author Name","isbn":"978-1234567890","published_year":2024,"genre":"Fiction","price":19.99}'

# Update book
curl -X PUT http://localhost:8080/api/books/1 \
  -H "Content-Type: application/json" \
  -d '{"title":"Updated Title","author":"Author Name","isbn":"978-1234567890","published_year":2024,"genre":"Fiction","price":24.99}'

# Delete book
curl -X DELETE http://localhost:8080/api/books/1
```

## Project Structure

```
project1_books/
├── app/
│   ├── Config/
│   │   ├── Database.php
│   │   └── Routes.php
│   ├── Controllers/
│   │   ├── BookController.php
│   │   └── Api/
│   │       └── BookApiController.php
│   ├── Models/
│   │   └── BookModel.php
│   ├── Views/
│   │   ├── books/
│   │   │   ├── index.php
│   │   │   ├── create.php
│   │   │   ├── edit.php
│   │   │   └── show.php
│   │   └── templates/
│   │       ├── header.php
│   │       └── footer.php
│   └── Database/
│       └── Migrations/
├── database_setup.sql
└── README.md
```
