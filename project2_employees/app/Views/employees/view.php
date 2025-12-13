<?= $this->include('layouts/header') ?>

<div class="page-title">
    <div class="container">
        <h2><i class="fas fa-user me-2"></i>Employee Details</h2>
        <p class="text-muted mb-0">Complete employee profile</p>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-lg-9">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>
                    <i class="fas fa-id-badge me-2"></i>
                    <?= esc($employee['first_name']) ?> <?= esc($employee['last_name']) ?>
                </span>
                <span class="badge-status badge-<?= $employee['status'] ?>">
                    <?= ucfirst(str_replace('_', ' ', $employee['status'])) ?>
                </span>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="text-muted mb-3">Personal Information</h6>
                        <table class="table table-borderless">
                            <tr>
                                <th width="40%"><i class="fas fa-user me-2"></i>Full Name:</th>
                                <td><?= esc($employee['first_name']) ?> <?= esc($employee['last_name']) ?></td>
                            </tr>
                            <tr>
                                <th><i class="fas fa-envelope me-2"></i>Email:</th>
                                <td><a href="mailto:<?= esc($employee['email']) ?>"><?= esc($employee['email']) ?></a></td>
                            </tr>
                            <tr>
                                <th><i class="fas fa-phone me-2"></i>Phone:</th>
                                <td><?= esc($employee['phone']) ?></td>
                            </tr>
                            <tr>
                                <th><i class="fas fa-map-marker-alt me-2"></i>Address:</th>
                                <td><?= esc($employee['address']) ?: '<em class="text-muted">Not provided</em>' ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-muted mb-3">Employment Details</h6>
                        <table class="table table-borderless">
                            <tr>
                                <th width="40%"><i class="fas fa-building me-2"></i>Department:</th>
                                <td><span class="badge-dept"><?= esc($employee['department']) ?></span></td>
                            </tr>
                            <tr>
                                <th><i class="fas fa-briefcase me-2"></i>Position:</th>
                                <td><?= esc($employee['position']) ?></td>
                            </tr>
                            <tr>
                                <th><i class="fas fa-dollar-sign me-2"></i>Salary:</th>
                                <td><strong>$<?= number_format($employee['salary'], 2) ?></strong></td>
                            </tr>
                            <tr>
                                <th><i class="fas fa-calendar-check me-2"></i>Hire Date:</th>
                                <td><?= date('F d, Y', strtotime($employee['hire_date'])) ?></td>
                            </tr>
                        </table>
                    </div>
                </div>

                <hr>
                <div class="d-flex gap-2">
                    <a href="/employees/edit/<?= $employee['id'] ?>" class="btn btn-warning">
                        <i class="fas fa-edit me-1"></i> Edit
                    </a>
                    <button onclick="deleteEmployee(<?= $employee['id'] ?>)" class="btn btn-danger">
                        <i class="fas fa-trash me-1"></i> Delete
                    </button>
                    <a href="/employees" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Back to List
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->include('layouts/footer') ?>
