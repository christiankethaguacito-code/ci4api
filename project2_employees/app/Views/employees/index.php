<?= $this->include('layouts/header') ?>

<div class="page-title">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h2 class="mb-1"><i class="fas fa-id-card me-2"></i>Employee Directory</h2>
                <p class="text-muted mb-0">View and manage all employee records</p>
            </div>
            <div class="col-md-4 text-md-end mt-3 mt-md-0">
                <a href="/employees/create" class="btn btn-primary">
                    <i class="fas fa-user-plus me-1"></i> New Employee
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
                    <input type="text" class="form-control" id="searchInput" placeholder="Search employees by name, email, or department..." onkeyup="searchTable()">
                </div>
            </div>
            <div class="col-md-4">
                <select class="form-select" id="deptFilter" onchange="filterByDept()">
                    <option value="">All Departments</option>
                    <option value="Engineering">Engineering</option>
                    <option value="Marketing">Marketing</option>
                    <option value="Human Resources">Human Resources</option>
                    <option value="Finance">Finance</option>
                    <option value="Sales">Sales</option>
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
        <i class="fas fa-times-circle me-2"></i><?= session()->getFlashdata('error') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="fas fa-table me-2"></i>All Employees</span>
        <span class="badge bg-light text-dark"><?= count($employees) ?> records</span>
    </div>
    <div class="card-body p-0">
        <?php if (empty($employees)): ?>
            <div class="empty-box">
                <i class="fas fa-user-slash"></i>
                <h5>No Employees Found</h5>
                <p class="text-muted">Add your first employee to get started</p>
                <a href="/employees/create" class="btn btn-primary">
                    <i class="fas fa-plus me-1"></i> Add Employee
                </a>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Department</th>
                            <th>Position</th>
                            <th>Salary</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($employees as $i => $emp): ?>
                            <tr>
                                <td><?= $i + 1 ?></td>
                                <td>
                                    <strong><?= esc($emp['first_name']) ?> <?= esc($emp['last_name']) ?></strong>
                                </td>
                                <td><?= esc($emp['email']) ?></td>
                                <td><span class="badge-dept"><?= esc($emp['department']) ?></span></td>
                                <td><?= esc($emp['position']) ?></td>
                                <td>$<?= number_format($emp['salary'], 2) ?></td>
                                <td>
                                    <span class="badge-status badge-<?= $emp['status'] ?>">
                                        <?= ucfirst(str_replace('_', ' ', $emp['status'])) ?>
                                    </span>
                                </td>
                                <td>
                                    <a href="/employees/view/<?= $emp['id'] ?>" class="btn btn-info btn-sm action-btn" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="/employees/edit/<?= $emp['id'] ?>" class="btn btn-warning btn-sm action-btn" title="Edit">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                    <button onclick="deleteEmployee(<?= $emp['id'] ?>)" class="btn btn-danger btn-sm action-btn" title="Delete">
                                        <i class="fas fa-trash-alt"></i>
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

<?= $this->include('layouts/footer') ?>
