<?= $this->include('layouts/header') ?>

<div class="page-title">
    <div class="container">
        <h2><i class="fas fa-user-edit me-2"></i>Edit Employee</h2>
        <p class="text-muted mb-0">Update employee information</p>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-lg-9">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-edit me-2"></i>Editing: <?= esc($employee['first_name']) ?> <?= esc($employee['last_name']) ?>
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

                <form action="/employees/update/<?= $employee['id'] ?>" method="post">
                    <?= csrf_field() ?>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">First Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="first_name" 
                                   value="<?= old('first_name', $employee['first_name']) ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Last Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="last_name" 
                                   value="<?= old('last_name', $employee['last_name']) ?>" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" name="email" 
                                   value="<?= old('email', $employee['email']) ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Phone <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="phone" 
                                   value="<?= old('phone', $employee['phone']) ?>" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Department <span class="text-danger">*</span></label>
                            <select class="form-select" name="department" required>
                                <option value="">-- Choose --</option>
                                <?php 
                                $depts = ['IT', 'HR', 'Finance', 'Marketing', 'Sales', 'Operations'];
                                foreach ($depts as $dept): 
                                ?>
                                    <option value="<?= $dept ?>" <?= old('department', $employee['department']) == $dept ? 'selected' : '' ?>><?= $dept ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Position <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="position" 
                                   value="<?= old('position', $employee['position']) ?>" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Salary ($) <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" class="form-control" name="salary" 
                                   value="<?= old('salary', $employee['salary']) ?>" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Hire Date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" name="hire_date" 
                                   value="<?= old('hire_date', $employee['hire_date']) ?>" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-select" name="status">
                                <option value="active" <?= old('status', $employee['status']) == 'active' ? 'selected' : '' ?>>Active</option>
                                <option value="inactive" <?= old('status', $employee['status']) == 'inactive' ? 'selected' : '' ?>>Inactive</option>
                                <option value="on_leave" <?= old('status', $employee['status']) == 'on_leave' ? 'selected' : '' ?>>On Leave</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Address</label>
                        <textarea class="form-control" name="address" rows="3"><?= old('address', $employee['address']) ?></textarea>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> Update
                        </button>
                        <a href="/employees" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-1"></i> Back
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->include('layouts/footer') ?>
