<?= $this->extend('admin/layouts/main') ?>
<?= $this->section('content') ?>

<div class="align-items-center mb-3 d-flex justify-content-between">
    <h2><?= lang('Labels.users') ?></h2>
    <a href="/admin/user/add" class="btn btn-primary">
        <i class="fa fa-plus"></i>
        <?= lang('Labels.add_new') ?>
    </a>
</div>

<div class="table-responsive">
    <table class="table table-centered table-nowrap mb-0 rounded">
        <thead class="thead-light">
            <tr>
                <th class="border-0 rounded-start">#</th>
                <th class="border-0"><?= lang('Labels.name') ?></th>
                <th class="border-0"><?= lang('Labels.Email') ?></th>
                <th class="border-0"><?= lang('Labels.created_at') ?></th>
                <th class="border-0 text-end"><?= lang('Labels.Action') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($users)) : ?>
                <?php foreach ($users as $index => $user) : ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= esc($user['firstname'] . ' ' . $user['lastname']) ?></td>
                        <td><?= esc($user['email']) ?></td>
                        <td><?= esc($user['created_at']) ?></td>
                        <td class="text-end">
                            <div>
                                <a href="<?= '/admin/user/' . $user['id'] . '/edit' ?>" class="btn btn-sm btn-primary">
                                    <i class="fa fa-pen"></i>
                                    <?= lang('Labels.edit') ?>
                                </a>
                                <a href="<?= '/admin/user/' . $user['id'] . '/delete' ?>" class="btn btn-sm btn-danger">
                                    <i class="fa fa-trash"></i>
                                    <?= lang('Labels.delete') ?>
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="5" class="text-center"><?= lang('Labels.no_users_found') ?></td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?= $this->endSection() ?>
