<?php
session_start();
include '../../config/koneksi.php';

if(!isset($_SESSION['login'])){
    header("Location: ../login.php");
    exit();
}

$id = $_GET['id'];
$data = mysqli_fetch_array(
    mysqli_query($conn, "SELECT * FROM kegiatan WHERE id='$id'")
);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Kegiatan - GENBI</title>

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
        --bg-color: #f0f4f8;
        --card-bg: #ffffff;
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
        min-height: 100vh;
        padding: 50px 0;
        color: var(--text-dark);
    }

    .form-container {
        max-width: 900px;
        margin: auto;
    }

    /* =========================
       ANIMATION
    ========================= */
    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* =========================
       HEADER
    ========================= */
    .page-header {
        background: linear-gradient(135deg, var(--secondary) 0%, var(--primary) 100%);
        padding: 45px 40px;
        border-radius: 24px;
        color: white;
        margin-bottom: -40px; /* Overlap effect */
        position: relative;
        overflow: hidden;
        box-shadow: 0 15px 35px rgba(0, 74, 173, 0.2);
        animation: fadeUp 0.6s ease-out;
        z-index: 1;
    }

    .page-header::before {
        content: "";
        position: absolute;
        width: 300px;
        height: 300px;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 50%;
        top: -120px;
        right: -100px;
        backdrop-filter: blur(5px);
    }

    .page-header::after {
        content: "";
        position: absolute;
        width: 150px;
        height: 150px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        bottom: -50px;
        left: -50px;
    }

    .page-header h1 {
        font-size: 36px;
        font-weight: 700;
        margin-bottom: 8px;
        position: relative;
        z-index: 2;
        letter-spacing: -0.5px;
    }

    .page-header p {
        color: rgba(255, 255, 255, 0.85);
        margin: 0;
        font-size: 15px;
        position: relative;
        z-index: 2;
    }

    /* =========================
       CARD & FORMS
    ========================= */
    .form-card {
        background: var(--card-bg);
        border-radius: 24px;
        padding: 70px 40px 40px; /* Top padding extra for overlap */
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.04);
        position: relative;
        z-index: 2;
        animation: fadeUp 0.6s ease-out 0.1s both;
    }

    .form-label {
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 10px;
        font-size: 14px;
        letter-spacing: 0.3px;
    }

    .input-group-custom {
        position: relative;
    }

    .input-group-custom i {
        position: absolute;
        top: 50%;
        left: 20px;
        transform: translateY(-50%);
        color: var(--text-muted);
        font-size: 18px;
        transition: 0.3s;
    }

    .form-control {
        background: #f8fafc;
        border: 2px solid transparent;
        border-radius: 16px;
        padding: 16px 20px;
        transition: all 0.3s ease;
        font-size: 15px;
        color: var(--text-dark);
        box-shadow: none;
    }

    .input-group-custom .form-control {
        padding-left: 55px; /* Space for icon */
    }

    .form-control:focus {
        background: white;
        border-color: var(--primary);
        box-shadow: 0 0 0 4px rgba(0, 74, 173, 0.1);
    }

    .form-control:focus + i, 
    .form-control:focus ~ i {
        color: var(--primary);
    }

    textarea.form-control {
        resize: none;
        padding-top: 18px;
    }

    /* =========================
       IMAGE PREVIEW & UPLOAD
    ========================= */
    .current-image-box {
        background: #f8fafc;
        border-radius: 20px;
        padding: 15px;
        text-align: center;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #e2e8f0;
    }

    .current-image-box img {
        max-width: 100%;
        max-height: 180px;
        object-fit: cover;
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    }

    .upload-box {
        border: 2px dashed #cbd5e1;
        border-radius: 20px;
        padding: 30px;
        text-align: center;
        background: #f8fafc;
        transition: all 0.3s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .upload-box:hover, .upload-box:focus-within {
        border-color: var(--primary);
        background: #f0f7ff;
    }

    .upload-box i {
        font-size: 40px;
        color: var(--primary);
        margin-bottom: 10px;
        transition: transform 0.3s ease;
    }

    .upload-box:hover i {
        transform: translateY(-5px);
    }

    .upload-box p {
        margin: 0 0 15px 0;
        color: var(--text-muted);
        font-size: 13px;
        font-weight: 500;
    }

    .upload-box input[type="file"] {
        background: white;
        border: 1px solid #e2e8f0;
        padding: 10px;
        border-radius: 12px;
        font-size: 14px;
        width: 100%;
    }

    /* =========================
       BUTTONS
    ========================= */
    .button-group {
        margin-top: 40px;
        display: flex;
        gap: 15px;
        align-items: center;
    }

    .btn-custom {
        border: none;
        padding: 15px 32px;
        border-radius: 50px;
        font-weight: 600;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        font-size: 15px;
        cursor: pointer;
    }

    .btn-update {
        background: linear-gradient(135deg, var(--secondary), var(--primary));
        color: white;
        box-shadow: 0 10px 20px rgba(0, 74, 173, 0.2);
    }

    .btn-update:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 25px rgba(0, 74, 173, 0.3);
        color: white;
    }

    .btn-back {
        background: #f1f5f9;
        color: var(--text-dark);
    }

    .btn-back:hover {
        background: #e2e8f0;
        color: var(--text-dark);
        transform: translateY(-3px);
    }

    /* =========================
       RESPONSIVE
    ========================= */
    @media(max-width: 768px){
        body { padding: 20px; }
        .page-header { padding: 35px 25px; margin-bottom: -30px; }
        .page-header h1 { font-size: 28px; }
        .form-card { padding: 50px 25px 30px; }
        .button-group { flex-direction: column; width: 100%; }
        .btn-custom { width: 100%; justify-content: center; }
    }
