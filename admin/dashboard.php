<?php
session_start();
include '../config/koneksi.php';

if(!isset($_SESSION['login'])){
    header("Location: login.php");
    exit();
}

/* =========================
TOTAL BERITA
========================= */
$berita = mysqli_query($conn, "SELECT * FROM berita");
$totalBerita = mysqli_num_rows($berita);

/* =========================
TOTAL PESAN
========================= */
$totalPesan = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM pesan_kesan"));

/* =========================
TOTAL KEGIATAN
========================= */
$kegiatan = mysqli_query($conn, "SELECT * FROM kegiatan");
$totalKegiatan = mysqli_num_rows($kegiatan);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin GENBI</title>

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <!-- GOOGLE FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            /* Light Mode Variables */
            --bg-body: #f4f7fe;
            --bg-card: #ffffff;
            --bg-sidebar: linear-gradient(180deg, #001F54 0%, #003b8e 100%);
            --text-main: #001F54;
            --text-muted: #64748b;
            --border-color: rgba(0, 0, 0, 0.05);
            --shadow-sm: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            --shadow-md: 0 10px 30px rgba(0, 0, 0, 0.06);
            --shadow-lg: 0 20px 40px rgba(0, 74, 173, 0.1);
            --primary: #004AAD;
        }

        body.dark-mode {
            /* Dark Mode Variables */
            --bg-body: #0f172a;
            --bg-card: #1e293b;
            --bg-sidebar: linear-gradient(180deg, #020617 0%, #0f172a 100%);
            --text-main: #f8fafc;
            --text-muted: #94a3b8;
            --border-color: rgba(255, 255, 255, 0.05);
            --shadow-md: 0 10px 30px rgba(0, 0, 0, 0.3);
            --shadow-lg: 0 20px 40px rgba(0, 0, 0, 0.4);
            --primary: #60a5fa;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: var(--bg-body);
            color: var(--text-main);
            overflow-x: hidden;
            transition: background 0.4s ease, color 0.4s ease;
        }

        /* =========================
           ANIMATIONS
        ========================= */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .animate-fade-up {
            animation: fadeInUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
            opacity: 0;
        }
        
        .delay-1 { animation-delay: 0.1s; }
        .delay-2 { animation-delay: 0.2s; }
        .delay-3 { animation-delay: 0.3s; }
        .delay-4 { animation-delay: 0.4s; }

        /* =========================
           SIDEBAR
        ========================= */
        .sidebar {
            width: 270px;
            background: var(--bg-sidebar);
            position: fixed;
            top: 0; left: 0; bottom: 0;
            padding: 35px 20px;
            color: white;
            overflow-y: auto;
            z-index: 1000;
            transition: all 0.3s ease;
            box-shadow: 4px 0 24px rgba(0,0,0,0.1);
        }

        .sidebar-logo {
            text-align: center;
            margin-bottom: 40px;
        }

        .sidebar-logo img {
            width: 85px; height: 85px;
            object-fit: cover;
            border-radius: 50%;
            border: 3px solid rgba(255,255,255,0.8);
            margin-bottom: 15px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.2);
            transition: transform 0.3s;
        }
        
        .sidebar-logo img:hover { transform: scale(1.05); }

        .sidebar-logo h2 {
            font-size: 24px;
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            gap: 15px;
            text-decoration: none;
            color: rgba(255,255,255,0.7);
            padding: 14px 20px;
            border-radius: 16px;
            margin-bottom: 10px;
            transition: all 0.3s ease;
            font-size: 15px;
            font-weight: 500;
        }

        .sidebar-menu a:hover, .sidebar-menu a.active {
            background: rgba(255, 255, 255, 0.15);
            color: white;
            transform: translateX(5px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .sidebar-menu i {
            width: 25px;
            font-size: 18px;
            text-align: center;
        }

        /* =========================
           MAIN CONTENT
        ========================= */
        .main-content {
            margin-left: 270px;
            padding: 35px 40px;
            min-height: 100vh;
            transition: all 0.3s ease;
        }

        /* =========================
           TOPBAR
        ========================= */
        .topbar {
            background: var(--bg-card);
            padding: 18px 30px;
            border-radius: 20px;
            margin-bottom: 35px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border-color);
            transition: all 0.4s ease;
        }

        .topbar h3 {
            margin: 0;
            font-size: 24px;
            font-weight: 700;
            color: var(--text-main);
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 15px;
            /* Dihapus flex-wrap agar elemen tetap sebaris di PC/Laptop */
        }

        /* Realtime Clock */
        .realtime-clock {
            display: flex;
            align-items: center;
            gap: 8px;
            background: rgba(0, 74, 173, 0.05);
            padding: 8px 16px;
            border-radius: 50px;
            font-size: 14px;
            font-weight: 600;
            color: var(--text-main);
            border: 1px solid var(--border-color);
            white-space: nowrap; /* Mencegah teks jam terpotong ke bawah */
        }

        body.dark-mode .realtime-clock {
            background: rgba(255, 255, 255, 0.05);
        }

        .realtime-clock i {
            color: var(--primary);
            font-size: 16px;
        }
        
        .clock-divider {
            margin: 0 4px;
            color: var(--text-muted);
            opacity: 0.5;
        }

        /* Toggle Button */
        .dark-toggle {
            border: none;
            width: 45px; height: 45px;
            border-radius: 50%;
            background: #f1f5f9;
            color: #334155;
            cursor: pointer;
            font-size: 18px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0; /* Menjaga ukuran ikon tidak menyusut */
        }

        body.dark-mode .dark-toggle {
            background: #334155;
            color: #f8fafc;
        }

        .dark-toggle:hover { transform: rotate(15deg) scale(1.1); }

        /* Admin Profile */
        .admin-profile {
            display: flex;
            align-items: center;
            gap: 12px;
            background: rgba(0, 74, 173, 0.05);
            padding: 8px 16px 8px 8px;
            border-radius: 50px;
            border: 1px solid var(--border-color);
            white-space: nowrap; /* Menjaga teks profil tidak terpotong */
        }

        body.dark-mode .admin-profile { background: rgba(255, 255, 255, 0.05); }

        .admin-profile img {
            width: 38px; height: 38px;
            border-radius: 50%;
            object-fit: cover;
        }

        .admin-profile span {
            font-weight: 600;
            font-size: 14px;
            color: var(--text-main);
        }

        /* =========================
           DASHBOARD CARDS
        ========================= */
        .dashboard-card {
            background: var(--bg-card);
            border-radius: 24px;
            padding: 30px 25px;
            text-align: center;
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border-color);
            transition: all 0.4s ease;
            height: 100%;
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .dashboard-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-lg);
        }

        .dashboard-card h4 {
            font-size: 40px;
            font-weight: 700;
            color: var(--text-main);
            margin: 15px 0 5px;
        }

        .dashboard-card p {
            margin: 0;
            color: var(--text-muted);
            font-weight: 500;
            font-size: 15px;
        }

        .card-icon {
            width: 70px; height: 70px;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: auto;
            font-size: 30px;
            color: white;
            box-shadow: 0 10px 20px rgba(0,0,0,0.15);
            transform: rotate(-5deg);
            transition: transform 0.3s;
        }
        
        .dashboard-card:hover .card-icon { transform: rotate(0deg) scale(1.1); }

        .icon-berita { background: linear-gradient(135deg, #3b82f6, #2563eb); }
        .icon-kegiatan { background: linear-gradient(135deg, #10b981, #059669); }
        .icon-pesan { background: linear-gradient(135deg, #f59e0b, #d97706); }

        /* =========================
           WELCOME BOX
        ========================= */
        .welcome-box {
            margin-top: 20px;
            background: linear-gradient(135deg, #001F54 0%, #004AAD 100%);
            border-radius: 30px;
            padding: 50px 60px;
            color: white;
            position: relative;
            box-shadow: var(--shadow-lg);
            overflow: hidden;
        }

        body.dark-mode .welcome-box {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            border: 1px solid rgba(255,255,255,0.1);
        }

        /* Dekorasi Lingkaran */
        .welcome-box::before, .welcome-box::after {
            content: "";
            position: absolute;
            background: rgba(255,255,255,0.05);
            border-radius: 50%;
        }
        .welcome-box::before {
            width: 300px; height: 300px;
            right: -50px; top: -100px;
            backdrop-filter: blur(10px);
        }
        .welcome-box::after {
            width: 150px; height: 150px;
            right: 150px; bottom: -50px;
        }

        .welcome-box-content {
            position: relative;
            z-index: 2;
            max-width: 60%;
        }

        .welcome-box h2 {
            font-size: 38px;
            font-weight: 700;
            margin-bottom: 15px;
            line-height: 1.2;
        }

        .welcome-box p {
            line-height: 1.8;
            color: rgba(255,255,255,0.85);
            font-size: 16px;
            margin-bottom: 25px;
        }

        .btn-custom {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: white;
            color: #001F54;
            text-decoration: none;
            padding: 14px 28px;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 8px 15px rgba(0,0,0,0.1);
        }

        body.dark-mode .btn-custom {
            background: #3b82f6;
            color: white;
        }

        .btn-custom:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 20px rgba(0,0,0,0.15);
            color: #001F54;
        }
        body.dark-mode .btn-custom:hover { color: white; background: #2563eb; }

        /* =========================
           RESPONSIVE
        ========================= */
        @media(max-width: 1200px) {
            .topbar { flex-direction: column; align-items: flex-start; gap: 15px; }
            .topbar-right { width: 100%; justify-content: flex-start; }
        }

        @media(max-width: 992px) {
            .welcome-box-content { max-width: 100%; text-align: center; }
            .welcome-box { padding: 40px 30px; }
        }

        @media(max-width: 768px){
            .sidebar { width: 80px; padding: 25px 10px; }
            .sidebar-logo h2 { display: none; }
            .sidebar-logo img { width: 50px; height: 50px; }
            .sidebar-menu a { justify-content: center; padding: 15px; border-radius: 12px; }
            .sidebar-menu a span { display: none; }
            .sidebar-menu i { font-size: 20px; }
            
            .main-content { margin-left: 80px; padding: 20px; }
            .topbar { flex-direction: column; gap: 15px; text-align: center; border-radius: 16px; align-items: center; }
            .topbar h3 { font-size: 20px; margin-bottom: 5px; }
            
            /* Pada HP, susun ke bawah dengan rapi */
            .topbar-right { width: 100%; flex-direction: column; align-items: center; gap: 10px; }
            .realtime-clock { width: 100%; justify-content: center; }
            .admin-profile { width: 100%; justify-content: center; }
            .welcome-box h2 { font-size: 28px; }
        }
    </style>
</head>

<body>

<!-- =========================
SIDEBAR
========================= -->
<div class="sidebar">
    <div class="sidebar-logo">
        <img src="../assets/image/logo.jpg" alt="Logo GenBI">
        <h2>GENBI Admin</h2>
    </div>
    <div class="sidebar-menu">
        <a href="dashboard.php" class="active">
            <i class="fa-solid fa-house"></i>
            <span>Dashboard</span>
        </a>
        <a href="berita/index.php">
            <i class="fa-solid fa-newspaper"></i>
            <span>Kelola Berita</span>
        </a>
        <a href="kegiatan/index.php">
            <i class="fa-solid fa-calendar-days"></i>
            <span>Kelola Kegiatan</span>
        </a>
        <a href="absensi/index.php">
            <i class="fa-solid fa-clipboard-check"></i>
            <span>Kelola Absensi</span>
        </a>
        <a href="pesan/index.php">
            <i class="fa-solid fa-envelope"></i>
            <span>Pesan Masuk</span>
        </a>
        <a href="logout.php">
            <i class="fa-solid fa-right-from-bracket"></i>
            <span>Logout</span>
        </a>
    </div>
</div>

<!-- =========================
MAIN CONTENT
========================= -->
<div class="main-content">

    <!-- TOPBAR -->
    <div class="topbar animate-fade-up">
        <h3>Dashboard Admin GENBI UIN SSC</h3>
        <div class="topbar-right">
            
            <!-- JAM & TANGGAL REALTIME -->
            <div class="realtime-clock" id="liveClock">
                <!-- JS Inject -->
            </div>

            <!-- Tombol Dark Mode -->
            <button id="darkToggle" class="dark-toggle">
                <i class="fa-solid fa-moon" id="themeIcon"></i>
            </button>
            
            <!-- Profil Admin -->
            <div class="admin-profile">
                <img src="../assets/image/logo.jpg" alt="Admin Profile">
                <span>Welcome Admin 👋</span>
            </div>
        </div>
    </div>

    <!-- CARDS -->
    <div class="row">
        <!-- BERITA -->
        <div class="col-lg-4 col-md-6 mb-4 animate-fade-up delay-1">
            <div class="dashboard-card">
                <div class="card-icon icon-berita">
                    <i class="fa-solid fa-newspaper"></i>
                </div>
                <h4><?php echo $totalBerita; ?></h4>
                <p>Total Berita</p>
            </div>
        </div>

        <!-- KEGIATAN -->
        <div class="col-lg-4 col-md-6 mb-4 animate-fade-up delay-2">
            <div class="dashboard-card">
                <div class="card-icon icon-kegiatan">
                    <i class="fa-solid fa-calendar-days"></i>
                </div>
                <h4><?php echo $totalKegiatan; ?></h4>
                <p>Total Kegiatan</p>
            </div>
        </div>

        <!-- PESAN MASUK -->
        <div class="col-lg-4 col-md-6 mb-4 animate-fade-up delay-3">
            <div class="dashboard-card">
                <div class="card-icon icon-pesan">
                    <i class="fa-solid fa-envelope"></i>
                </div>
                <h4><?php echo $totalPesan; ?></h4>
                <p>Pesan Masuk</p>
            </div>
        </div>
    </div>

    <!-- WELCOME BOX -->
    <div class="welcome-box animate-fade-up delay-4">
        <div class="welcome-box-content">
            <h2>Selamat Datang di Dashboard GENBI</h2>
            <p>Kelola berita, kegiatan, absensi, dan seluruh informasi organisasi GENBI UIN SSC dengan mudah, cepat, dan terpusat melalui dashboard admin interaktif ini.</p>
            <a href="../index.php" class="btn-custom" target="_blank">
                <i class="fa-solid fa-globe"></i> Lihat Website
            </a>
        </div>
    </div>

</div>

<!-- SCRIPT JS GABUNGAN -->
<script>
    /* ==================================
       1. LOGIKA TANGGAL & JAM REALTIME 
       ================================== */
    function updateClock() {
        const now = new Date();
        const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        const months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];

        const dayName = days[now.getDay()];
        const date = now.getDate();
        const monthName = months[now.getMonth()];
        const year = now.getFullYear();

        // Format angka di bawah 10 agar ada angka 0 di depan (contoh: 09:05:01)
        const h = String(now.getHours()).padStart(2, '0');
        const m = String(now.getMinutes()).padStart(2, '0');
        const s = String(now.getSeconds()).padStart(2, '0');

        const dateString = `${dayName}, ${date} ${monthName} ${year}`;
        const timeString = `${h}:${m}:${s}`;

        document.getElementById('liveClock').innerHTML = `
            <i class="fa-regular fa-clock"></i>
            <span>${dateString}</span>
            <span class="clock-divider">|</span>
            <span>${timeString}</span>
        `;
    }
    
    // Jalankan fungsi updateClock setiap 1 detik (1000 milidetik)
    setInterval(updateClock, 1000);
    updateClock(); // Panggil segera saat load agar tidak ada jeda kosong


    /* ==================================
       2. LOGIKA DARK MODE TOGGLE 
       ================================== */
    const toggleBtn = document.getElementById('darkToggle');
    const themeIcon = document.getElementById('themeIcon');
    const body = document.body;

    function updateIcon() {
        if(body.classList.contains('dark-mode')) {
            themeIcon.classList.remove('fa-moon');
            themeIcon.classList.add('fa-sun');
        } else {
            themeIcon.classList.remove('fa-sun');
            themeIcon.classList.add('fa-moon');
        }
    }

    if(localStorage.getItem('darkMode') === 'enabled'){
        body.classList.add('dark-mode');
        updateIcon();
    }

    toggleBtn.addEventListener('click', () => {
        body.classList.toggle('dark-mode');
        updateIcon();
        
        if(body.classList.contains('dark-mode')){
            localStorage.setItem('darkMode', 'enabled');
        } else {
            localStorage.setItem('darkMode', 'disabled');
        }
    });
</script>

<!-- Script bawaan Anda -->
<script src="../assets/js/darkmode.js"></script>

</body>
</html>