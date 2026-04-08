<?php
// ============================
// Helper functions
// ============================

// Ambil path URL saat ini (tanpa slash awal & akhir)
$currentPage = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

// ============================
// Cek apakah menu aktif
// ============================
if (!function_exists('isActive')) {
    /**
     * Menandai menu aktif.
     * @param string $currentPath Path saat ini dari URL
     * @param string $menuPath Path menu yang dibandingkan
     * @param string $class CSS class untuk aktif (default 'active')
     * @return string
     */
    function isActive(string $currentPath, string $menuPath, string $class = 'active'): string {
        $currentPath = trim($currentPath, '/'); // hapus slash awal/akhir
        $menuPath = trim($menuPath, '/');       // hapus slash awal/akhir
        // Jika path sama atau currentPath dimulai dari menuPath
        return ($currentPath === $menuPath || str_starts_with($currentPath, $menuPath . '/')) ? $class : '';
    }
}

// ============================
// URL helper global
// ============================
if (!function_exists('url')) {
    function url(string $path = ''): string {
        $path = ltrim($path, '/');
        return rtrim(BASE_URL ?? '', '/') . ($path ? '/' . $path : '');
    }
}

// ============================
// HTML Escape helper
// ============================
if (!function_exists('e')) {
    function e($string): string {
        return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
    }
}
