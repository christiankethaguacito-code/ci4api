<?= $this->include('partials/header') ?>

<div class="page-title-section">
    <div class="container">
        <h2><i class="fas fa-edit me-2"></i>Edit Product</h2>
        <p class="text-muted mb-0">Update product information</p>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-box me-2"></i>Editing: <?= esc($product['name']) ?>
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

                <form action="/products/update/<?= $product['id'] ?>" method="post">
                    <?= csrf_field() ?>
                    
                    <div class="row">
                        <div class="col-md-8 mb-3">
                            <label class="form-label">Product Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" 
                                   value="<?= old('name', $product['name']) ?>" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">SKU <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="sku" 
                                   value="<?= old('sku', $product['sku']) ?>" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Category <span class="text-danger">*</span></label>
                            <select class="form-select" name="category" required>
                                <?php 
                                $cats = ['Electronics', 'Clothing', 'Food', 'Furniture', 'Sports', 'Tools', 'Other'];
                                foreach ($cats as $cat): 
                                ?>
                                    <option value="<?= $cat ?>" <?= old('category', $product['category']) == $cat ? 'selected' : '' ?>><?= $cat ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Selling Price ($) <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" class="form-control" name="price" 
                                   value="<?= old('price', $product['price']) ?>" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Cost Price ($)</label>
                            <input type="number" step="0.01" class="form-control" name="cost_price" 
                                   value="<?= old('cost_price', $product['cost_price']) ?>">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Quantity <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="quantity" 
                                   value="<?= old('quantity', $product['quantity']) ?>" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Min Stock</label>
                            <input type="number" class="form-control" name="min_stock" 
                                   value="<?= old('min_stock', $product['min_stock']) ?>">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Supplier <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="supplier" 
                                   value="<?= old('supplier', $product['supplier']) ?>" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-select" name="status">
                                <option value="in_stock" <?= old('status', $product['status']) == 'in_stock' ? 'selected' : '' ?>>In Stock</option>
                                <option value="low_stock" <?= old('status', $product['status']) == 'low_stock' ? 'selected' : '' ?>>Low Stock</option>
                                <option value="out_of_stock" <?= old('status', $product['status']) == 'out_of_stock' ? 'selected' : '' ?>>Out of Stock</option>
                            </select>
                        </div>
                        <div class="col-md-8 mb-3">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" name="description" rows="3"><?= old('description', $product['description']) ?></textarea>
                        </div>
                    </div>

                    <hr>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> Update Product
                        </button>
                        <a href="/products" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-1"></i> Back
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->include('partials/footer') ?>
