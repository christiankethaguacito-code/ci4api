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
cd project2_employees
composer install
```

### 2. Database Setup

1.  Open your database management tool (e.g., phpMyAdmin).
2.  Create a new database named `employee_management_db`.
3.  Import the `database_setup.sql` file located in this project folder.

### 3. Configuration

1.  Rename the `env` file to `.env` (if it exists) or copy it:
    ```bash
    cp env .env
    ```
2.  Open `.env` and configure your database connection details. Uncomment the lines and set your values:
    ```ini
    database.default.hostname = localhost
    database.default.database = employee_management_db
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
php spark serve --port 8082
```

Visit: [http://localhost:8082](http://localhost:8082)

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
