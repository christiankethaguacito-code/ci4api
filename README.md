# CodeIgniter 4 CRUD Projects Collection

Three complete CodeIgniter 4 CRUD applications with RESTful APIs, each with unique themes and functionalities.

## Projects Overview

| # | Project | Theme Color | Database |
|---|---------|-------------|----------|
| 1 | Book Library System | 🟢 Green/Emerald | book_library_db |
| 2 | Employee Management | 🟠 Orange/Amber | employee_management_db |
| 3 | Product Inventory | 🟣 Purple/Violet | product_inventory_db |

---

## Project 1: Book Library Management System

**Theme:** Green/Emerald (#059669)

**Features:**
- Manage books (title, author, ISBN, year, genre, price)
- Full CRUD operations
- RESTful API

**Database:** `book_library_db`

**Routes:**
- `/books` - View all books
- `/books/create` - Add new book
- `/books/edit/{id}` - Edit book
- `/books/show/{id}` - View book details
- `/api/books` - API endpoints

---

## Project 2: Employee Management System

**Theme:** Orange/Amber (#d97706)

**Features:**
- Manage employees (name, email, department, salary, etc.)
- Status tracking (active, inactive, on leave)
- Full CRUD operations
- RESTful API

**Database:** `employee_management_db`

**Routes:**
- `/employees` - View all employees
- `/employees/create` - Add new employee
- `/employees/edit/{id}` - Edit employee
- `/employees/view/{id}` - View details
- `/api/employees` - API endpoints

---

## Project 3: Product Inventory System

**Theme:** Purple/Violet (#7c3aed)

**Features:**
- Manage products (name, SKU, category, price, quantity)
- Stock level tracking
- Status indicators (in stock, low stock, out of stock)
- Dashboard with statistics
- Full CRUD operations
- RESTful API

**Database:** `product_inventory_db`

**Routes:**
- `/products` - View inventory
- `/products/add` - Add product
- `/products/edit/{id}` - Edit product
- `/products/details/{id}` - View details
- `/api/products` - API endpoints

---

## Setup Instructions

### Prerequisites
- PHP 7.4 or higher
- MySQL 5.7 or higher
- Composer
- Apache/Nginx web server

### For Each Project:

1. **Install CodeIgniter 4**
   ```bash
   composer create-project codeigniter4/appstarter temp_ci4
   ```
   Copy the system, vendor, spark, and other CI4 files to each project folder.

2. **Setup Database**
   - Run the `database_setup.sql` file in each project folder
   - Or run migrations: `php spark migrate`

3. **Configure Database**
   - Edit `app/Config/Database.php` in each project
   - Update hostname, username, password as needed

4. **Run the Application**
   ```bash
   php spark serve
   ```
   
   Or configure your web server to point to the `public` folder.

5. **Access the Application**
   - Web UI: http://localhost:8080
   - API: http://localhost:8080/api/{resource}

---

## API Documentation

All projects support RESTful API operations:

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | /api/{resource} | Get all records |
| GET | /api/{resource}/{id} | Get single record |
| POST | /api/{resource} | Create new record |
| PUT | /api/{resource}/{id} | Update record |
| DELETE | /api/{resource}/{id} | Delete record |

### Example API Calls

```bash
# GET all records
curl http://localhost:8080/api/books

# GET single record
curl http://localhost:8080/api/books/1

# POST create (JSON)
curl -X POST http://localhost:8080/api/books \
  -H "Content-Type: application/json" \
  -d '{"title":"Book Title","author":"Author Name",...}'

# PUT update
curl -X PUT http://localhost:8080/api/books/1 \
  -H "Content-Type: application/json" \
  -d '{"title":"Updated Title",...}'

# DELETE
curl -X DELETE http://localhost:8080/api/books/1
```

---

## Folder Structure

```
ci4CRUD/
├── project1_books/
│   ├── app/
│   │   ├── Config/
│   │   ├── Controllers/
│   │   ├── Models/
│   │   ├── Views/
│   │   └── Database/
│   ├── database_setup.sql
│   └── README.md
│
├── project2_employees/
│   ├── app/
│   │   ├── Config/
│   │   ├── Controllers/
│   │   ├── Models/
│   │   ├── Views/
│   │   └── Database/
│   ├── database_setup.sql
│   └── README.md
│
├── project3_products/
│   ├── app/
│   │   ├── Config/
│   │   ├── Controllers/
│   │   ├── Models/
│   │   ├── Views/
│   │   └── Database/
│   ├── database_setup.sql
│   └── README.md
│
└── README.md (this file)
```

---

## Technologies Used

- **Backend:** CodeIgniter 4 (PHP Framework)
- **Frontend:** Bootstrap 5, Font Awesome 6
- **Database:** MySQL
- **API:** RESTful JSON APIs

---

## Credits

Created for Academic Assignment - December 2024

Each project demonstrates:
- MVC Architecture
- Database CRUD Operations
- Form Validation
- RESTful API Development
- Responsive Web Design
- Session Flash Messages
