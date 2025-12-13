<?= $this->include('partials/header') ?>

<div class="page-title-section">
    <div class="container">
        <h2><i class="fas fa-plus-circle me-2"></i>Add New Product</h2>
        <p class="text-muted mb-0">Enter product details to add to inventory</p>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-box me-2"></i>Product Information
            </div>
            <div class="card-body">
                <?php if (session()->getFlashdata('errors')): ?>
                    <div class="alert alert-danger">
                        <strong><i class="fas fa-exclamation-circle me-1"></i>Please correct:</strong>
                        <ul class="mb-0 mt-2">
                            <?php foreach (session()->getFlashdata('errors') as $e): ?>
                                <li><?= $e ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form action="/products/save" method="post">
                    <?= csrf_field() ?>
                    
                    <div class="row">
                        <div class="col-md-8 mb-3">
                            <label class="form-label">Product Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" 
                                   value="<?= old('name') ?>" placeholder="Enter product name" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">SKU Code <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="sku" 
                                   value="<?= old('sku') ?>" placeholder="PRD-001" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Category <span class="text-danger">*</span></label>
                            <select class="form-select" name="category" required>
                                <option value="">-- Select --</option>
                                <option value="Electronics" <?= old('category') == 'Electronics' ? 'selected' : '' ?>>Electronics</option>
                                <option value="Clothing" <?= old('category') == 'Clothing' ? 'selected' : '' ?>>Clothing</option>
                                <option value="Food" <?= old('category') == 'Food' ? 'selected' : '' ?>>Food & Beverage</option>
                                <option value="Furniture" <?= old('category') == 'Furniture' ? 'selected' : '' ?>>Furniture</option>
                                <option value="Sports" <?= old('category') == 'Sports' ? 'selected' : '' ?>>Sports</option>
                                <option value="Tools" <?= old('category') == 'Tools' ? 'selected' : '' ?>>Tools</option>
                                <option value="Other" <?= old('category') == 'Other' ? 'selected' : '' ?>>Other</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Selling Price ($) <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" class="form-control" name="price" 
                                   value="<?= old('price') ?>" placeholder="99.99" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Cost Price ($)</label>
                            <input type="number" step="0.01" class="form-control" name="cost_price" 
                                   value="<?= old('cost_price') ?>" placeholder="50.00">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Quantity <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="quantity" 
                                   value="<?= old('quantity') ?>" placeholder="100" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Min Stock Level</label>
                            <input type="number" class="form-control" name="min_stock" 
                                   value="<?= old('min_stock', 10) ?>" placeholder="10">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Supplier <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="supplier" 
                                   value="<?= old('supplier') ?>" placeholder="Supplier name" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-select" name="status">
                                <option value="in_stock" <?= old('status') == 'in_stock' ? 'selected' : '' ?>>In Stock</option>
                                <option value="low_stock" <?= old('status') == 'low_stock' ? 'selected' : '' ?>>Low Stock</option>
                                <option value="out_of_stock" <?= old('status') == 'out_of_stock' ? 'selected' : '' ?>>Out of Stock</option>
                            </select>
                        </div>
                        <div class="col-md-8 mb-3">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" name="description" rows="3" 
                                      placeholder="Product description..."><?= old('description') ?></textarea>
                        </div>
                    </div>

                    <hr>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> Add Product
                        </button>
                        <a href="/products" class="btn btn-secondary">
                            <i class="fas fa-times me-1"></i> Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->include('partials/footer') ?>
