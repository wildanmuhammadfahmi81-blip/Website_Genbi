<?php
include 'config/koneksi.php';

// Proteksi SQL Injection & Cek apakah ID ada
if(isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $query = mysqli_query($conn, "SELECT * FROM kegiatan WHERE id='$id'");
    $data = mysqli_fetch_array($query);
    
    // Jika data tidak ditemukan, kembalikan ke halaman utama
    if(!$data) {
        header("Location: index.php");
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $data['judul']; ?> - GENBI UIN SSC</title>

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <!-- GOOGLE FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #004AAD;
            --secondary: #001F54;
            --bg-color: #f4f7fe;
            --text-dark: #1e293b;
            --text-muted: #64748b;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: var(--bg-color);
            color: var(--text-dark);
            position: relative;
            overflow-x: hidden;
        }

        /* =========================
           BACKGROUND DECORATION
        ========================= */
        .bg-shape-1 {
            position: absolute;
            top: -150px;
            right: -100px;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(0,74,173,0.1) 0%, rgba(255,255,255,0) 70%);
            border-radius: 50%;
            z-index: -1;
        }
        
        .bg-shape-2 {
            position: absolute;
            bottom: 100px;
            left: -150px;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(0,31,84,0.08) 0%, rgba(255,255,255,0) 70%);
            border-radius: 50%;
            z-index: -1;
        }

        /* =========================
           ANIMATION
        ========================= */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* =========================
           DETAIL SECTION
        ========================= */
        .detail-section {
            padding: 60px 0 100px;
            min-height: 100vh;
            display: flex;
            align-items: center;
        }

        .container-custom {
            max-width: 1000px;
            margin: auto;
        }

        .detail-card {
            background: #ffffff;
            border-radius: 30px;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.05);
            animation: fadeUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
            border: 1px solid rgba(0,0,0,0.03);
        }

        /* =========================
           IMAGE AREA
        ========================= */
        .detail-img-wrapper {
            position: relative;
            width: 100%;
            height: 500px;
            overflow: hidden;
        }

        .detail-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .detail-card:hover .detail-img {
            transform: scale(1.03);
        }

        /* Overlay Gradasi Tipis di Bawah Gambar */
        .detail-img-wrapper::after {
            content: '';
            position: absolute;
            bottom: 0; left: 0; right: 0;
            height: 150px;
            background: linear-gradient(to top, rgba(0,0,0,0.4), transparent);
        }

        /* =========================
           CONTENT AREA
        ========================= */
        .detail-content {
            padding: 50px;
            background: #ffffff;
            position: relative;
            border-radius: 30px 30px 0 0;
            margin-top: -30px; /* Overlap ke gambar */
            z-index: 2;
        }

        /* Badges Informasi */
        .meta-info {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 25px;
        }

        .meta-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(0, 74, 173, 0.08);
            color: var(--primary);
            padding: 10px 20px;
            border-radius: 50px;
            font-size: 14px;
            font-weight: 600;
        }

        .meta-badge i {
            font-size: 16px;
        }

        .detail-content h1 {
            font-size: 40px;
            font-weight: 700;
            color: var(--secondary);
            margin-bottom: 25px;
            line-height: 1.3;
            letter-spacing: -0.5px;
        }

        .detail-content p {
            font-size: 16px;
            line-height: 1.9;
            color: #475569;
            margin-bottom: 40px;
            text-align: justify;
        }

        /* =========================
           BUTTON
        ========================= */
        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            background: var(--secondary);
            color: white;
            padding: 15px 35px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            font-size: 15px;
            transition: all 0.3s ease;
            box-shadow: 0 10px 20px rgba(0, 31, 84, 0.15);
        }

        .btn-back:hover {
            background: var(--primary);
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 15px 25px rgba(0, 74, 173, 0.25);
        }

        /* =========================
           RESPONSIVE
        ========================= */
        @media(max-width: 768px){
            .detail-section { padding: 30px 15px; }
            .detail-img-wrapper { height: 300px; }
            .detail-content { padding: 35px 25px; }
            .detail-content h1 { font-size: 28px; }
            .meta-badge { padding: 8px 15px; font-size: 13px; }
            .btn-back { width: 100%; justify-content: center; }
        }
    </style>
</head>
<body>

<!-- Dekorasi Background Latar -->
<div class="bg-shape-1"></div>
<div class="bg-shape-2"></div>

<!-- SECTION DETAIL -->
<section class="detail-section">
    <div class="container container-custom">
        <div class="detail-card">
            
            <!-- GAMBAR KEGIATAN -->
            <div class="detail-img-wrapper">
                <!-- Pastikan path folder upload sesuai dengan struktur direktori Anda -->
                <img src="assets/upload/kegiatan/<?php echo $data['gambar']; ?>" class="detail-img" alt="<?php echo $data['judul']; ?>">
            </div>

            <!-- KONTEN -->
            <div class="detail-content">
                
                <!-- INFORMASI TANGGAL & LOKASI -->
                <div class="meta-info">
                    <div class="meta-badge">
                        <i class="fa-regular fa-calendar-days"></i>
                        <!-- Mengubah format tanggal menjadi 12 Agustus 2024 -->
                        <?php echo date('d F Y', strtotime($data['tanggal'])); ?>
                    </div>
                    <?php if(!empty($data['lokasi'])): ?>
                    <div class="meta-badge">
                        <i class="fa-solid fa-location-dot"></i>
                        <?php echo $data['lokasi']; ?>
                    </div>
                    <?php endif; ?>
                </div>

                <!-- JUDUL -->
                <h1><?php echo $data['judul']; ?></h1>

                <!-- DESKRIPSI -->
                <!-- nl2br digunakan agar spasi/enter (paragraf) dari database terbaca otomatis -->
                <p><?php echo nl2br($data['deskripsi']); ?></p>

                <!-- TOMBOL KEMBALI -->
                <a href="index.php#kegiatan" class="btn-back">
                    <i class="fa-solid fa-arrow-left"></i> Kembali ke Beranda
                </a>

            </div>

        </div>
    </div>
</section>

</body>
</html>