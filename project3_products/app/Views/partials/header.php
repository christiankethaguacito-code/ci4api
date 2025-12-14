<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? $title . ' - ' : '' ?>Inventory Manager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --purple-50: #faf5ff;
            --purple-100: #f3e8ff;
            --purple-200: #e9d5ff;
            --purple-400: #c084fc;
            --purple-500: #a855f7;
            --purple-600: #9333ea;
            --purple-700: #7e22ce;
            --pink-500: #ec4899;
            --cyan-400: #22d3ee;
            --bg-white: #ffffff;
            --text-dark: #1e1b4b;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Space Grotesk', sans-serif;
            background: var(--purple-50);
            color: var(--text-dark);
            min-height: 100vh;
        }

        /* Colorful Top Header Bar */
        .top-header {
            background: linear-gradient(90deg, var(--purple-600), var(--pink-500), var(--purple-500));
            height: 6px;
        }

        /* Main Navigation */
        .navbar {
            background: var(--bg-white);
            padding: 20px 0;
            box-shadow: 0 4px 30px rgba(147, 51, 234, 0.1);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.8rem;
            background: linear-gradient(135deg, var(--purple-600), var(--pink-500));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .navbar-brand .logo-icon {
            background: linear-gradient(135deg, var(--purple-600), var(--pink-500));
            color: white;
            width: 45px;
            height: 45px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
        }

        .nav-pills {
            background: var(--purple-100);
            padding: 6px;
            border-radius: 16px;
        }

        .nav-pills .nav-link {
            color: var(--purple-700);
            font-weight: 600;
            padding: 12px 24px;
            border-radius: 12px;
            transition: all 0.3s ease;
            margin: 0 4px;
        }

        .nav-pills .nav-link:hover {
            background: var(--purple-200);
        }

        .nav-pills .nav-link.active,
        .nav-pills .nav-link:active {
            background: linear-gradient(135deg, var(--purple-600), var(--pink-500));
            color: white;
            box-shadow: 0 8px 25px rgba(147, 51, 234, 0.35);
        }

        /* Hero Section */
        .page-hero {
            background: linear-gradient(135deg, var(--purple-600), var(--pink-500));
            padding: 50px 0;
            margin-bottom: 40px;
            position: relative;
            overflow: hidden;
        }

        .page-hero::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 500px;
            height: 500px;
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
        }

        .page-hero::after {
            content: '';
            position: absolute;
            bottom: -30%;
            left: -10%;
            width: 300px;
            height: 300px;
            background: rgba(255,255,255,0.08);
            border-radius: 50%;
        }

        .page-hero h1 {
            color: white;
            font-weight: 700;
            font-size: 2.5rem;
            position: relative;
            z-index: 1;
        }

        .page-hero p {
            color: rgba(255,255,255,0.85);
            font-size: 1.1rem;
            position: relative;
            z-index: 1;
        }

        /* Product Cards Grid Layout */
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 25px;
        }

        .product-card {
            background: white;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(147, 51, 234, 0.08);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            border: 2px solid transparent;
        }

        .product-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 25px 60px rgba(147, 51, 234, 0.2);
            border-color: var(--purple-300);
        }

        .product-card .card-img-top {
            height: 180px;
            background: linear-gradient(135deg, var(--purple-100), var(--purple-200));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 4rem;
            color: var(--purple-400);
        }

        .product-card .card-body {
            padding: 25px;
        }

        .product-card .card-title {
            font-weight: 700;
            font-size: 1.2rem;
            color: var(--text-dark);
            margin-bottom: 10px;
        }

        /* Standard Cards */
        .card {
            background: white;
            border: none;
            border-radius: 24px;
            box-shadow: 0 10px 40px rgba(147, 51, 234, 0.08);
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .card:hover {
            box-shadow: 0 20px 60px rgba(147, 51, 234, 0.15);
        }

        .card-header {
            background: linear-gradient(135deg, var(--purple-600), var(--pink-500));
            color: white;
            padding: 25px 30px;
            font-weight: 700;
            font-size: 1.2rem;
            border: none;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .card-header i {
            background: rgba(255,255,255,0.2);
            padding: 12px;
            border-radius: 12px;
        }

        .card-body {
            padding: 30px;
        }

        /* Colorful Stats */
        .summary-box {
            border-radius: 20px;
            padding: 30px;
            text-align: center;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .summary-box:hover {
            transform: translateY(-8px);
        }

        .summary-box.purple {
            background: linear-gradient(135deg, var(--purple-600), var(--purple-700));
            color: white;
        }

        .summary-box.pink {
            background: linear-gradient(135deg, var(--pink-500), #f472b6);
            color: white;
        }

        .summary-box.cyan {
            background: linear-gradient(135deg, var(--cyan-400), #06b6d4);
            color: white;
        }

        .summary-box.gradient {
            background: linear-gradient(135deg, var(--purple-600), var(--pink-500));
            color: white;
        }

        .summary-box h4 {
            font-size: 3rem;
            font-weight: 800;
            margin-bottom: 5px;
        }

        .summary-box p {
            margin: 0;
            opacity: 0.9;
            font-weight: 500;
        }

        /* Table */
        .table {
            margin: 0;
        }

        .table thead th {
            background: var(--purple-100);
            color: var(--purple-700);
            font-weight: 700;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 1.5px;
            padding: 18px 20px;
            border: none;
        }

        .table tbody tr {
            transition: all 0.3s ease;
        }

        .table tbody tr:hover {
            background: var(--purple-50);
            transform: scale(1.01);
        }

        .table tbody td {
            padding: 20px;
            vertical-align: middle;
            border-bottom: 1px solid var(--purple-100);
        }

        /* Status Badges - Pill Style */
        .status-badge {
            padding: 10px 20px;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .status-in_stock { 
            background: linear-gradient(135deg, #22c55e, #16a34a); 
            color: white; 
            box-shadow: 0 4px 15px rgba(34, 197, 94, 0.3);
        }
        .status-low_stock { 
            background: linear-gradient(135deg, #f59e0b, #d97706); 
            color: white; 
            box-shadow: 0 4px 15px rgba(245, 158, 11, 0.3);
        }
        .status-out_of_stock { 
            background: linear-gradient(135deg, #ef4444, #dc2626); 
            color: white; 
            box-shadow: 0 4px 15px rgba(239, 68, 68, 0.3);
        }

        .cat-badge {
            background: linear-gradient(135deg, var(--purple-500), var(--pink-500));
            color: white;
            padding: 8px 16px;
            border-radius: 50px;
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .sku-code {
            font-family: 'JetBrains Mono', monospace;
            background: var(--purple-100);
            color: var(--purple-700);
            padding: 6px 14px;
            border-radius: 8px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        /* Buttons */
        .btn-primary {
            background: linear-gradient(135deg, var(--purple-600), var(--pink-500));
            border: none;
            padding: 14px 32px;
            border-radius: 14px;
            font-weight: 700;
            transition: all 0.3s ease;
            box-shadow: 0 10px 30px rgba(147, 51, 234, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-4px) scale(1.02);
            box-shadow: 0 15px 40px rgba(147, 51, 234, 0.45);
            background: linear-gradient(135deg, var(--purple-700), var(--pink-500));
        }

        .btn-outline-primary {
            border: 2px solid var(--purple-500);
            color: var(--purple-600);
            padding: 12px 28px;
            border-radius: 14px;
            font-weight: 700;
        }

        .btn-outline-primary:hover {
            background: linear-gradient(135deg, var(--purple-600), var(--pink-500));
            border-color: transparent;
            color: white;
        }

        /* Action Buttons */
        .action-buttons .btn {
            width: 42px;
            height: 42px;
            border-radius: 14px;
            padding: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin: 0 4px;
            transition: all 0.3s ease;
            border: none;
        }

        .action-buttons .btn:hover {
            transform: translateY(-4px) scale(1.1);
        }

        .btn-info { 
            background: var(--cyan-400); 
            color: white; 
            box-shadow: 0 6px 20px rgba(34, 211, 238, 0.4);
        }
        .btn-warning { 
            background: linear-gradient(135deg, #f59e0b, #d97706); 
            color: white; 
            box-shadow: 0 6px 20px rgba(245, 158, 11, 0.4);
        }
        .btn-danger { 
            background: linear-gradient(135deg, #ef4444, #dc2626); 
            color: white; 
            box-shadow: 0 6px 20px rgba(239, 68, 68, 0.4);
        }

        /* Forms */
        .form-control, .form-select {
            border: 2px solid var(--purple-200);
            border-radius: 14px;
            padding: 16px 20px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--purple-500);
            box-shadow: 0 0 0 4px rgba(147, 51, 234, 0.15);
        }

        .form-label {
            color: var(--purple-700);
            font-weight: 700;
            margin-bottom: 12px;
        }

        /* Alerts */
        .alert {
            border-radius: 16px;
            border: none;
            padding: 20px 25px;
            font-weight: 600;
        }

        .alert-success {
            background: linear-gradient(135deg, #dcfce7, #d1fae5);
            color: #166534;
            border-left: 5px solid #22c55e;
        }

        /* Empty State */
        .no-data {
            text-align: center;
            padding: 80px 30px;
        }

        .no-data i {
            font-size: 6rem;
            background: linear-gradient(135deg, var(--purple-400), var(--pink-500));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 30px;
        }

        .no-data h4 {
            color: var(--purple-700);
            font-weight: 700;
        }

        /* Footer */
        footer {
            background: linear-gradient(135deg, var(--purple-600), var(--pink-500));
            color: white;
            padding: 35px 0;
            margin-top: 60px;
            text-align: center;
        }

        footer a {
            color: rgba(255,255,255,0.8);
            text-decoration: none;
        }

        footer a:hover {
            color: white;
        }

        /* Animations */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        .card, .product-card, .summary-box, .alert {
            animation: fadeInUp 0.6s ease forwards;
        }

        /* Scrollbar */
        ::-webkit-scrollbar { width: 10px; }
        ::-webkit-scrollbar-track { background: var(--purple-100); }
        ::-webkit-scrollbar-thumb { 
            background: linear-gradient(180deg, var(--purple-400), var(--pink-500)); 
            border-radius: 5px; 
        }
    </style>
</head>
<body>
    <div class="top-header"></div>
    
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="/products">
                <span class="logo-icon"><i class="fas fa-cube"></i></span>
                StockPro
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navMenu">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link" href="/products"><i class="fas fa-boxes-stacked me-2"></i>Inventory</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/products/add"><i class="fas fa-plus me-2"></i>Add New</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/api/products" target="_blank"><i class="fas fa-code me-2"></i>API</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container py-4">
