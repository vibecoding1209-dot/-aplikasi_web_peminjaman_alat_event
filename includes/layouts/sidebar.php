<?php
// ============================
?>

<!-- Sidebar Desktop -->
<div class="sidebar d-none d-lg-block">
  <ul class="sidebar-menu">
    <li><a href="<?= htmlspecialchars(url('dashboard'), ENT_QUOTES, 'UTF-8'); ?>" class="<?= isActive($currentPage, 'dashboard') ?>"><i class="bi bi-speedometer2"></i> Dashboard</a></li>
    <li><a href="<?= htmlspecialchars(url('kategori'), ENT_QUOTES, 'UTF-8'); ?>" class="<?= isActive($currentPage, 'kategori') ?>"><i class="bi bi-cart"></i> kategori</a></li>
    <li><a href="<?= htmlspecialchars(url('customer'), ENT_QUOTES, 'UTF-8'); ?>" class="<?= isActive($currentPage, 'customer') ?>"><i class="bi bi-people"></i> Customers</a></li>
    <li><a href="<?= htmlspecialchars(url('product'), ENT_QUOTES, 'UTF-8'); ?>" class="<?= isActive($currentPage, 'product') ?>"><i class="bi bi-box"></i> Products</a></li>
    <li><a href="<?= htmlspecialchars(url('order'), ENT_QUOTES, 'UTF-8'); ?>" class="<?= isActive($currentPage, 'order') ?>"><i class="bi bi-file-earmark-text"></i> order</a></li>
    <li><a href="<?= htmlspecialchars(url('report'), ENT_QUOTES, 'UTF-8'); ?>" class="<?= isActive($currentPage, 'report') ?>"><i class="bi bi-file-earmark-text"></i> Reports</a></li>
    <li class="nav-item"><a class="nav-link <?= isActive($currentPage, 'dapur') ?>" href="<?= htmlspecialchars(url('dapur'), ENT_QUOTES, 'UTF-8'); ?>"><i class="bi bi-file-earmark-text"></i>dapur</a></li>  
  </ul>
</div>

<!-- Sidebar Mobile (Offcanvas) -->
<div class="offcanvas offcanvas-start d-lg-none" data-bs-scroll="true" data-bs-backdrop="true" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasNavbarLabel"><i class="bi bi-cup-hot me-2"></i> DeCafe</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <ul class="navbar-nav flex-column gap-2">
      <li class="nav-item"><a class="nav-link <?= isActive($currentPage, 'dashboard') ?>" href="<?= htmlspecialchars(url('dashboard'), ENT_QUOTES, 'UTF-8'); ?>"><i class="bi bi-speedometer2"></i> Dashboard</a></li>
      <li class="nav-item"><a class="nav-link <?= isActive($currentPage, 'kategori') ?>" href="<?= htmlspecialchars(url('kategori'), ENT_QUOTES, 'UTF-8'); ?>"><i class="bi bi-cart"></i>kategori</a></li>
      <li class="nav-item"><a class="nav-link <?= isActive($currentPage, 'customer') ?>" href="<?= htmlspecialchars(url('customer'), ENT_QUOTES, 'UTF-8'); ?>"><i class="bi bi-people"></i> Customers</a></li>
      <li class="nav-item"><a class="nav-link <?= isActive($currentPage, 'product') ?>" href="<?= htmlspecialchars(url('product'), ENT_QUOTES, 'UTF-8'); ?>"><i class="bi bi-box"></i> Products</a></li>
      <li class="nav-item"><a class="nav-link <?= isActive($currentPage, 'report') ?>" href="<?= htmlspecialchars(url('report'), ENT_QUOTES, 'UTF-8'); ?>"><i class="bi bi-file-earmark-text"></i> Reports</a></li>
      <li class="nav-item"><a class="nav-link <?= isActive($currentPage, 'order') ?>" href="<?= htmlspecialchars(url('order'), ENT_QUOTES, 'UTF-8'); ?>"><i class="bi bi-file-earmark-text"></i> order</a></li>
      <li class="nav-item"><a class="nav-link <?= isActive($currentPage, 'dapur') ?>" href="<?= htmlspecialchars(url('dapur'), ENT_QUOTES, 'UTF-8'); ?>"><i class="bi bi-file-earmark-text"></i>dapur</a></li>  
    </ul>
  </div>
</div>
