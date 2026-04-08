  <body>
  <!-- ===== Navbar Utama ===== -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm fixed-top">
    <div class="container-fluid">
      
      <!-- Logo -->
      <a class="navbar-brand d-flex align-items-center" href="/home">
        <i class="bi bi-cup-hot me-2"></i>
        <span class="fw-bold">DeCafe</span>
      </a>

      <!-- Hamburger Button untuk Mobile -->
      <button class="navbar-toggler d-lg-none p-2" type="button"
              data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
              aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Right Side Navbar -->
      <div class="d-flex align-items-center ms-auto gap-3">

    <!-- ===== Theme Toggle ===== -->
  <div class="dropdown bd-mode-toggle">
    <button class="btn btn-light btn-sm dropdown-toggle px-2 py-1 d-flex align-items-center justify-content-center"
            type="button" id="bd-theme" data-bs-toggle="dropdown" aria-expanded="false"
            style="font-size: 0.85rem;">
      <svg class="bi theme-icon-active" width="16" height="16" aria-hidden="true">
        <use href="#circle-half"></use>
      </svg>
      <span class="visually-hidden" id="bd-theme-text">Toggle theme</span>
    </button>

    <ul class="dropdown-menu dropdown-menu-end shadow-sm rounded-3 p-1"
        style="min-width: 130px; font-size: 0.85rem;"
        aria-labelledby="bd-theme-text">
      <li>
        <button type="button" class="dropdown-item d-flex align-items-center gap-2 py-1 px-2"
                data-bs-theme-value="light">
          <svg class="bi opacity-75" width="14" height="14"><use href="#sun-fill"></use></svg>
          Light
        </button>
      </li>
      <li>
        <button type="button" class="dropdown-item d-flex align-items-center gap-2 py-1 px-2"
                data-bs-theme-value="dark">
          <svg class="bi opacity-75" width="14" height="14"><use href="#moon-stars-fill"></use></svg>
          Dark
        </button>
      </li>
      <li>
        <button type="button" class="dropdown-item d-flex align-items-center gap-2 py-1 px-2 active"
                data-bs-theme-value="auto">
          <svg class="bi opacity-75" width="14" height="14"><use href="#circle-half"></use></svg>
          Auto
        </button>
      </li>
    </ul>
  </div>


        <!-- ===== User Dropdown ===== -->
        <div class="dropdown">
          <a class="nav-link dropdown-toggle d-flex align-items-center gap-2 px-2"
            href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-person-circle fs-5"></i>
            <span class="fw-medium"><?= htmlspecialchars($username) ?></span>
          </a>
          <ul class="dropdown-menu dropdown-menu-end shadow-sm p-2 rounded-3" style="min-width: 180px;">
            <li>
              <a class="dropdown-item small" href="/dashboard">
                <i class="bi bi-speedometer2 me-2"></i> Dashboard
              </a>
            </li>
            <li>
              <a class="dropdown-item small" href="/settings">
                <i class="bi bi-gear me-2"></i> Settings
              </a>
              </li>
              <a href=""
                class="nav-link"
                data-bs-toggle="modal"
                data-bs-target="#modalGantiPass"
                onclick="isiFormGantiPass(
                  <?= (int)($_SESSION['user']['id'] ?? 0) ?>,
                  '<?= htmlspecialchars($_SESSION['user']['username'] ?? '') ?>'
                )">
              <i class="bi bi-key"></i> Reset Password
            </a>
            <li>
              <a class="dropdown-item text-danger small" href="?page=logout">
                <i class="bi bi-box-arrow-right me-2"></i> Logout
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>

  <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title d-flex align-items-center gap-2" id="offcanvasNavbarLabel">
        <i class="bi bi-cup-hot"></i> DeCafe
      </h5>
      <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
      <ul class="navbar-nav flex-column gap-2">
        <li class="nav-item">
          <a class="nav-link <?= isActive($currentPage, 'dashboard') ?>" href="<?= htmlspecialchars(url('dashboard'), ENT_QUOTES, 'UTF-8'); ?>">
            <i class="bi bi-speedometer2"></i> Dashboard
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= isActive($currentPage, 'kategori') ?>" href="<?= htmlspecialchars(url('kategori'), ENT_QUOTES, 'UTF-8'); ?>">
            <i class="bi bi-cart"></i>kategori
          </a>
        </li>
         <li class="nav-item">
          <a class="nav-link <?= isActive($currentPage, 'order') ?>" href="<?= htmlspecialchars(url('order'), ENT_QUOTES, 'UTF-8'); ?>">
            <i class="bi bi-people"></i>order
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= isActive($currentPage, 'customer') ?>" href="<?= htmlspecialchars(url('customer'), ENT_QUOTES, 'UTF-8'); ?>">
            <i class="bi bi-people"></i> Customers
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= isActive($currentPage, 'product') ?>" href="<?= htmlspecialchars(url('product'), ENT_QUOTES, 'UTF-8'); ?>">
            <i class="bi bi-box"></i> Products
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= isActive($currentPage, 'report') ?>" href="<?= htmlspecialchars(url('report'), ENT_QUOTES, 'UTF-8'); ?>">
            <i class="bi bi-file-earmark-text"></i> Reports
          </a>
        </li>
          <li class="nav-item">
          <a class="nav-link <?= isActive($currentPage, 'kelola_pesanan') ?>" href="<?= htmlspecialchars(url('dapur'), ENT_QUOTES, 'UTF-8'); ?>">
            <i class="bi bi-file-earmark-text"></i> dapur
          </a>
        </li>
      </ul>
    </div>
  </div>

 <div class="modal fade" id="#modalGantiPass" tabindex="-1" aria-labelledby="modalGantiPassLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalGantiPassLabel">Ganti Password</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="formGantiPass">
            <input type="hidden" name="id" id="pass_id">
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" class="form-control" id="pass_username" readonly>
            </div>
            <div class="mb-3">
                <label class="form-label">Password Baru</label>
                <input type="password" class="form-control" name="new_password" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Konfirmasi Password</label>
                <input type="password" class="form-control" id="confirm_pass" required>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="btnSimpanPass">Simpan</button>
      </div>
    </div>
  </div>
</div>