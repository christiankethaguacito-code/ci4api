<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? $title . ' - ' : '' ?>Inventory Manager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #7c3aed;
            --primary-dark: #5b21b6;
            --primary-light: #8b5cf6;
            --secondary-color: #4c1d95;
            --accent-color: #a78bfa;
            --bg-light: #f5f3ff;
            --text-dark: #1e1b4b;
            --gradient: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 50%, #5b21b6 100%);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #faf5ff 0%, #f3e8ff 50%, #ede9fe 100%);
            font-family: 'Poppins', sans-serif;
            color: var(--text-dark);
            min-height: 100vh;
        }

        .navbar {
            background: var(--gradient);
            padding: 15px 0;
            box-shadow: 0 4px 20px rgba(124, 58, 237, 0.3);
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
            box-shadow: 0 4px 15px rgba(124, 58, 237, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(124, 58, 237, 0.4);
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
            color: white;
            padding: 18px 25px;
            font-weight: 600;
            font-size: 1.1rem;
            border: none;
        }

        .table thead th {
            background: linear-gradient(135deg, #f5f3ff, #ede9fe);
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
            background-color: rgba(167, 139, 250, 0.1);
            transform: scale(1.01);
        }

        .table tbody td {
            padding: 15px;
            vertical-align: middle;
            border-color: #e9d5ff;
        }

        .status-badge {
            padding: 6px 14px;
            border-radius: 25px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .status-in_stock {
            background: linear-gradient(135deg, #22c55e, #16a34a);
            color: white;
        }

        .status-low_stock {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            color: white;
        }

        .status-out_of_stock {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: white;
        }

        .cat-badge {
            background: var(--gradient);
            color: white;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .page-title-section {
            background: linear-gradient(135deg, rgba(255,255,255,0.9), rgba(245,243,255,0.9));
            padding: 30px 0;
            margin-bottom: 30px;
            border-bottom: 3px solid var(--accent-color);
            backdrop-filter: blur(10px);
        }

        .form-control, .form-select {
            border-radius: 10px;
            padding: 12px 16px;
            border: 2px solid #e9d5ff;
            transition: all 0.3s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 4px rgba(124, 58, 237, 0.15);
        }

        .input-group-text {
            background: var(--bg-light);
            border: 2px solid #e9d5ff;
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
            background: linear-gradient(135deg, #f5f3ff, #ede9fe);
            color: var(--secondary-color);
        }

        .action-buttons .btn {
            padding: 8px 12px;
            margin: 2px;
            border-radius: 8px;
            transition: all 0.2s ease;
        }

        .action-buttons .btn:hover {
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

        .no-data {
            text-align: center;
            padding: 80px 25px;
        }

        .no-data i {
            font-size: 5rem;
            background: var(--gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 25px;
        }

        .summary-box {
            background: var(--gradient);
            color: white;
            border-radius: 16px;
            padding: 25px;
            text-align: center;
            margin-bottom: 15px;
            transition: all 0.3s ease;
        }

        .summary-box:hover {
            transform: translateY(-5px);
        }

        .summary-box h4 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .sku-code {
            font-family: 'Consolas', monospace;
            background: linear-gradient(135deg, #f5f3ff, #ede9fe);
            padding: 4px 10px;
            border-radius: 6px;
            color: var(--primary-dark);
            font-size: 0.85rem;
            font-weight: 500;
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .card, .alert, .page-title-section, .summary-box {
            animation: fadeInUp 0.5s ease forwards;
        }

        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #f5f3ff; }
        ::-webkit-scrollbar-thumb { background: var(--primary-color); border-radius: 4px; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="/products">
                <i class="fas fa-boxes-stacked me-2"></i>Inventory Pro
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navMenu">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/products"><i class="fas fa-warehouse me-1"></i>Inventory</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/products/add"><i class="fas fa-plus-circle me-1"></i>Add Product</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/api/products" target="_blank"><i class="fas fa-code me-1"></i>API</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container py-4">
