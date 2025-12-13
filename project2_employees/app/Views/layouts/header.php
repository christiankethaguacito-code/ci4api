<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? $title . ' | ' : '' ?>HR Employee System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #d97706;
            --primary-dark: #b45309;
            --primary-light: #f59e0b;
            --secondary-color: #78350f;
            --accent-color: #fbbf24;
            --bg-light: #fffbeb;
            --text-dark: #292524;
            --gradient: linear-gradient(135deg, #f59e0b 0%, #d97706 50%, #b45309 100%);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #fffbeb 0%, #fef3c7 100%);
            font-family: 'Poppins', sans-serif;
            color: var(--text-dark);
            min-height: 100vh;
        }

        .navbar {
            background: var(--gradient);
            padding: 15px 0;
            box-shadow: 0 4px 20px rgba(217, 119, 6, 0.3);
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            letter-spacing: -0.5px;
        }

        .nav-link {
            font-weight: 500;
            transition: all 0.3s ease;
            border-radius: 8px;
            margin: 0 5px;
        }

        .nav-link:hover {
            background: rgba(255,255,255,0.15);
            transform: translateY(-2px);
        }

        .btn-primary {
            background: var(--gradient);
            border: none;
            padding: 10px 25px;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(217, 119, 6, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(217, 119, 6, 0.4);
        }

        .card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.12);
        }

        .card-header {
            background: var(--gradient);
            color: #fff;
            padding: 18px 25px;
            font-weight: 600;
            font-size: 1.1rem;
            border: none;
        }

        .table thead th {
            background: linear-gradient(135deg, #fffbeb, #fef3c7);
            color: var(--secondary-color);
            font-weight: 600;
            border: none;
            padding: 15px;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
        }

        .table tbody tr {
            transition: all 0.2s ease;
        }

        .table tbody tr:hover {
            background-color: rgba(251, 191, 36, 0.1);
            transform: scale(1.01);
        }

        .table tbody td {
            padding: 15px;
            vertical-align: middle;
            border-color: #fde68a;
        }

        .badge-status {
            padding: 6px 14px;
            border-radius: 25px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .badge-active {
            background: linear-gradient(135deg, #22c55e, #16a34a);
            color: white;
        }

        .badge-inactive {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: white;
        }

        .badge-dept {
            background: var(--gradient);
            color: white;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .page-title {
            background: linear-gradient(135deg, rgba(255,255,255,0.9), rgba(254,243,199,0.9));
            padding: 30px 0;
            margin-bottom: 30px;
            border-bottom: 3px solid var(--accent-color);
            backdrop-filter: blur(10px);
        }

        .form-control, .form-select {
            border-radius: 10px;
            padding: 12px 16px;
            border: 2px solid #fde68a;
            transition: all 0.3s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 4px rgba(217, 119, 6, 0.15);
        }

        .input-group-text {
            background: var(--bg-light);
            border: 2px solid #fde68a;
            border-right: none;
            border-radius: 10px 0 0 10px;
            color: var(--primary-color);
        }

        .input-group .form-control {
            border-radius: 0 10px 10px 0;
        }

        .alert {
            border-radius: 12px;
            border: none;
            padding: 16px 20px;
            font-weight: 500;
        }

        .alert-success {
            background: linear-gradient(135deg, #fef3c7, #fffbeb);
            color: var(--secondary-color);
        }

        .action-btn {
            padding: 8px 12px;
            margin: 2px;
            border-radius: 8px;
            transition: all 0.2s ease;
        }

        .action-btn:hover {
            transform: scale(1.1);
        }

        .btn-info {
            background: linear-gradient(135deg, #0ea5e9, #0284c7);
            border: none;
            color: white;
        }

        .btn-warning {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            border: none;
            color: white;
        }

        .btn-danger {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            border: none;
        }

        footer {
            background: var(--gradient);
            color: white;
            padding: 25px 0;
            margin-top: 60px;
        }

        .empty-box {
            text-align: center;
            padding: 80px 20px;
        }

        .empty-box i {
            font-size: 5rem;
            background: var(--gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 25px;
        }

        .stats-card {
            background: var(--gradient);
            color: white;
            border-radius: 16px;
            padding: 25px;
            text-align: center;
            transition: all 0.3s ease;
        }

        .stats-card:hover {
            transform: translateY(-5px);
        }

        .stats-card h3 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 5px;
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .card, .alert, .page-title {
            animation: fadeInUp 0.5s ease forwards;
        }

        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #fef3c7; }
        ::-webkit-scrollbar-thumb { background: var(--primary-color); border-radius: 4px; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="/employees">
                <i class="fas fa-users-cog me-2"></i>HR System
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/employees"><i class="fas fa-users me-1"></i>Employees</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/employees/create"><i class="fas fa-user-plus me-1"></i>Add New</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/api/employees" target="_blank"><i class="fas fa-code me-1"></i>API</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container py-4">
