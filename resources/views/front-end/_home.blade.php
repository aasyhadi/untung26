<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Jasa konsultasi konstruksi terbaik untuk proyek bangunan, renovasi rumah, gedung bertingkat, dan infrastruktur. Solusi profesional dalam perencanaan dan pengelolaan proyek konstruksi.">
    <meta name="keywords" content="jasa konstruksi, konsultasi konstruksi, perencanaan bangunan, renovasi rumah, proyek infrastruktur, manajemen konstruksi, ahli konstruksi">
    <meta name="author" content="Untung Yasril">
    <title>Jasa Konsultasi Konstruksi | Untung Yasril</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            scroll-behavior: smooth;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f8f8;
            padding-top: 100px; /* Sesuaikan untuk top-bar dan navbar */
        }

        /* Top Bar */
        .top-bar {
            background-color: #444;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0; /* Menghapus padding sisi agar width 80% berfungsi */
            font-size: 14px;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1100;
        }

        /* Kontainer agar teks hanya 80% dari lebar layar */
        .top-bar-container {
            width: 80%; /* Lebar teks hanya 80% dari layar */
            max-width: 1200px; /* Maksimum lebar agar tidak terlalu melebar di layar besar */
            margin: 0 auto; /* Tengah secara horizontal */
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        /* Navbar */
        .navbar {
            background-color: #222;
            color: white;
            position: fixed;
            top: 40px; /* Sesuaikan agar tidak menutupi top-bar */
            left: 0;
            width: 100%;
            z-index: 1000;
            display: flex;
            justify-content: center; /* Menengahkan kontainer navbar */
            padding: 20px 0; /* Menghapus padding samping agar lebar kontainer berfungsi */
        }

        /* Kontainer agar teks hanya 80% dari layar */
        .navbar-container {
            width: 80%; /* Lebar teks hanya 80% dari layar */
            max-width: 1200px; /* Maksimum lebar agar tidak terlalu melebar di layar besar */
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .logo {
            font-size: 18px;
            font-weight: bold;
        }
        .nav-links {
            display: flex;
            gap: 15px;
        }
        .nav-links a {
            text-decoration: none;
            color: white;
            font-weight: bold;
        }
        .menu-toggle {
            display: none;
            font-size: 24px;
            cursor: pointer;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .nav-links {
                display: none;
                flex-direction: column;
                background: #222;
                position: absolute;
                top: 60px;
                right: 0;
                width: 200px;
                padding: 10px;
            }
            .nav-links.active {
                display: flex;
            }
            .menu-toggle {
                display: block;
            }
        }

        /* Hero */
        .hero {
            background-color: #555;
            color: white;
            height: 300px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 24px;
            font-weight: bold;
            text-align: center;
        }

        /* Hero Text */
        .hero-text {
            width: 80%; /* Lebar teks hanya 80% dari layar */
            max-width: 1200px; /* Batas maksimal agar tidak terlalu lebar di layar besar */
        }

        /* Content */
        .content {
            width: 80%; /* Lebar konten 80% dari layar */
            margin: 0 auto; /* Memusatkan konten */
            padding: 40px 20px;
        }

        /* --- Footer --- */
        .footer {
            background-color: #ccc;
            padding: 10px 20px;
            text-align: center;
            position: relative; /* Tidak menutupi copyright */
            width: 100%;
        }

        .footer a {
            margin: 0 10px;
            text-decoration: none;
            color: black;
        }

        .copyright {
            text-align: center;
            font-size: 14px;
            color: #555;
            padding: 10px 0;
            width: 100%;
        }
    </style>
</head>
<body>
    <!-- Top Bar -->
    <div class="top-bar">
        <div class="top-bar-container">
            <div>Sosial Media: 🔵 🔴 ⚫</div>
            <div>Email: untunguy29@gmail.com</div>
        </div>
    </div>

    <!-- Navbar -->
    <div class="navbar">
        <div class="navbar-container">
            <div class="logo">untungyasril.com</div>
            <div class="menu-toggle" onclick="toggleMenu()">☰</div>
            <nav class="nav-links">
                <a href="#beranda">Beranda</a>
                <a href="#layanan">Layanan</a>
                <a href="#portofolio">Portofolio</a>
                <a href="#testimoni">Testimoni</a>
                <a href="#hubungi">Hubungi</a>
            </nav>
        </div>
    </div>

    <!-- Hero Section -->
    <div id="beranda" class="hero">
        <div class="hero-text">Jasa Konsultasi Konstruksi Profesional</div>
    </div>

    <!-- Content -->
    <div class="content">
        <section id="layanan">
            <h2>Layanan Kami</h2>
            <p>Kami menyediakan layanan konsultasi untuk perencanaan bangunan, manajemen proyek, serta renovasi rumah dan gedung.</p>
        </section>

        <section id="portofolio">
            <h2>Portofolio</h2>
            <p>Proyek yang telah kami tangani mencakup berbagai sektor, dari rumah tinggal hingga gedung bertingkat.</p>
        </section>

        <div id="testimoni" class="section">
            <h2>Testimoni</h2>
            <p>"Pelayanan konsultasi konstruksi dari Untung Yasril sangat profesional dan terpercaya!" - Klien A</p>
        </div>

        <section id="hubungi">
            <h2>Hubungi Kami</h2>
            <p>Silakan hubungi kami untuk konsultasi lebih lanjut terkait proyek konstruksi Anda.</p>
        </section>
    </div>

    <!-- Footer -->
    <div class="footer">
        <a href="#">Beranda</a>
        <a href="#">Syarat dan Ketentuan</a>
        <a href="#">Kebijakan Privasi</a>
    </div>

    <!-- Copyright -->
    <p class="copyright">&copy; untungyasril - 2025</p>

    <script>
        function toggleMenu() {
            const menu = document.querySelector('.nav-links');
            menu.classList.toggle('active');
        }
    </script>
</body>
</html>
