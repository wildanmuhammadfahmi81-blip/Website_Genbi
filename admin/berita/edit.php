<?php
session_start();
include '../../config/koneksi.php';

if(!isset($_SESSION['login'])){
    header("Location: ../login.php");
    exit();
}

/* =======================================================
1. PROSES UPDATE (Berjalan jika tombol update diklik)
   ======================================================= */
if(isset($_POST['update'])){

    $id               = mysqli_real_escape_string($conn, $_POST['id']);
    $judul            = mysqli_real_escape_string($conn, $_POST['judul']);
    $deskripsi_atas   = mysqli_real_escape_string($conn, $_POST['deskripsi_atas']);
    $deskripsi_bawah  = mysqli_real_escape_string($conn, $_POST['deskripsi_bawah']);

    // Proses Update Gambar Utama (Cover)
    if($_FILES['gambar']['name'] != ''){
        $gambar = $_FILES['gambar']['name'];
        $tmp    = $_FILES['gambar']['tmp_name'];
        move_uploaded_file($tmp, "../../assets/upload/".$gambar);
        
        mysqli_query($conn, "UPDATE berita SET gambar = '$gambar' WHERE id='$id'");
    }

    // Proses Update Gambar Isi
    if($_FILES['gambar_isi']['name'] != ''){
        $gambar_isi = $_FILES['gambar_isi']['name'];
        $tmp_isi    = $_FILES['gambar_isi']['tmp_name'];
        move_uploaded_file($tmp_isi, "../../assets/upload/".$gambar_isi);
        
        mysqli_query($conn, "UPDATE berita SET gambar_isi = '$gambar_isi' WHERE id='$id'");
    }

    // Update Teks
    mysqli_query($conn,
        "UPDATE berita SET
        judul            = '$judul',
        deskripsi_atas   = '$deskripsi_atas',
        deskripsi_bawah  = '$deskripsi_bawah'
        WHERE id='$id'"
    );

    $_SESSION['success'] = "Data berita berhasil diperbarui!";
    header("Location: index.php");
    exit();
}

/* =======================================================
2. AMBIL DATA LAMA
   ======================================================= */
