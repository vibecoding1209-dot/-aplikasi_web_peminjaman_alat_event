<!doctype html>
<html lang="en" data-bs-theme="auto">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title><?= htmlspecialchars($pageTitle ?? 'DEcafe Admin Panel', ENT_QUOTES, 'UTF-8') ?></title>
  <meta name="description" content="<?= htmlspecialchars($metaDescription ?? 'DEcafe Admin Panel - Manage orders, products, customers, and reports efficiently.', ENT_QUOTES, 'UTF-8') ?>">
  <meta name="author" content="DEcafe Developer Team">
  <meta name="theme-color" content="#712cf9">
  <meta name="robots" content="index, follow">

  <!-- Favicons -->
  <link rel="icon" type="image/png" sizes="32x32" href="<?= url('assets/img/favicon-32x32.png') ?>">
  <link rel="icon" type="image/png" sizes="16x16" href="<?= url('assets/img/favicon-16x16.png') ?>">
  <link rel="apple-touch-icon" href="<?= url('assets/img/apple-touch-icon.png') ?>">
  <link rel="manifest" href="<?= url('assets/site.webmanifest') ?>">

  <!-- Bootstrap Core -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-..." crossorigin="anonymous">

  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

  <!-- Custom CSS -->
  <link rel="stylesheet" href="<?= url('assets/css/style.css?v=1.0.0') ?>">

  <!-- JS Libraries -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" crossorigin="anonymous" defer></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous" defer></script>
  <script src="<?= url('assets/js/app.js?v=1.0.0') ?>" defer></script>

  <!-- Theme Toggle SVG Icons -->
  <?php include_once BASE_PATH . '/layouts/icons.php'; ?>
</head>
