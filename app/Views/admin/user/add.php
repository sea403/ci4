<?= $this->extend('admin/layouts/main') ?>
<?= $this->section('content') ?>

<div class="align-items-center mb-3 d-flex justify-content-between">
    <h2><?= lang('Labels.add_new_user') ?></h2>
    <a href="/admin/user/index" class="btn btn-primary"><?= lang('Labels.user_list') ?></a>
</div>

<form method="POST" action="/admin/user/store">
    <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
    
    <div class="row gy-4">
        <div class="col-lg-4 form-group">
            <label for="firstname" class="form-label"><?= lang('Labels.first_name') ?></label>
            <input type="text" class="form-control" name="firstname" value="<?= old('firstname') ?>" />
        </div>

        <div class="col-lg-4 form-group">
            <label for="lastname" class="form-label"><?= lang('Labels.last_name') ?></label>
            <input type="text" class="form-control" name="lastname" value="<?= old('lastname') ?>" />
        </div>

        <div class="col-lg-4 form-group">
            <label for="email" class="form-label"><?= lang('Labels.email_address') ?></label>
            <input type="email" class="form-control" name="email" value="<?= old('email') ?>" />
        </div>

        <div class="col-lg-4 form-group">
            <label for="password" class="form-label"><?= lang('Labels.password') ?></label>
            <input type="password" class="form-control" name="password" />
        </div>

        <div class="col-lg-4 form-group">
            <label for="password_confirm" class="form-label"><?= lang('Labels.password_confirm') ?></label>
            <input type="password" class="form-control" name="password_confirm" />
        </div>
    </div>

    <div class="text-end">
        <button class="btn mt-4 btn-primary"><?= lang('Labels.submit') ?></button>
    </div>
</form>

<?= $this->endSection(); ?>
