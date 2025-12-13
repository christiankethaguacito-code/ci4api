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

## Setup Instructions

### 1. Database Setup

1. Create the database by running the SQL in `database_setup.sql`
2. Or manually create database: `book_library_db`

### 2. Configuration

Update database credentials in `app/Config/Database.php`:
```php
'hostname' => 'localhost',
'username' => 'root',
'password' => '',
'database' => 'book_library_db',
```

### 3. Run the Application

```bash
php spark serve
```

Visit: http://localhost:8080

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
