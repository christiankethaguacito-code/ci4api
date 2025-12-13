<?= $this->include('templates/header') ?>

<div class="page-header">
    <div class="container">
        <h2><i class="fas fa-edit me-2"></i>Edit Book</h2>
        <p class="text-muted mb-0">Update the book information</p>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-book me-2"></i>Editing: <?= esc($book['title']) ?>
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

                <form action="/books/update/<?= $book['id'] ?>" method="POST">
                    <?= csrf_field() ?>
                    
                    <div class="row">
                        <div class="col-md-8 mb-3">
                            <label for="title" class="form-label">Book Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="title" name="title" 
                                   value="<?= old('title', $book['title']) ?>" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="isbn" class="form-label">ISBN <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="isbn" name="isbn" 
                                   value="<?= old('isbn', $book['isbn']) ?>" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="author" class="form-label">Author <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="author" name="author" 
                                   value="<?= old('author', $book['author']) ?>" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="published_year" class="form-label">Year <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="published_year" name="published_year" 
                                   value="<?= old('published_year', $book['published_year']) ?>" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="price" class="form-label">Price ($) <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" class="form-control" id="price" name="price" 
                                   value="<?= old('price', $book['price']) ?>" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="genre" class="form-label">Genre <span class="text-danger">*</span></label>
                        <select class="form-select" id="genre" name="genre" required>
                            <option value="">-- Select Genre --</option>
                            <?php 
                            $genres = ['Fiction', 'Non-Fiction', 'Science Fiction', 'Mystery', 'Romance', 'Biography', 'History', 'Self-Help', 'Technology', 'Other'];
                            foreach ($genres as $genre): 
                            ?>
                                <option value="<?= $genre ?>" <?= old('genre', $book['genre']) == $genre ? 'selected' : '' ?>><?= $genre ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="4"><?= old('description', $book['description']) ?></textarea>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> Update Book
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
