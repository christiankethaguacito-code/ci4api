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

## Setup

### 1. Database

Run SQL from `database_setup.sql` or create database: `product_inventory_db`

### 2. Configure

Edit `app/Config/Database.php`:
```php
'hostname' => 'localhost',
'username' => 'root',
'password' => '',
'database' => 'product_inventory_db',
```

### 3. Run

```bash
php spark serve
```

Access: http://localhost:8080

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
