<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? $title . ' - ' : '' ?>Book Library System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #059669;
            --primary-dark: #047857;
            --accent: #34d399;
            --glass-bg: rgba(255, 255, 255, 0.25);
            --glass-border: rgba(255, 255, 255, 0.18);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Quicksand', sans-serif;
            min-height: 100vh;
            background: linear-gradient(135deg, #064e3b 0%, #059669 50%, #10b981 100%);
            background-attachment: fixed;
            color: #1f2937;
        }

        /* Floating Shapes Background */
        body::before {
            content: '';
            position: fixed;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: 
                radial-gradient(circle at 20% 80%, rgba(52, 211, 153, 0.3) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(16, 185, 129, 0.3) 0%, transparent 50%),
                radial-gradient(circle at 40% 40%, rgba(5, 150, 105, 0.2) 0%, transparent 50%);
            animation: float 20s ease-in-out infinite;
            z-index: -1;
        }

        @keyframes float {
            0%, 100% { transform: translate(0, 0) rotate(0deg); }
            33% { transform: translate(30px, -50px) rotate(120deg); }
            66% { transform: translate(-20px, 20px) rotate(240deg); }
        }

        /* Glassmorphism Navbar */
        .navbar {
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--glass-border);
            padding: 20px 0;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.6rem;
            color: white !important;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
        }

        .navbar-brand i {
            background: white;
            color: var(--primary);
            padding: 10px;
            border-radius: 12px;
            margin-right: 10px;
        }

        .nav-link {
            color: white !important;
            font-weight: 600;
            padding: 10px 20px !important;
            margin: 0 5px;
            border-radius: 25px;
            transition: all 0.3s ease;
        }

        .nav-link:hover, .nav-link.active {
            background: white;
            color: var(--primary) !important;
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        }

        /* Glass Cards */
        .glass-card {
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            border-radius: 24px;
            overflow: hidden;
            transition: all 0.4s ease;
        }

        .glass-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 30px 60px rgba(0,0,0,0.3);
        }

        .card {
            background: white;
            border: none;
            border-radius: 24px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.25);
        }

        .card-header {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            padding: 25px 30px;
            font-weight: 700;
            font-size: 1.2rem;
            border: none;
            position: relative;
            overflow: hidden;
        }

        .card-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(255,255,255,0.1), transparent);
            transform: rotate(45deg);
            animation: shimmer 3s infinite;
        }

        @keyframes shimmer {
            0% { transform: translateX(-100%) rotate(45deg); }
            100% { transform: translateX(100%) rotate(45deg); }
        }

        .card-body {
            padding: 30px;
        }

        /* Buttons */
        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            border: none;
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: 700;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            box-shadow: 0 10px 30px rgba(5, 150, 105, 0.4);
        }

        .btn-primary:hover {
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 15px 40px rgba(5, 150, 105, 0.5);
            background: linear-gradient(135deg, var(--primary-dark), #064e3b);
        }

        .btn-outline-light {
            border: 2px solid white;
            border-radius: 50px;
            padding: 10px 25px;
            font-weight: 600;
        }

        .btn-outline-light:hover {
            background: white;
            color: var(--primary);
        }

        /* Table Styling */
        .table {
            margin: 0;
            border-collapse: separate;
            border-spacing: 0 8px;
        }

        .table thead th {
            background: transparent;
            color: var(--primary-dark);
            font-weight: 700;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 1px;
            padding: 15px 20px;
            border: none;
        }

        .table tbody tr {
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
        }

        .table tbody tr:hover {
            transform: scale(1.02);
            box-shadow: 0 10px 30px rgba(5, 150, 105, 0.2);
        }

        .table tbody td {
            padding: 20px;
            vertical-align: middle;
            border: none;
            background: transparent;
        }

        .table tbody td:first-child {
            border-radius: 16px 0 0 16px;
        }

        .table tbody td:last-child {
            border-radius: 0 16px 16px 0;
        }

        /* Badges */
        .badge-genre {
            background: linear-gradient(135deg, var(--accent), var(--primary));
            color: white;
            padding: 8px 18px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            box-shadow: 0 4px 15px rgba(52, 211, 153, 0.4);
        }

        /* Forms */
        .form-control, .form-select {
            border: 2px solid #e5e7eb;
            border-radius: 16px;
            padding: 15px 20px;
            font-weight: 500;
            transition: all 0.3s ease;
            background: rgba(255,255,255,0.9);
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 4px rgba(52, 211, 153, 0.2);
            background: white;
        }

        .form-label {
            font-weight: 700;
            color: var(--primary-dark);
            margin-bottom: 10px;
        }

        /* Action Buttons */
        .action-btns .btn {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            padding: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin: 0 3px;
            transition: all 0.3s ease;
        }

        .action-btns .btn:hover {
            transform: translateY(-3px) scale(1.1);
        }

        .btn-info { background: linear-gradient(135deg, #06b6d4, #0891b2); border: none; color: white; }
        .btn-warning { background: linear-gradient(135deg, #f59e0b, #d97706); border: none; color: white; }
        .btn-danger { background: linear-gradient(135deg, #ef4444, #dc2626); border: none; }

        /* Page Header */
        .page-header {
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            padding: 40px;
            margin-bottom: 30px;
            border: 1px solid var(--glass-border);
        }

        .page-header h1 {
            color: white;
            font-weight: 700;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
        }

        /* Stats Cards */
        .stat-card {
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            padding: 30px;
            text-align: center;
            color: white;
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.2);
        }

        .stat-card h3 {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 5px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
        }

        .stat-card p {
            opacity: 0.9;
            font-weight: 600;
            margin: 0;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 80px 30px;
            color: white;
        }

        .empty-state i {
            font-size: 6rem;
            margin-bottom: 30px;
            opacity: 0.8;
        }

        .empty-state h4 {
            font-weight: 700;
            font-size: 1.5rem;
        }

        /* Alerts */
        .alert {
            border-radius: 16px;
            border: none;
            padding: 20px 25px;
            font-weight: 600;
            backdrop-filter: blur(10px);
        }

        .alert-success {
            background: rgba(255,255,255,0.9);
            color: var(--primary-dark);
            border-left: 5px solid var(--primary);
        }

        /* Footer */
        footer {
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            color: white;
            padding: 30px 0;
            margin-top: 60px;
            border-top: 1px solid var(--glass-border);
            text-align: center;
        }

        /* Animations */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(40px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .card, .stat-card, .page-header, .alert {
            animation: fadeInUp 0.6s ease forwards;
        }

        /* Scrollbar */
        ::-webkit-scrollbar { width: 10px; }
        ::-webkit-scrollbar-track { background: rgba(255,255,255,0.1); }
        ::-webkit-scrollbar-thumb { background: var(--accent); border-radius: 5px; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="/books">
                <i class="fas fa-book-open"></i>BookVault
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/books"><i class="fas fa-layer-group me-2"></i>Collection</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/books/create"><i class="fas fa-plus-circle me-2"></i>Add Book</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/api/books" target="_blank"><i class="fas fa-plug me-2"></i>API</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container py-4">
