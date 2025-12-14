<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? $title . ' | ' : '' ?>HR Employee System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-dark: #0f172a;
            --bg-darker: #020617;
            --bg-card: #1e293b;
            --bg-card-hover: #334155;
            --primary: #f59e0b;
            --primary-light: #fbbf24;
            --accent: #fcd34d;
            --text-white: #f8fafc;
            --text-muted: #94a3b8;
            --border-color: #334155;
            --success: #22c55e;
            --danger: #ef4444;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg-darker);
            color: var(--text-white);
            min-height: 100vh;
        }

        /* Sidebar Navigation */
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
            width: 280px;
            background: var(--bg-dark);
            border-right: 1px solid var(--border-color);
            padding: 30px 0;
            z-index: 1000;
            transition: all 0.3s ease;
        }

        .sidebar-brand {
            padding: 0 30px 30px;
            border-bottom: 1px solid var(--border-color);
            margin-bottom: 30px;
        }

        .sidebar-brand h4 {
            color: var(--primary);
            font-weight: 800;
            font-size: 1.5rem;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .sidebar-brand h4 i {
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            padding: 12px;
            border-radius: 12px;
            font-size: 1.2rem;
        }

        .sidebar-brand span {
            font-size: 0.75rem;
            color: var(--text-muted);
            font-weight: 400;
            display: block;
            margin-top: 5px;
        }

        .nav-menu {
            list-style: none;
            padding: 0 15px;
        }

        .nav-menu li {
            margin-bottom: 8px;
        }

        .nav-menu a {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 14px 20px;
            color: var(--text-muted);
            text-decoration: none;
            border-radius: 12px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .nav-menu a:hover, .nav-menu a.active {
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: var(--bg-dark);
            transform: translateX(5px);
            box-shadow: 0 10px 30px rgba(245, 158, 11, 0.3);
        }

        .nav-menu a i {
            width: 24px;
            text-align: center;
            font-size: 1.1rem;
        }

        /* Main Content */
        .main-content {
            margin-left: 280px;
            padding: 30px 40px;
            min-height: 100vh;
        }

        /* Top Bar */
        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
            padding-bottom: 20px;
            border-bottom: 1px solid var(--border-color);
        }

        .page-title h1 {
            font-size: 2rem;
            font-weight: 800;
            margin: 0;
            background: linear-gradient(135deg, var(--text-white), var(--text-muted));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .page-title p {
            color: var(--text-muted);
            margin: 5px 0 0;
            font-size: 0.9rem;
        }

        /* Cards */
        .card {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .card:hover {
            border-color: var(--primary);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.4);
            transform: translateY(-5px);
        }

        .card-header {
            background: transparent;
            border-bottom: 1px solid var(--border-color);
            padding: 25px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-header h5 {
            margin: 0;
            font-weight: 700;
            color: var(--text-white);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .card-header h5 i {
            color: var(--primary);
        }

        .card-body {
            padding: 30px;
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }

        .stat-box {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            padding: 25px;
            transition: all 0.3s ease;
        }

        .stat-box:hover {
            border-color: var(--primary);
            transform: translateY(-5px);
        }

        .stat-box .icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;
            font-size: 1.3rem;
        }

        .stat-box .icon.orange { background: rgba(245, 158, 11, 0.15); color: var(--primary); }
        .stat-box .icon.green { background: rgba(34, 197, 94, 0.15); color: var(--success); }
        .stat-box .icon.red { background: rgba(239, 68, 68, 0.15); color: var(--danger); }
        .stat-box .icon.blue { background: rgba(59, 130, 246, 0.15); color: #3b82f6; }

        .stat-box h3 {
            font-size: 2rem;
            font-weight: 800;
            margin: 0 0 5px;
        }

        .stat-box p {
            color: var(--text-muted);
            margin: 0;
            font-size: 0.85rem;
            font-weight: 500;
        }

        /* Table */
        .table {
            color: var(--text-white);
            margin: 0;
        }

        .table thead th {
            background: var(--bg-darker);
            color: var(--text-muted);
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 1px;
            padding: 18px 20px;
            border: none;
        }

        .table tbody tr {
            transition: all 0.2s ease;
            border-bottom: 1px solid var(--border-color);
        }

        .table tbody tr:hover {
            background: var(--bg-card-hover);
        }

        .table tbody td {
            padding: 20px;
            vertical-align: middle;
            border: none;
        }

        /* Status Badges */
        .badge-status {
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .badge-active { background: rgba(34, 197, 94, 0.15); color: var(--success); }
        .badge-inactive { background: rgba(239, 68, 68, 0.15); color: var(--danger); }
        .badge-on_leave { background: rgba(245, 158, 11, 0.15); color: var(--primary); }

        .badge-dept {
            background: rgba(245, 158, 11, 0.15);
            color: var(--primary);
            padding: 6px 14px;
            border-radius: 8px;
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
        }

        /* Buttons */
        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            border: none;
            color: var(--bg-dark);
            padding: 12px 28px;
            border-radius: 10px;
            font-weight: 700;
            transition: all 0.3s ease;
            box-shadow: 0 10px 30px rgba(245, 158, 11, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(245, 158, 11, 0.4);
            color: var(--bg-dark);
        }

        .btn-outline-light {
            border: 2px solid var(--border-color);
            color: var(--text-white);
            border-radius: 10px;
            padding: 10px 24px;
            font-weight: 600;
        }

        .btn-outline-light:hover {
            border-color: var(--primary);
            background: var(--primary);
            color: var(--bg-dark);
        }

        /* Action Buttons */
        .action-btn {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            padding: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin: 0 3px;
            transition: all 0.2s ease;
            border: none;
        }

        .action-btn:hover {
            transform: scale(1.15);
        }

        .btn-info { background: rgba(59, 130, 246, 0.15); color: #3b82f6; }
        .btn-info:hover { background: #3b82f6; color: white; }
        .btn-warning { background: rgba(245, 158, 11, 0.15); color: var(--primary); }
        .btn-warning:hover { background: var(--primary); color: var(--bg-dark); }
        .btn-danger { background: rgba(239, 68, 68, 0.15); color: var(--danger); }
        .btn-danger:hover { background: var(--danger); color: white; }

        /* Forms */
        .form-control, .form-select {
            background: var(--bg-darker);
            border: 2px solid var(--border-color);
            color: var(--text-white);
            border-radius: 12px;
            padding: 14px 18px;
            transition: all 0.3s ease;
        }

        .form-control:focus, .form-select:focus {
            background: var(--bg-darker);
            border-color: var(--primary);
            color: var(--text-white);
            box-shadow: 0 0 0 4px rgba(245, 158, 11, 0.15);
        }

        .form-control::placeholder {
            color: var(--text-muted);
        }

        .form-label {
            color: var(--text-muted);
            font-weight: 600;
            margin-bottom: 10px;
            font-size: 0.9rem;
        }

        /* Alerts */
        .alert {
            border-radius: 12px;
            border: none;
            padding: 18px 24px;
            font-weight: 600;
        }

        .alert-success {
            background: rgba(34, 197, 94, 0.15);
            color: var(--success);
            border-left: 4px solid var(--success);
        }

        /* Empty State */
        .empty-box {
            text-align: center;
            padding: 80px 30px;
        }

        .empty-box i {
            font-size: 5rem;
            color: var(--border-color);
            margin-bottom: 25px;
        }

        .empty-box h4 {
            color: var(--text-muted);
            font-weight: 600;
        }

        /* Footer */
        footer {
            background: var(--bg-dark);
            border-top: 1px solid var(--border-color);
            color: var(--text-muted);
            padding: 25px 0;
            text-align: center;
            margin-top: 60px;
        }

        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .card, .stat-box, .alert {
            animation: fadeIn 0.5s ease forwards;
        }

        /* Scrollbar */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: var(--bg-darker); }
        ::-webkit-scrollbar-thumb { background: var(--border-color); border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: var(--primary); }

        /* Mobile Responsive */
        @media (max-width: 992px) {
            .sidebar { transform: translateX(-100%); }
            .main-content { margin-left: 0; }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="sidebar-brand">
            <h4>
                <i class="fas fa-building"></i>
                StaffHub
            </h4>
            <span>Employee Management System</span>
        </div>
        <ul class="nav-menu">
            <li>
                <a href="/employees"><i class="fas fa-chart-pie"></i> Dashboard</a>
            </li>
            <li>
                <a href="/employees"><i class="fas fa-users"></i> All Employees</a>
            </li>
            <li>
                <a href="/employees/create"><i class="fas fa-user-plus"></i> Add Employee</a>
            </li>
            <li>
                <a href="/api/employees" target="_blank"><i class="fas fa-code"></i> API Docs</a>
            </li>
        </ul>
    </aside>

    <!-- Main Content -->
    <div class="main-content">
        <main>

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
