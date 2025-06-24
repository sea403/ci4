<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

  <title><?= isset($title) ? $title : 'Admin' ?></title>
  <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no" />
  <meta name="title" content="Volt - Free Bootstrap 5 Dashboard" />

  <meta property="og:type" content="website" />
  <meta property="og:title" content="Volt - Free Bootstrap 5 Dashboard" />

  <link rel="apple-touch-icon" sizes="120x120" href="../../assets/img/favicon/apple-touch-icon.png" />
  <link rel="icon" type="image/png" sizes="32x32" href="../../assets/img/favicon/favicon-32x32.png" />
  <link rel="icon" type="image/png" sizes="16x16" href="../../assets/img/favicon/favicon-16x16.png" />
  <link rel="manifest" href="../../assets/img/favicon/site.webmanifest" />
  <link rel="mask-icon" href="../../assets/img/favicon/safari-pinned-tab.svg" color="#ffffff" />
  <meta name="msapplication-TileColor" content="#ffffff" />
  <meta name="theme-color" content="#ffffff" />
  <link type="text/css" href="../../vendor/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet" />
  <link type="text/css" href="../../vendor/notyf/notyf.min.css" rel="stylesheet" />

  <link type="text/css" href="<?= base_url('css/volt.css') ?>" rel="stylesheet" />
</head>

<body>

  <?= view('admin/partials/sidebar') ?>

  <main class="content">

    <?= view('admin/partials/header') ?>

    <div class="py-4">
      <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <?= session()->getFlashdata('success') ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      <?php endif; ?>

      <?php if (session()->getFlashdata('errors')): ?>
        <div class="alert alert-danger">
          <ul>
            <?php foreach (session()->getFlashdata('errors') as $error): ?>
              <li><?= esc($error) ?></li>
            <?php endforeach ?>
          </ul>
        </div>
      <?php endif; ?>


      <?= $this->renderSection('content') ?>
    </div>

    <script src="<?= base_url('js/popper.min.js') ?>"></script>

    <script src="<?= base_url('js/bootstrap.min.js') ?>"></script>

    <script async defer="defer" src="https://buttons.github.io/buttons.js"></script>

    <script src="<?= base_url('js/smooth-scroll.polyfills.min.js') ?>"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="<?= base_url('js/volt.js') ?>"></script>
</body>

</html>