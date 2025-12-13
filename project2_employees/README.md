# Employee Management System

A CodeIgniter 4 CRUD application for managing employees with RESTful API.

## Features

- Full CRUD operations for employees
- RESTful API endpoints
- Orange/Amber theme design
- Employee status tracking (active, inactive, on leave)
- Department categorization
- Form validation
- Responsive layout

## Theme

**Color Scheme:** Orange/Amber
- Primary: #d97706
- Secondary: #78350f
- Accent: #fbbf24

## Setup

### 1. Database

Run SQL from `database_setup.sql` or create database: `employee_management_db`

### 2. Configure Database

Edit `app/Config/Database.php`:
```php
'hostname' => 'localhost',
'username' => 'root',
'password' => '',
'database' => 'employee_management_db',
```

### 3. Run

```bash
php spark serve
```

Open: http://localhost:8080

## API Endpoints

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | /api/employees | List all employees |
| GET | /api/employees/{id} | Get employee |
| POST | /api/employees | Create employee |
| PUT | /api/employees/{id} | Update employee |
| DELETE | /api/employees/{id} | Delete employee |

### API Usage

```bash
# Get all
curl http://localhost:8080/api/employees

# Get one
curl http://localhost:8080/api/employees/1

# Create
curl -X POST http://localhost:8080/api/employees \
  -H "Content-Type: application/json" \
  -d '{"first_name":"Jane","last_name":"Doe","email":"jane@test.com","phone":"555-1234","department":"IT","position":"Developer","salary":60000,"hire_date":"2024-01-01"}'

# Update
curl -X PUT http://localhost:8080/api/employees/1 \
  -H "Content-Type: application/json" \
  -d '{"first_name":"John","last_name":"Updated","email":"john@test.com","phone":"555-4321","department":"HR","position":"Manager","salary":70000,"hire_date":"2024-01-01"}'

# Delete
curl -X DELETE http://localhost:8080/api/employees/1
```

## Structure

```
project2_employees/
├── app/
│   ├── Config/
│   │   ├── Database.php
│   │   └── Routes.php
│   ├── Controllers/
│   │   ├── EmployeeController.php
│   │   └── Api/
│   │       └── EmployeeApiController.php
│   ├── Models/
│   │   └── EmployeeModel.php
│   ├── Views/
│   │   ├── employees/
│   │   │   ├── index.php
│   │   │   ├── create.php
│   │   │   ├── edit.php
│   │   │   └── view.php
│   │   └── layouts/
│   │       ├── header.php
│   │       └── footer.php
│   └── Database/
│       └── Migrations/
├── database_setup.sql
└── README.md
```
