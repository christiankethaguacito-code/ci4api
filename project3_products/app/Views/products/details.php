<?= $this->include('partials/header') ?>

<div class="page-title-section">
    <div class="container">
        <h2><i class="fas fa-box me-2"></i>Product Details</h2>
        <p class="text-muted mb-0">Complete product information</p>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="fas fa-info-circle me-2"></i><?= esc($product['name']) ?></span>
                <span class="status-badge status-<?= $product['status'] ?>">
                    <?= ucwords(str_replace('_', ' ', $product['status'])) ?>
                </span>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="text-muted border-bottom pb-2 mb-3">Product Info</h6>
                        <table class="table table-borderless">
                            <tr>
                                <th width="40%"><i class="fas fa-tag me-2"></i>Name:</th>
                                <td><?= esc($product['name']) ?></td>
                            </tr>
                            <tr>
                                <th><i class="fas fa-barcode me-2"></i>SKU:</th>
                                <td><span class="sku-code"><?= esc($product['sku']) ?></span></td>
                            </tr>
                            <tr>
                                <th><i class="fas fa-folder me-2"></i>Category:</th>
                                <td><span class="cat-badge"><?= esc($product['category']) ?></span></td>
                            </tr>
                            <tr>
                                <th><i class="fas fa-truck me-2"></i>Supplier:</th>
                                <td><?= esc($product['supplier']) ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-muted border-bottom pb-2 mb-3">Stock & Pricing</h6>
                        <table class="table table-borderless">
                            <tr>
                                <th width="40%"><i class="fas fa-dollar-sign me-2"></i>Selling Price:</th>
                                <td><strong class="text-success">$<?= number_format($product['price'], 2) ?></strong></td>
                            </tr>
                            <tr>
                                <th><i class="fas fa-coins me-2"></i>Cost Price:</th>
                                <td>$<?= $product['cost_price'] ? number_format($product['cost_price'], 2) : 'N/A' ?></td>
                            </tr>
                            <tr>
                                <th><i class="fas fa-cubes me-2"></i>Quantity:</th>
                                <td>
                                    <?php 
                                    $qtyClass = $product['quantity'] <= $product['min_stock'] ? 'text-danger fw-bold' : 'text-success';
                                    ?>
                                    <span class="<?= $qtyClass ?>"><?= $product['quantity'] ?> units</span>
                                </td>
                            </tr>
                            <tr>
                                <th><i class="fas fa-exclamation-triangle me-2"></i>Min Stock:</th>
                                <td><?= $product['min_stock'] ?> units</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <?php if (!empty($product['description'])): ?>
                    <hr>
                    <h6 class="text-muted"><i class="fas fa-align-left me-2"></i>Description</h6>
                    <p><?= nl2br(esc($product['description'])) ?></p>
                <?php endif; ?>

                <hr>
                <small class="text-muted">
                    <i class="fas fa-clock me-1"></i>Added: <?= date('M d, Y H:i', strtotime($product['created_at'])) ?>
                    <?php if ($product['updated_at']): ?>
                        | Last Updated: <?= date('M d, Y H:i', strtotime($product['updated_at'])) ?>
                    <?php endif; ?>
                </small>

                <hr>
                <div class="d-flex gap-2">
                    <a href="/products/edit/<?= $product['id'] ?>" class="btn btn-warning">
                        <i class="fas fa-edit me-1"></i> Edit
                    </a>
                    <button onclick="removeProduct(<?= $product['id'] ?>)" class="btn btn-danger">
                        <i class="fas fa-trash me-1"></i> Remove
                    </button>
                    <a href="/products" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Back to Inventory
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->include('partials/footer') ?>
