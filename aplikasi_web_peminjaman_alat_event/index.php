<?php
/**
 * Landing Page - Halaman Utama Aplikasi
 * Menampilkan informasi dan daftar alat
 */

// Load configurations
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/config/session.php';
require_once __DIR__ . '/config/constants.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo APP_NAME; ?> - Solusi Rental Alat Event Terpercaya</title>

    <!-- CSS Libraries -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo CSS_URL; ?>/style.css">
    <link rel="stylesheet" href="<?php echo CSS_URL; ?>/responsive.css">

    <style>
        /* Hero Section with Background Image */
        .hero {
            background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)),
                        url('<?php echo IMAGES_URL; ?>/backgrounds/hero-bg.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            min-height: 100vh;
            display: flex;
            align-items: center;
            color: white;
        }

        /* Video Background Option */
        .video-background {
            position: fixed;
            right: 0;
            bottom: 0;
            min-width: 100%;
            min-height: 100%;
            z-index: -1;
        }

        .card-hover {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        }

        /* Floating animation for CTA button */
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }

        .btn-cta {
            animation: float 2s ease-in-out infinite;
        }
    </style>
</head>
<body>

<!-- Background Music (Optional - Autoplay muted by default) -->
<audio id="bgMusic" loop preload="auto">
    <source src="<?php echo ASSETS_URL; ?>/music/background-music.mp3" type="audio/mpeg">
</audio>

<!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="#">
            <i class="fas fa-tools me-2"></i>
            <strong><?php echo APP_NAME; ?></strong>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#home">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#alat">Daftar Alat</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#about">Tentang</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#contact">Kontak</a>
                </li>
                <?php if (isLoggedIn()): ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user-circle"></i> <?php echo htmlspecialchars(getSession('user_name')); ?>
                        </a>
                        <ul class="dropdown-menu">
                            <?php
                            $role = getSession('user_role');
                            if ($role == 'admin'): ?>
                                <li><a class="dropdown-item" href="pages/admin/dashboard.php">
                                    <i class="fas fa-tachometer-alt"></i> Dashboard Admin
                                </a></li>
                            <?php elseif ($role == 'petugas'): ?>
                                <li><a class="dropdown-item" href="pages/petugas/dashboard.php">
                                    <i class="fas fa-tachometer-alt"></i> Dashboard Petugas
                                </a></li>
                            <?php else: ?>
                                <li><a class="dropdown-item" href="pages/users/dashboard.php">
                                    <i class="fas fa-tachometer-alt"></i> Dashboard User
                                </a></li>
                            <?php endif; ?>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="pages/auth/logout.php">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a></li>
                        </ul>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-light ms-2" href="pages/auth/login.php">
                            <i class="fas fa-sign-in-alt"></i> Login
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-primary ms-2" href="pages/auth/register.php">
                            <i class="fas fa-user-plus"></i> Register
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<!-- Hero Section -->
<section id="home" class="hero">
    <div class="container text-center" data-aos="fade-up">
        <h1 class="display-3 fw-bold mb-4">Sewa Alat Event Mudah & Cepat</h1>
        <p class="lead mb-5">Tersedia berbagai macam alat untuk kebutuhan event Anda.<br>
        Mulai dari sound system, lighting, hingga perlengkapan multimedia.</p>
        <div class="d-flex justify-content-center gap-3">
            <a href="#alat" class="btn btn-primary btn-lg px-5 btn-cta">
                <i class="fas fa-search me-2"></i>Lihat Alat
            </a>
            <?php if (!isLoggedIn()): ?>
                <a href="pages/auth/register.php" class="btn btn-outline-light btn-lg px-5">
                    <i class="fas fa-user-plus me-2"></i>Daftar Sekarang
                </a>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Daftar Alat Section -->
