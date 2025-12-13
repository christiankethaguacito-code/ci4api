<?= $this->include('partials/header') ?>

<div class="page-title-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-7">
                <h2 class="mb-1"><i class="fas fa-warehouse me-2"></i>Product Inventory</h2>
                <p class="text-muted mb-0">Track and manage your products</p>
            </div>
            <div class="col-md-5 text-md-end mt-3 mt-md-0">
                <a href="/products/add" class="btn btn-primary">
                    <i class="fas fa-plus me-1"></i> Add Product
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Search and Filter Bar -->
<div class="card mb-4">
    <div class="card-body">
        <div class="row">
            <div class="col-md-8">
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                    <input type="text" class="form-control" id="searchInput" placeholder="Search products by name, SKU, or category..." onkeyup="searchTable()">
                </div>
            </div>
            <div class="col-md-4">
                <select class="form-select" id="categoryFilter" onchange="filterByCategory()">
                    <option value="">All Categories</option>
                    <option value="Electronics">Electronics</option>
                    <option value="Accessories">Accessories</option>
                    <option value="Furniture">Furniture</option>
                    <option value="Office">Office</option>
                </select>
            </div>
        </div>
    </div>
</div>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle me-2"></i><?= session()->getFlashdata('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fas fa-exclamation-triangle me-2"></i><?= session()->getFlashdata('error') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<!-- Stats Row -->
<?php if (!empty($products)): ?>
<div class="row mb-4">
    <div class="col-md-4">
        <div class="summary-box">
            <h4><?= count($products) ?></h4>
            <small>Total Products</small>
        </div>
    </div>
    <div class="col-md-4">
        <div class="summary-box" style="background: linear-gradient(135deg, #22c55e, #16a34a);">
            <h4><?= count(array_filter($products, fn($p) => $p['status'] == 'in_stock')) ?></h4>
            <small>In Stock</small>
        </div>
    </div>
    <div class="col-md-4">
        <div class="summary-box" style="background: linear-gradient(135deg, #ef4444, #dc2626);">
            <h4><?= count(array_filter($products, fn($p) => $p['status'] == 'out_of_stock')) ?></h4>
            <small>Out of Stock</small>
        </div>
    </div>
</div>
<?php endif; ?>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="fas fa-list me-2"></i>All Products</span>
        <span class="badge bg-light text-dark"><?= count($products) ?> items</span>
    </div>
    <div class="card-body p-0">
        <?php if (empty($products)): ?>
            <div class="no-data">
                <i class="fas fa-box-open"></i>
                <h5>No Products Found</h5>
                <p class="text-muted">Your inventory is empty. Add your first product!</p>
                <a href="/products/add" class="btn btn-primary">
                    <i class="fas fa-plus me-1"></i> Add Product
                </a>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Product</th>
                            <th>SKU</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Qty</th>
                            <th>Supplier</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($products as $i => $prod): ?>
                            <tr>
                                <td><?= $i + 1 ?></td>
                                <td><strong><?= esc($prod['name']) ?></strong></td>
                                <td><span class="sku-code"><?= esc($prod['sku']) ?></span></td>
                                <td><span class="cat-badge"><?= esc($prod['category']) ?></span></td>
                                <td>$<?= number_format($prod['price'], 2) ?></td>
                                <td>
                                    <?php 
                                    $qtyClass = $prod['quantity'] <= $prod['min_stock'] ? 'text-danger fw-bold' : '';
                                    ?>
                                    <span class="<?= $qtyClass ?>"><?= $prod['quantity'] ?></span>
                                </td>
                                <td><?= esc($prod['supplier']) ?></td>
                                <td>
                                    <span class="status-badge status-<?= $prod['status'] ?>">
                                        <?= ucwords(str_replace('_', ' ', $prod['status'])) ?>
                                    </span>
                                </td>
                                <td class="action-buttons">
                                    <a href="/products/details/<?= $prod['id'] ?>" class="btn btn-info btn-sm" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="/products/edit/<?= $prod['id'] ?>" class="btn btn-warning btn-sm" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button onclick="removeProduct(<?= $prod['id'] ?>)" class="btn btn-danger btn-sm" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>

<?= $this->include('partials/footer') ?>
