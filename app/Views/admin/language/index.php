<?= $this->extend('admin/layouts/main') ?>
<?= $this->section('content') ?>

<div class="align-items-center mb-3 d-flex justify-content-between">
    <h2><?= lang('Labels.languages') ?></h2>

    <div>
        <button class="btn copyKeywordsBtn btn-info">
            <i class="fa fa-clipboard"></i>
            <?= lang('Labels.copy_keywords') ?>
        </button>
        <button class="btn addBtn btn-primary"><i class="fa fa-plus"></i><?= lang('Labels.add_new') ?></button>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-centered table-nowrap mb-0 rounded">
        <thead class="thead-light">
            <tr>
                <th class="border-0 rounded-start">#</th>
                <th class="border-0"><?= lang('Labels.name') ?></th>
                <th class="border-0"><?= lang('Labels.code') ?></th>
                <th class="border-0"><?= lang('Labels.created_at') ?></th>
                <th class="border-0 text-end"><?= lang('Labels.action') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($languages)) : ?>
                <?php foreach ($languages as $index => $language) : ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= esc($language['name']) ?></td>
                        <td><?= esc($language['code']) ?></td>
                        <td><?= esc($language['created_at']) ?></td>
                        <td class="text-end">
                            <div>
                                <button class="btn btn-sm btn-info editBtn" data-id="<?= $language['id'] ?>" data-name="<?= $language['name'] ?>" data-code="<?= $language['code'] ?>">
                                    <i class="me-1 fa fa-pencil"></i>
                                    <?= lang('Labels.edit') ?>
                                </button>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="100%" class="text-center"><?= lang('Labels.no_languages_found') ?></td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<!-- language crud modal -->
<div class="modal fade" id="languageModal" tabindex="-1" aria-labelledby="languageModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="languageModalLabel"><?= lang('Labels.add_new_language') ?></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form enctype="multipart/form-data" method="POST" action="/admin/language/store">
                <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="name"><?= lang('Labels.name') ?></label>
                        <input type="text" class="form-control" name="name" value="<?= old('name') ?>">
                    </div>
                    <div class="form-group">
                        <label for="code"><?= lang('Labels.code') ?></label>
                        <input type="text" class="form-control" name="code" value="<?= old('code') ?>">
                    </div>
                    <div class="form-group">
                        <label for="image"><?= lang('Labels.image') ?></label>
                        <input type="file" class="form-control" name="image" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?= lang('Labels.close') ?></button>
                    <button type="submit" class="btn btn-primary"><?= lang('Labels.save') ?></button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- keywords showing modal -->
<div class="modal fade" id="keywordsModal" tabindex="-1" aria-labelledby="keywordsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="keywordsModalLabel"><?= lang('Labels.system_keywords') ?></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-6">
                        <textarea readonly class="form-control the-keywords"></textarea>
                    </div>
                    <div class="col-6">
                        <textarea class="form-control the-values" readonly></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?= lang('Labels.close') ?></button>
            </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    'use strict';
    (function($) {
        function humanizeString(input) {
            if (!input) return '';

            let result = input.replace(/_/g, ' ');

            result = result.replace(/([a-z])([A-Z])/g, '$1 $2');

            return result.charAt(0).toUpperCase() + result.slice(1);
        };
        
        $('.copyKeywordsBtn').on('click', function() {
            $.get('/admin/language/keywords', (data, status) => {
                const theKeywords = data?.keywords?.map(d => d.split('.')[1]).join('\n')
                $('#keywordsModal').find('.the-keywords').val(theKeywords);
                
                const theValues = data?.keywords?.map(d => humanizeString(d.split('.')[1])).join('\n')
                $('#keywordsModal').find('.the-values').val(theValues);

                $('#keywordsModal').modal('show');
            });
        });
        
        $('.addBtn').on('click', function() {
            $('.modal-title').text("<?= lang('Labels.add_new_language') ?>")
            var form = $('#languageModal').find('form')[0];
            if (form) {
                form.reset(); // native reset
                $(form).attr('action', '/admin/language/store');
            } else {
                console.warn('Form not found inside #languageModal');
            }
            $('#languageModal').modal('show');
        });

        $('.editBtn').on('click', function() {
            $('.modal-title').text("<?= lang('Labels.edit_language') ?>")
            $('#languageModal').find('[name="name"]').val($(this).attr('data-name'));
            $('#languageModal').find('[name="code"]').val($(this).attr('data-code'));
            $('#languageModal').find('form').attr('action', '/admin/language/' + $(this).data('id') + '/update');
            $('#languageModal').modal('show');
        });
    })(jQuery);
</script>
<?= $this->endSection() ?>

<?= $this->section('styles') ?>
    <style>
        .the-keywords,.the-values {
            min-height: 400px !important;
        }
    </style>
<?= $this->endSection() ?>