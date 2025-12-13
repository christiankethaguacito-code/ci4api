<?= $this->include('layouts/header') ?>

<div class="page-title">
    <div class="container">
        <h2><i class="fas fa-user-plus me-2"></i>Add New Employee</h2>
        <p class="text-muted mb-0">Enter the employee details below</p>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-lg-9">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-user-edit me-2"></i>Employee Information
            </div>
            <div class="card-body">
                <?php if (session()->getFlashdata('errors')): ?>
                    <div class="alert alert-danger">
                        <strong>Please fix the following:</strong>
                        <ul class="mb-0 mt-2">
                            <?php foreach (session()->getFlashdata('errors') as $err): ?>
                                <li><?= $err ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form action="/employees/store" method="post">
                    <?= csrf_field() ?>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">First Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="first_name" 
                                   value="<?= old('first_name') ?>" placeholder="John" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Last Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="last_name" 
                                   value="<?= old('last_name') ?>" placeholder="Doe" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Email Address <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" name="email" 
                                   value="<?= old('email') ?>" placeholder="john.doe@company.com" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Phone Number <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="phone" 
                                   value="<?= old('phone') ?>" placeholder="(555) 123-4567" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Department <span class="text-danger">*</span></label>
                            <select class="form-select" name="department" required>
                                <option value="">-- Choose Department --</option>
                                <option value="IT" <?= old('department') == 'IT' ? 'selected' : '' ?>>IT</option>
                                <option value="HR" <?= old('department') == 'HR' ? 'selected' : '' ?>>Human Resources</option>
                                <option value="Finance" <?= old('department') == 'Finance' ? 'selected' : '' ?>>Finance</option>
                                <option value="Marketing" <?= old('department') == 'Marketing' ? 'selected' : '' ?>>Marketing</option>
                                <option value="Sales" <?= old('department') == 'Sales' ? 'selected' : '' ?>>Sales</option>
                                <option value="Operations" <?= old('department') == 'Operations' ? 'selected' : '' ?>>Operations</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Position <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="position" 
                                   value="<?= old('position') ?>" placeholder="Software Developer" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Salary ($) <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" class="form-control" name="salary" 
                                   value="<?= old('salary') ?>" placeholder="50000.00" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Hire Date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" name="hire_date" 
                                   value="<?= old('hire_date') ?>" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-select" name="status">
                                <option value="active" <?= old('status') == 'active' ? 'selected' : '' ?>>Active</option>
                                <option value="inactive" <?= old('status') == 'inactive' ? 'selected' : '' ?>>Inactive</option>
                                <option value="on_leave" <?= old('status') == 'on_leave' ? 'selected' : '' ?>>On Leave</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Address</label>
                        <textarea class="form-control" name="address" rows="3" 
                                  placeholder="Full address..."><?= old('address') ?></textarea>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> Save Employee
                        </button>
                        <a href="/employees" class="btn btn-secondary">
                            <i class="fas fa-times me-1"></i> Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->include('layouts/footer') ?>