<section id="alat" class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="display-4">Daftar Alat Tersedia</h2>
            <p class="lead">Pilih alat yang sesuai dengan kebutuhan event Anda</p>
        </div>

        <div class="row g-4">
            <?php
            // Fetch equipment data
            $db = getDbConnection();
            $sql = "SELECT a.*, k.nama_kategori
                    FROM alat a
                    JOIN kategori k ON a.kategori_id = k.id
                    WHERE a.stok_tersedia > 0
                    ORDER BY a.created_at DESC
                    LIMIT 6";
            $result = $db->query($sql);

            if ($result && $result->num_rows > 0):
                while ($alat = $result->fetch_assoc()):
            ?>
                <div class="col-md-4 col-lg-3" data-aos="zoom-in" data-aos-delay="100">
                    <div class="card card-hover h-100">
                        <?php if ($alat['foto']): ?>
                            <img src="<?php echo UPLOADS_URL . '/alat/' . $alat['foto']; ?>"
                                 class="card-img-top" alt="<?php echo $alat['nama_alat']; ?>"
                                 style="height: 200px; object-fit: cover;">
                        <?php else: ?>
                            <div class="card-img-top bg-secondary d-flex align-items-center justify-content-center"
                                 style="height: 200px;">
                                <i class="fas fa-tools fa-4x text-white"></i>
                            </div>
                        <?php endif; ?>
                        <div class="card-body">
                            <span class="badge bg-primary mb-2"><?php echo $alat['nama_kategori']; ?></span>
                            <h5 class="card-title"><?php echo htmlspecialchars($alat['nama_alat']); ?></h5>
                            <p class="card-text text-muted small">
                                <?php echo substr(htmlspecialchars($alat['deskripsi']), 0, 100); ?>...
                            </p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="h5 text-primary">
                                    Rp <?php echo number_format($alat['harga_sewa_per_hari'], 0, ',', '.'); ?>
                                    <small class="text-muted">/hari</small>
                                </span>
                                <span class="badge bg-success">
                                    <i class="fas fa-boxes"></i> Stok: <?php echo $alat['stok_tersedia']; ?>
                                </span>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent">
                            <?php if (isLoggedIn() && getSession('user_role') == 'user'): ?>
                                <a href="pages/users/peminjaman_form.php?alat_id=<?php echo $alat['id']; ?>"
                                   class="btn btn-primary w-100">
                                    <i class="fas fa-shopping-cart"></i> Sewa Sekarang
                                </a>
                            <?php elseif (!isLoggedIn()): ?>
                                <a href="pages/auth/login.php" class="btn btn-outline-primary w-100">
                                    <i class="fas fa-sign-in-alt"></i> Login untuk Sewa
                                </a>
                            <?php else: ?>
                                <button class="btn btn-secondary w-100" disabled>
                                    <i class="fas fa-lock"></i> Tidak Dapat Menyewa
                                </button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php
                endwhile;
            else:
            ?>
                <div class="col-12 text-center">
                    <p class="lead">Belum ada alat tersedia saat ini.</p>
                </div>
            <?php endif; ?>
        </div>

        <div class="text-center mt-5">
            <a href="pages/users/alat.php" class="btn btn-outline-primary btn-lg">
                Lihat Semua Alat <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</section>

<!-- About Section with Video -->
<section id="about" class="py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6" data-aos="fade-right">
                <h2 class="display-4 mb-4">Tentang Kami</h2>
                <p class="lead">Penyedia layanan rental alat event terpercaya sejak 2020.</p>
                <p>Kami menyediakan berbagai macam peralatan untuk kebutuhan event Anda, mulai dari
                   acara kecil seperti ulang tahun hingga event besar seperti konser dan pernikahan.</p>
                <ul class="list-unstyled">
                    <li><i class="fas fa-check-circle text-primary me-2"></i> Alat berkualitas dan terawat</li>
                    <li><i class="fas fa-check-circle text-primary me-2"></i> Harga kompetitif dan transparan</li>
                    <li><i class="fas fa-check-circle text-primary me-2"></i> Pengiriman tepat waktu</li>
                    <li><i class="fas fa-check-circle text-primary me-2"></i> Dukungan teknis 24/7</li>
                </ul>
            </div>
            <div class="col-md-6" data-aos="fade-left">
                <div class="ratio ratio-16x9">
                    <video controls poster="<?php echo IMAGES_URL; ?>/video-thumb.jpg">
                        <source src="<?php echo ASSETS_URL; ?>/videos/tutorial-rental.mp4" type="video/mp4">
                        Browser Anda tidak mendukung video tag.
                    </video>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section id="contact" class="py-5 bg-dark text-white">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-4" data-aos="fade-up">
                <h4><i class="fas fa-map-marker-alt me-2"></i> Alamat</h4>
                <p>Jl. Merdeka No. 123<br>Jakarta, Indonesia</p>
            </div>
            <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="100">
                <h4><i class="fas fa-phone me-2"></i> Kontak</h4>
                <p>Phone: (021) 123-4567<br>Email: info@rentalsystem.com</p>
            </div>
            <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="200">
                <h4><i class="fas fa-clock me-2"></i> Jam Operasional</h4>
                <p>Senin - Sabtu: 08:00 - 20:00<br>Minggu: 10:00 - 17:00</p>
            </div>
        </div>
        <hr class="mt-4">
        <div class="text-center">
            <p>&copy; 2025 <?php echo APP_NAME; ?>. All rights reserved.</p>
        </div>
    </div>
</section>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script src="<?php echo JS_URL; ?>/main.js"></script>

<script>
    // Initialize AOS animation
    AOS.init({
        duration: 1000,
        once: true
    });

    // Background music control (optional - user can enable)
    const bgMusic = document.getElementById('bgMusic');
    let musicPlaying = false;

    // Add music control button (floating)
    const musicBtn = document.createElement('button');
    musicBtn.innerHTML = '<i class="fas fa-music"></i>';
    musicBtn.className = 'btn-music-control';
    musicBtn.style.cssText = `
        position: fixed;
        bottom: 20px;
        right: 20px;
        z-index: 1000;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: #0d6efd;
        color: white;
        border: none;
        cursor: pointer;
        box-shadow: 0 2px 10px rgba(0,0,0,0.2);
    `;
    document.body.appendChild(musicBtn);

    musicBtn.addEventListener('click', () => {
        if (musicPlaying) {
            bgMusic.pause();
            musicBtn.innerHTML = '<i class="fas fa-music-slash"></i>';
        } else {
            bgMusic.play();
            musicBtn.innerHTML = '<i class="fas fa-music"></i>';
        }
        musicPlaying = !musicPlaying;
    });

    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({ behavior: 'smooth' });
            }
        });
    });
</script>

</body>
</html>
