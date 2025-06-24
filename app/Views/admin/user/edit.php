<?= $this->extend('admin/layouts/main') ?>
<?= $this->section('content') ?>

<div class="align-items-center mb-3 d-flex justify-content-between">
    <h2>Edit User</h2>
    <a href="/admin/user/index" class="btn btn-primary">Users List</a>
</div>

<form method="POST" action="/admin/user/<?= $user['id'] ?>/update">
    <div class="row gy-4">
        <div class="col-lg-4 form-group">
            <label for="firstname" class="form-label">First Name</label>
            <input type="text" class="form-control" name="firstname" value="<?= old('firstname', $user['firstname']) ?>" />
        </div>

        <div class="col-lg-4 form-group">
            <label for="lastname" class="form-label">Last Name</label>
            <input type="text" class="form-control" name="lastname" value="<?= old('lastname', $user['lastname']) ?>" />
        </div>

        <div class="col-lg-4 form-group">
            <label for="email" class="form-label">Email Address</label>
            <input type="email" class="form-control" name="email" value="<?= old('email', $user['email']) ?>" />
        </div>

        <div class="col-lg-4 form-group">
            <label for="password" class="form-label">Password (leave blank to keep unchanged)</label>
            <input type="password" class="form-control" name="password" />
        </div>

        <div class="col-lg-4 form-group">
            <label for="password_confirm" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" name="password_confirm" />
        </div>
    </div>

    <div class="text-end">
        <button class="btn mt-4 btn-primary">Update</button>
    </div>
</form>

<?= $this->endSection(); ?>