</style>
</head>
<body>

<div class="container form-container">

    <!-- HEADER -->
    <div class="page-header">
        <h1>Edit Kegiatan</h1>
        <p>Perbarui detail informasi dan dokumentasi kegiatan GENBI</p>
    </div>

    <!-- FORM CARD -->
    <div class="form-card">
        <form action="update.php" method="POST" enctype="multipart/form-data">
            
            <!-- ID (Hidden) -->
            <input type="hidden" name="id" value="<?php echo $data['id']; ?>">

            <!-- JUDUL -->
            <div class="mb-4">
                <label class="form-label">Judul Kegiatan</label>
                <div class="input-group-custom">
                    <i class="fa-solid fa-heading"></i>
                    <input type="text" name="judul" class="form-control" value="<?php echo $data['judul']; ?>" required>
                </div>
            </div>

            <!-- TANGGAL & LOKASI -->
            <div class="row">
                <div class="col-md-6 mb-4">
                    <label class="form-label">Tanggal Kegiatan</label>
                    <div class="input-group-custom">
                        <i class="fa-regular fa-calendar"></i>
                        <input type="date" name="tanggal" class="form-control" value="<?php echo $data['tanggal']; ?>" required>
                    </div>
                </div>

                <div class="col-md-6 mb-4">
                    <label class="form-label">Lokasi Kegiatan</label>
                    <div class="input-group-custom">
                        <i class="fa-solid fa-location-dot"></i>
                        <input type="text" name="lokasi" class="form-control" value="<?php echo $data['lokasi']; ?>" required>
                    </div>
                </div>
            </div>

            <!-- DESKRIPSI -->
            <div class="mb-4">
                <label class="form-label">Deskripsi Kegiatan</label>
                <textarea name="deskripsi" rows="6" class="form-control" required><?php echo $data['deskripsi']; ?></textarea>
            </div>

            <!-- BAGIAN GAMBAR (DIBUAT BERDAMPINGAN) -->
            <div class="row mb-4 align-items-stretch">
                <!-- Foto Saat Ini -->
                <div class="col-md-5 mb-3 mb-md-0">
                    <label class="form-label">Foto Saat Ini</label>
                    <div class="current-image-box">
                        <img src="../../assets/upload/kegiatan/<?php echo $data['gambar']; ?>" alt="Foto Lama">
                    </div>
                </div>
                
                <!-- Upload Baru -->
                <div class="col-md-7">
                    <label class="form-label">Ganti Foto (Opsional)</label>
                    <div class="upload-box">
                        <i class="fa-solid fa-cloud-arrow-up"></i>
                        <p>Abaikan jika tidak ingin mengubah foto</p>
                        <input type="file" name="gambar" class="form-control" accept="image/*">
                    </div>
                </div>
            </div>

            <!-- BUTTONS -->
            <div class="button-group">
                <button type="submit" class="btn-custom btn-update">
                    <i class="fa-solid fa-pen-to-square"></i> Update Kegiatan
                </button>
                <a href="index.php" class="btn-custom btn-back">
                    <i class="fa-solid fa-arrow-left"></i> Kembali
                </a>
            </div>

        </form>
    </div>

</div>

</body>
</html>