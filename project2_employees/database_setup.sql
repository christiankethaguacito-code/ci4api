-- Employee Management Database Setup
-- Execute this in phpMyAdmin or MySQL CLI

CREATE DATABASE IF NOT EXISTS employee_management_db;
USE employee_management_db;

-- Create employees table
CREATE TABLE IF NOT EXISTS employees (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    department VARCHAR(50) NOT NULL,
    position VARCHAR(100) NOT NULL,
    salary DECIMAL(12, 2) NOT NULL,
    hire_date DATE NOT NULL,
    address TEXT NULL,
    status ENUM('active', 'inactive', 'on_leave') DEFAULT 'active',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Sample employee data
INSERT INTO employees (first_name, last_name, email, phone, department, position, salary, hire_date, address, status) VALUES
('John', 'Smith', 'john.smith@company.com', '(555) 123-4567', 'IT', 'Senior Developer', 75000.00, '2022-03-15', '123 Main St, City, State 12345', 'active'),
('Sarah', 'Johnson', 'sarah.j@company.com', '(555) 234-5678', 'HR', 'HR Manager', 65000.00, '2021-06-01', '456 Oak Ave, Town, State 67890', 'active'),
('Mike', 'Williams', 'mike.w@company.com', '(555) 345-6789', 'Finance', 'Accountant', 55000.00, '2023-01-10', '789 Pine Rd, Village, State 11223', 'active'),
('Emily', 'Brown', 'emily.b@company.com', '(555) 456-7890', 'Marketing', 'Marketing Specialist', 52000.00, '2023-05-20', '321 Elm Blvd, Metro, State 44556', 'on_leave'),
('David', 'Davis', 'david.d@company.com', '(555) 567-8901', 'Sales', 'Sales Representative', 48000.00, '2022-09-12', '654 Cedar Ln, Borough, State 77889', 'active');

SELECT * FROM employees;
