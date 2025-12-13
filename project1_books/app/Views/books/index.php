<?= $this->include('templates/header') ?>

<div class="page-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h2><i class="fas fa-books me-2"></i>Book Collection</h2>
                <p class="text-muted mb-0">Manage your library books here</p>
            </div>
            <div class="col-md-6 text-md-end">
                <a href="/books/create" class="btn btn-primary">
                    <i class="fas fa-plus me-1"></i> Add New Book
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Search Bar -->
<div class="card mb-4">
    <div class="card-body">
        <div class="row">
            <div class="col-md-8">
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                    <input type="text" class="form-control" id="searchInput" placeholder="Search books by title, author, or genre..." onkeyup="searchTable()">
                </div>
            </div>
            <div class="col-md-4">
                <select class="form-select" id="genreFilter" onchange="filterByGenre()">
                    <option value="">All Genres</option>
                    <option value="Classic">Classic</option>
                    <option value="Fiction">Fiction</option>
                    <option value="Dystopian">Dystopian</option>
                    <option value="Romance">Romance</option>
                    <option value="Mystery">Mystery</option>
                    <option value="Sci-Fi">Sci-Fi</option>
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
        <i class="fas fa-exclamation-circle me-2"></i><?= session()->getFlashdata('error') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<div class="card">
    <div class="card-header">
        <i class="fas fa-table me-2"></i>Books List
        <span class="badge bg-light text-dark float-end"><?= count($books) ?> books</span>
    </div>
    <div class="card-body p-0">
        <?php if (empty($books)): ?>
            <div class="empty-state">
                <i class="fas fa-book-open"></i>
                <h4>No Books Found</h4>
                <p>Start by adding your first book to the library</p>
                <a href="/books/create" class="btn btn-primary">
                    <i class="fas fa-plus me-1"></i> Add First Book
                </a>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>ISBN</th>
                            <th>Year</th>
                            <th>Genre</th>
                            <th>Price</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($books as $index => $book): ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><strong><?= esc($book['title']) ?></strong></td>
                                <td><?= esc($book['author']) ?></td>
                                <td><code><?= esc($book['isbn']) ?></code></td>
                                <td><?= esc($book['published_year']) ?></td>
                                <td><span class="badge-genre"><?= esc($book['genre']) ?></span></td>
                                <td>$<?= number_format($book['price'], 2) ?></td>
                                <td class="action-btns">
                                    <a href="/books/show/<?= $book['id'] ?>" class="btn btn-info btn-sm" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="/books/edit/<?= $book['id'] ?>" class="btn btn-warning btn-sm" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button onclick="confirmDelete(<?= $book['id'] ?>)" class="btn btn-danger btn-sm" title="Delete">
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

<?= $this->include('templates/footer') ?>
