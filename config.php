<?php
// File: config.php
// Konfigurasi global aplikasi

session_start();

// Konfigurasi waktu
date_default_timezone_set('Asia/Jakarta');

// Konfigurasi error reporting (matikan di production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Konfigurasi base URL (ubah sesuai domain)
define('BASE_URL', 'http://localhost/rental-alat/');
define('BASE_PATH', dirname(__FILE__) . '/');

// Konfigurasi upload
define('UPLOAD_PATH', BASE_PATH . 'assets/uploads/');
define('MAX_FILE_SIZE', 5 * 1024 * 1024); // 5MB
define('ALLOWED_EXTENSIONS', ['jpg', 'jpeg', 'png', 'gif', 'pdf']);

// Konfigurasi pagination
define('ITEMS_PER_PAGE', 10);

// Konfigurasi denda (% dari harga sewa per hari)
define('DENDA_PERSEN', 10); // 10%

// Konfigurasi session timeout (30 menit)
define('SESSION_TIMEOUT', 1800);

// Cek session timeout
function checkSessionTimeout() {
    if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > SESSION_TIMEOUT)) {
        session_unset();
        session_destroy();
        header('Location: ' . BASE_URL . 'pages/auth/login.php?error=session_expired');
        exit();
    }
    $_SESSION['last_activity'] = time();
}

// Include database connection
require_once BASE_PATH . 'config/database.php';
require_once BASE_PATH . 'includes/functions.php';
require_once BASE_PATH . 'includes/log_activity.php';
?>
