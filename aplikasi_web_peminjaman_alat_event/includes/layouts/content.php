<?php
// ===========================
// Folder halaman admin
// ===========================
$pagesDir = realpath(__DIR__ . '/../pages/admin') . '/';

if ($pagesDir === false || !is_dir($pagesDir)) {
    die('<div class="alert alert-danger text-center m-5">
            <h4>Fatal Error</h4>
            <p>Folder halaman admin tidak ditemukan: <code>' . htmlspecialchars(__DIR__ . '/../pages/admin') . '</code></p>
          </div>');
}

// ===========================
// Sanitasi variabel $page
// ===========================
$page = isset($page) ? strtolower(preg_replace('/[^a-z0-9_-]/', '', $page)) : 'dashboard';

// ===========================
// Tentukan file target
// ===========================
$filePath = $pagesDir . $page . '.php';

// ===========================
// Fungsi logging internal
// ===========================
function logPageNotFound($filePath) {
    $ip = $_SERVER['REMOTE_ADDR'] ?? 'UNKNOWN';
    $url = $_SERVER['REQUEST_URI'] ?? 'UNKNOWN';
    error_log("[DECAFE] Halaman tidak ditemukan: {$filePath} | IP: {$ip} | URL: {$url}");
}

// ===========================
// Jika file tidak ditemukan
// ===========================
if (!file_exists($filePath)) {
    logPageNotFound($filePath);

    echo '
    <div class="container py-5 text-center">
        <div class="alert alert-danger shadow-sm rounded-4 p-4 mx-auto" style="max-width: 600px;">
            <h4 class="alert-heading mb-3">
                <i class="bi bi-exclamation-triangle-fill me-2"></i> Halaman Tidak Ditemukan
            </h4>
            <p class="mb-2">
                Maaf, halaman <strong>' . htmlspecialchars($page) . '</strong> tidak tersedia pada sistem.
            </p>
            <p class="text-muted small mb-4">
                <i class="bi bi-folder2-open me-1"></i> 
                Path yang dicari: <code>' . htmlspecialchars($filePath) . '</code>
            </p>
            <a href="' . htmlspecialchars(url('dashboard'), ENT_QUOTES, 'UTF-8') . '" class="btn btn-primary btn-sm">
                <i class="bi bi-house-door me-1"></i> Kembali ke Dashboard
            </a>
        </div>
    </div>';
    return; // hentikan proses include
}

// ===========================
// Sertakan halaman target
// ===========================
include $filePath;