$id = isset($_GET['id']) ? mysqli_real_escape_string($conn, $_GET['id']) : '';
$query = mysqli_query($conn, "SELECT * FROM berita WHERE id='$id'");
$data = mysqli_fetch_array($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Berita - GENBI</title>

<!-- BOOTSTRAP -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- FONT AWESOME -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<!-- GOOGLE FONT -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
    :root {
        --primary: #004AAD; --secondary: #001F54; --bg-color: #f0f4f8;
        --card-bg: #ffffff; --text-dark: #1e293b; --text-muted: #64748b;
    }
    * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }
    body { background: var(--bg-color); min-height: 100vh; padding: 50px 0; color: var(--text-dark); }
    .form-container { max-width: 950px; margin: auto; }

    @keyframes fadeUp { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }

    /* HEADER */
    .page-header {
        background: linear-gradient(135deg, var(--secondary) 0%, var(--primary) 100%);
        padding: 45px 40px; border-radius: 24px; color: white; margin-bottom: -40px; position: relative; overflow: hidden;
        box-shadow: 0 15px 35px rgba(0, 74, 173, 0.2); animation: fadeUp 0.6s ease-out; z-index: 1;
    }
    .page-header::before { content: ""; position: absolute; width: 300px; height: 300px; background: rgba(255, 255, 255, 0.05); border-radius: 50%; top: -120px; right: -100px; backdrop-filter: blur(5px); }
    .page-header h1 { font-size: 36px; font-weight: 700; margin-bottom: 8px; position: relative; z-index: 2; letter-spacing: -0.5px; }
    .page-header p { color: rgba(255, 255, 255, 0.85); margin: 0; font-size: 15px; position: relative; z-index: 2; }

    /* CARD & FORMS */
    .form-card {
        background: var(--card-bg); border-radius: 24px; padding: 70px 40px 40px; box-shadow: 0 20px 40px rgba(0, 0, 0, 0.04);
        position: relative; z-index: 2; animation: fadeUp 0.6s ease-out 0.1s both;
    }
    .form-label { font-weight: 600; color: var(--text-dark); margin-bottom: 10px; font-size: 14px; letter-spacing: 0.3px; }
    
    .input-group-custom { position: relative; }
    .input-group-custom i { position: absolute; top: 50%; left: 20px; transform: translateY(-50%); color: var(--text-muted); font-size: 18px; transition: 0.3s; }
    
    .form-control { background: #f8fafc; border: 2px solid transparent; border-radius: 16px; padding: 16px 20px; transition: all 0.3s ease; font-size: 15px; color: var(--text-dark); box-shadow: none; }
    .input-group-custom .form-control { padding-left: 55px; }
    .form-control:focus { background: white; border-color: var(--primary); box-shadow: 0 0 0 4px rgba(0, 74, 173, 0.1); }
    .form-control:focus + i { color: var(--primary); }
    textarea.form-control { resize: none; padding-top: 18px; }

    /* GAMBAR PREVIEW BERDAMPINGAN */
    .image-section-title { font-size: 18px; font-weight: 700; color: var(--secondary); margin-top: 20px; margin-bottom: 15px; border-bottom: 2px solid #e2e8f0; padding-bottom: 10px; }
    .current-image-box {
        background: #f8fafc; border-radius: 20px; padding: 15px; text-align: center; height: 100%; display: flex; align-items: center; justify-content: center; border: 1px solid #e2e8f0; flex-direction: column;
    }
    .current-image-box img { max-width: 100%; max-height: 200px; object-fit: cover; border-radius: 12px; box-shadow: 0 5px 15px rgba(0,0,0,0.08); margin-bottom: 10px; }
    .empty-image-placeholder { width: 100%; height: 150px; border-radius: 12px; background: #e2e8f0; display: flex; align-items: center; justify-content: center; color: var(--text-muted); font-size: 14px; font-style: italic; margin-bottom: 10px; }
    
    .upload-box { border: 2px dashed #cbd5e1; border-radius: 20px; padding: 30px; text-align: center; background: #f8fafc; transition: all 0.3s ease; height: 100%; display: flex; flex-direction: column; justify-content: center; }
    .upload-box:hover, .upload-box:focus-within { border-color: var(--primary); background: #f0f7ff; }
    .upload-box i { font-size: 35px; color: var(--primary); margin-bottom: 10px; }
    .upload-box p { margin: 0 0 15px 0; color: var(--text-muted); font-size: 13px; font-weight: 500; }
    .upload-box input[type="file"] { background: white; border: 1px solid #e2e8f0; padding: 10px; border-radius: 12px; font-size: 13px; width: 100%; }

    /* BUTTONS */
    .button-group { margin-top: 40px; display: flex; gap: 15px; align-items: center; }
    .btn-custom { border: none; padding: 15px 32px; border-radius: 50px; font-weight: 600; transition: all 0.3s ease; text-decoration: none; display: inline-flex; align-items: center; gap: 10px; font-size: 15px; cursor: pointer; }
    .btn-update { background: linear-gradient(135deg, var(--secondary), var(--primary)); color: white; box-shadow: 0 10px 20px rgba(0, 74, 173, 0.2); }
    .btn-update:hover { transform: translateY(-3px); box-shadow: 0 15px 25px rgba(0, 74, 173, 0.3); color: white; }
    .btn-back { background: #f1f5f9; color: var(--text-dark); }
    .btn-back:hover { background: #e2e8f0; color: var(--text-dark); transform: translateY(-3px); }

    @media(max-width: 768px){
        body { padding: 20px; } .page-header { padding: 35px 25px; margin-bottom: -30px; } .form-card { padding: 50px 25px 30px; } .button-group { flex-direction: column; width: 100%; } .btn-custom { width: 100%; justify-content: center; }
    }
</style>
</head>
<body>

<div class="container form-container">

    <div class="page-header">
        <h1>Edit Berita</h1>
        <p>Perbarui detail artikel atau berita yang telah terpublikasi</p>
    </div>

    <div class="form-card">
        <form method="POST" enctype="multipart/form-data">
            
            <input type="hidden" name="id" value="<?php echo $data['id']; ?>">

            <!-- JUDUL -->
            <div class="mb-4">
                <label class="form-label">Judul Berita</label>
                <div class="input-group-custom">
                    <i class="fa-solid fa-heading"></i>
                    <input type="text" name="judul" class="form-control" value="<?php echo htmlspecialchars($data['judul'] ?? ''); ?>" required>
                </div>
            </div>

            <!-- DESKRIPSI ATAS -->
            <div class="mb-4">
                <label class="form-label">Deskripsi Bagian Atas</label>
                <textarea name="deskripsi_atas" rows="6" class="form-control" required><?php echo htmlspecialchars($data['deskripsi_atas'] ?? ''); ?></textarea>
            </div>

            <!-- DESKRIPSI BAWAH -->
            <div class="mb-4">
                <label class="form-label">Deskripsi Bagian Bawah</label>
                <textarea name="deskripsi_bawah" rows="6" class="form-control" required><?php echo htmlspecialchars($data['deskripsi_bawah'] ?? ''); ?></textarea>
            </div>

            <!-- BAGIAN GAMBAR UTAMA (COVER) -->
            <div class="image-section-title">Gambar Utama (Cover)</div>
            <div class="row mb-4 align-items-stretch">
                <div class="col-md-5 mb-3 mb-md-0">
                    <div class="current-image-box">
                        <img src="../../assets/upload/<?php echo $data['gambar']; ?>" alt="Gambar Cover">
                        <span class="text-muted" style="font-size: 13px;">Gambar Cover Saat Ini</span>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="upload-box">
                        <i class="fa-solid fa-image"></i>
                        <p>Abaikan jika tidak ingin mengubah Cover.</p>
                        <input type="file" name="gambar" class="form-control" accept="image/*">
                    </div>
                </div>
            </div>

            <!-- BAGIAN GAMBAR ISI (OPSIONAL) -->
            <div class="image-section-title">Gambar Isi (Opsional)</div>
            <div class="row mb-4 align-items-stretch">
                <div class="col-md-5 mb-3 mb-md-0">
                    <div class="current-image-box">
                        <?php if(!empty($data['gambar_isi'])): ?>
                            <img src="../../assets/upload/<?php echo $data['gambar_isi']; ?>" alt="Gambar Isi">
                        <?php else: ?>
                            <div class="empty-image-placeholder">Tidak ada gambar isi</div>
                        <?php endif; ?>
                        <span class="text-muted" style="font-size: 13px;">Gambar Isi Saat Ini</span>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="upload-box">
                        <i class="fa-solid fa-photo-film"></i>
                        <p>Abaikan jika tidak ingin mengubah Gambar Isi.</p>
                        <input type="file" name="gambar_isi" class="form-control" accept="image/*">
                    </div>
                </div>
            </div>

            <!-- BUTTONS -->
            <div class="button-group">
                <button type="submit" name="update" class="btn-custom btn-update">
                    <i class="fa-solid fa-pen-to-square"></i> Simpan Perubahan
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