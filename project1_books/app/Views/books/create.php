<?= $this->include('templates/header') ?>

<div class="page-header">
    <div class="container">
        <h2><i class="fas fa-plus-circle me-2"></i>Add New Book</h2>
        <p class="text-muted mb-0">Fill in the details below to add a book</p>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-book me-2"></i>Book Information
            </div>
            <div class="card-body">
                <?php if (session()->getFlashdata('errors')): ?>
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            <?php foreach (session()->getFlashdata('errors') as $error): ?>
                                <li><?= $error ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form action="/books/store" method="POST">
                    <?= csrf_field() ?>
                    
                    <div class="row">
                        <div class="col-md-8 mb-3">
                            <label for="title" class="form-label">Book Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="title" name="title" 
                                   value="<?= old('title') ?>" placeholder="Enter book title" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="isbn" class="form-label">ISBN <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="isbn" name="isbn" 
                                   value="<?= old('isbn') ?>" placeholder="978-0-00-000000-0" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="author" class="form-label">Author <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="author" name="author" 
                                   value="<?= old('author') ?>" placeholder="Author name" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="published_year" class="form-label">Year <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="published_year" name="published_year" 
                                   value="<?= old('published_year') ?>" placeholder="2024" min="1800" max="2030" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="price" class="form-label">Price ($) <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" class="form-control" id="price" name="price" 
                                   value="<?= old('price') ?>" placeholder="29.99" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="genre" class="form-label">Genre <span class="text-danger">*</span></label>
                        <select class="form-select" id="genre" name="genre" required>
                            <option value="">-- Select Genre --</option>
                            <option value="Fiction" <?= old('genre') == 'Fiction' ? 'selected' : '' ?>>Fiction</option>
                            <option value="Non-Fiction" <?= old('genre') == 'Non-Fiction' ? 'selected' : '' ?>>Non-Fiction</option>
                            <option value="Science Fiction" <?= old('genre') == 'Science Fiction' ? 'selected' : '' ?>>Science Fiction</option>
                            <option value="Mystery" <?= old('genre') == 'Mystery' ? 'selected' : '' ?>>Mystery</option>
                            <option value="Romance" <?= old('genre') == 'Romance' ? 'selected' : '' ?>>Romance</option>
                            <option value="Biography" <?= old('genre') == 'Biography' ? 'selected' : '' ?>>Biography</option>
                            <option value="History" <?= old('genre') == 'History' ? 'selected' : '' ?>>History</option>
                            <option value="Self-Help" <?= old('genre') == 'Self-Help' ? 'selected' : '' ?>>Self-Help</option>
                            <option value="Technology" <?= old('genre') == 'Technology' ? 'selected' : '' ?>>Technology</option>
                            <option value="Other" <?= old('genre') == 'Other' ? 'selected' : '' ?>>Other</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="4" 
                                  placeholder="Brief description of the book..."><?= old('description') ?></textarea>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> Save Book
                        </button>
                        <a href="/books" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-1"></i> Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->include('templates/footer') ?>
