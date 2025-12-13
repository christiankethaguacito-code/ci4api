<?= $this->include('templates/header') ?>

<div class="page-header">
    <div class="container">
        <h2><i class="fas fa-book me-2"></i>Book Details</h2>
        <p class="text-muted mb-0">Viewing complete book information</p>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="fas fa-info-circle me-2"></i><?= esc($book['title']) ?></span>
                <span class="badge-genre"><?= esc($book['genre']) ?></span>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <th width="35%"><i class="fas fa-heading me-2"></i>Title:</th>
                                <td><?= esc($book['title']) ?></td>
                            </tr>
                            <tr>
                                <th><i class="fas fa-user me-2"></i>Author:</th>
                                <td><?= esc($book['author']) ?></td>
                            </tr>
                            <tr>
                                <th><i class="fas fa-barcode me-2"></i>ISBN:</th>
                                <td><code><?= esc($book['isbn']) ?></code></td>
                            </tr>
                            <tr>
                                <th><i class="fas fa-calendar me-2"></i>Published:</th>
                                <td><?= esc($book['published_year']) ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <th width="35%"><i class="fas fa-tag me-2"></i>Genre:</th>
                                <td><span class="badge-genre"><?= esc($book['genre']) ?></span></td>
                            </tr>
                            <tr>
                                <th><i class="fas fa-dollar-sign me-2"></i>Price:</th>
                                <td><strong>$<?= number_format($book['price'], 2) ?></strong></td>
                            </tr>
                            <tr>
                                <th><i class="fas fa-clock me-2"></i>Added:</th>
                                <td><?= date('M d, Y', strtotime($book['created_at'])) ?></td>
                            </tr>
                        </table>
                    </div>
                </div>

                <?php if (!empty($book['description'])): ?>
                    <hr>
                    <h6><i class="fas fa-align-left me-2"></i>Description</h6>
                    <p class="text-muted"><?= nl2br(esc($book['description'])) ?></p>
                <?php endif; ?>

                <hr>
                <div class="d-flex gap-2">
                    <a href="/books/edit/<?= $book['id'] ?>" class="btn btn-warning">
                        <i class="fas fa-edit me-1"></i> Edit
                    </a>
                    <button onclick="confirmDelete(<?= $book['id'] ?>)" class="btn btn-danger">
                        <i class="fas fa-trash me-1"></i> Delete
                    </button>
                    <a href="/books" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Back to List
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->include('templates/footer') ?>
