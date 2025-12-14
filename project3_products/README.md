# Product Inventory Management System

A CodeIgniter 4 CRUD application for managing product inventory with RESTful API.

## Features

- Complete CRUD operations for products
- RESTful API endpoints
- Purple/Violet theme design
- Inventory tracking (quantity, min stock)
- Stock status indicators
- Category management
- Supplier tracking
- Dashboard with statistics

## Theme

**Color Scheme:** Purple/Violet
- Primary: #7c3aed
- Secondary: #4c1d95
- Accent: #a78bfa

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
cd project3_products
composer install
```

### 2. Database Setup

1.  Open your database management tool (e.g., phpMyAdmin).
2.  Create a new database named `product_inventory_db`.
3.  Import the `database_setup.sql` file located in this project folder.

### 3. Configuration

1.  Rename the `env` file to `.env` (if it exists) or copy it:
    ```bash
    cp env .env
    ```
2.  Open `.env` and configure your database connection details. Uncomment the lines and set your values:
    ```ini
    database.default.hostname = localhost
    database.default.database = product_inventory_db
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
php spark serve --port 8083
```

Visit: [http://localhost:8083](http://localhost:8083)

## API Endpoints

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | /api/products | Get all products |
| GET | /api/products/{id} | Get single product |
| POST | /api/products | Create product |
| PUT | /api/products/{id} | Update product |
| DELETE | /api/products/{id} | Delete product |

### API Examples

```bash
# List all
curl http://localhost:8080/api/products

# Get one
curl http://localhost:8080/api/products/1

# Create
curl -X POST http://localhost:8080/api/products \
  -H "Content-Type: application/json" \
  -d '{"name":"New Product","sku":"NEW-001","category":"Electronics","price":99.99,"quantity":50,"supplier":"Test Supplier"}'

# Update
curl -X PUT http://localhost:8080/api/products/1 \
  -H "Content-Type: application/json" \
  -d '{"name":"Updated Product","sku":"UPD-001","category":"Tools","price":149.99,"quantity":25,"supplier":"New Supplier"}'

# Delete
curl -X DELETE http://localhost:8080/api/products/1
```

## Structure

```
project3_products/
├── app/
│   ├── Config/
│   │   ├── Database.php
│   │   └── Routes.php
│   ├── Controllers/
│   │   ├── ProductController.php
│   │   └── Api/
│   │       └── ProductApiController.php
│   ├── Models/
│   │   └── ProductModel.php
│   ├── Views/
│   │   ├── products/
│   │   │   ├── index.php
│   │   │   ├── add.php
│   │   │   ├── edit.php
│   │   │   └── details.php
│   │   └── partials/
│   │       ├── header.php
│   │       └── footer.php
│   └── Database/
│       └── Migrations/
├── database_setup.sql
└── README.md
```
