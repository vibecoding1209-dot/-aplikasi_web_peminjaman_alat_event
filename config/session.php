<?php
/**
 * Session Management Configuration
 *
 * Best Practices:
 * 1. Always start session before any output
 * 2. Regenerate session ID after login
 * 3. Set proper session timeout
 * 4. Use HTTPS in production
 */

// ============================================
// 1. SESSION CONFIGURATION
// ============================================

// Set session name (custom untuk keamanan)
session_name('RENTAL_SESSION');

// Set session cookie parameters
session_set_cookie_params([
    'lifetime' => 7200,        // 2 hours
    'path' => '/',
    'domain' => '',            // Current domain
    'secure' => false,         // Set true for HTTPS
    'httponly' => true,        // Prevent JavaScript access
    'samesite' => 'Strict'     // CSRF protection
]);

// Start session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// ============================================
// 2. SESSION HELPER FUNCTIONS
// ============================================

/**
 * Set session variable
 *
 * @param string $key Session key
 * @param mixed $value Value to store
 */
function setSession($key, $value) {
    $_SESSION[$key] = $value;
}

/**
 * Get session variable
 *
 * @param string $key Session key
 * @param mixed $default Default value if not exists
 * @return mixed
 */
function getSession($key, $default = null) {
    return isset($_SESSION[$key]) ? $_SESSION[$key] : $default;
}

/**
 * Check if session variable exists
 */
function hasSession($key) {
    return isset($_SESSION[$key]);
}

/**
 * Remove session variable
 */
function removeSession($key) {
    unset($_SESSION[$key]);
}

/**
 * Destroy entire session (logout)
 */
function destroySession() {
    // Unset all session variables
    $_SESSION = [];

    // Delete session cookie
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(
            session_name(),
            '',
            time() - 42000,
            $params["path"],
            $params["domain"],
            $params["secure"],
            $params["httponly"]
        );
    }

    // Destroy session
    session_destroy();
}

/**
 * Set flash message (temporary message for one request)
 *
 * @param string $type success|danger|warning|info
 * @param string $message Message content
 */
function setFlash($type, $message) {
    $_SESSION['flash'] = [
        'type' => $type,
        'message' => $message,
        'time' => time()
    ];
}

/**
 * Get flash message and clear it
 *
 * @return array|null Flash message or null
 */
function getFlash() {
    if (isset($_SESSION['flash'])) {
        $flash = $_SESSION['flash'];
        unset($_SESSION['flash']);
        return $flash;
    }
    return null;
}

/**
 * Check if user is logged in
 */
function isLoggedIn() {
    return hasSession('user_id') && hasSession('user_role');
}

/**
 * Check if user has specific role
 *
 * @param string|array $roles Single role or array of roles
 * @return bool
 */
function hasRole($roles) {
    if (!isLoggedIn()) return false;

    $userRole = getSession('user_role');

    if (is_array($roles)) {
        return in_array($userRole, $roles);
    }

    return $userRole === $roles;
}

/**
 * Require authentication - redirect if not logged in
 */
function requireAuth() {
    if (!isLoggedIn()) {
        setFlash('warning', 'Silakan login terlebih dahulu');
        header('Location: /aplikasi_web_peminjaman_alat_event/pages/auth/login.php');
        exit();
    }
}

/**
 * Require specific role - redirect if not authorized
 *
 * @param string|array $roles Required role(s)
 */
function requireRole($roles) {
    requireAuth();

    if (!hasRole($roles)) {
        setFlash('danger', 'Akses ditolak! Anda tidak memiliki izin untuk halaman ini.');

        // Redirect based on user role
        $role = getSession('user_role');
        switch($role) {
            case 'admin':
                header('Location: /aplikasi_web_peminjaman_alat_event/pages/admin/dashboard.php');
                break;
            case 'petugas':
                header('Location: /aplikasi_web_peminjaman_alat_event/pages/petugas/dashboard.php');
                break;
            default:
                header('Location: /aplikasi_web_peminjaman_alat_event/pages/users/dashboard.php');
        }
        exit();
    }
}

/**
 * Regenerate session ID (call after login)
 */
function regenerateSession() {
    session_regenerate_id(true);
}

/**
 * Get current user data
 */
function getCurrentUser() {
    if (!isLoggedIn()) return null;

    $userId = getSession('user_id');
    $sql = "SELECT id, name, email, role, phone, address FROM users WHERE id = ?";
    return getRecord($sql, 'i', [$userId]);
}
?>
