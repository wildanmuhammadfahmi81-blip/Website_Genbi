<?php

session_start();

include '../../config/koneksi.php';

if(!isset($_SESSION['login'])){
    header("Location: ../login.php");
    exit();
}

/* =======================================================
1. PROSES UPDATE (Hanya berjalan jika tombol update diklik)
   ======================================================= */
/* =======================================================
1. PROSES UPDATE (Hanya berjalan jika tombol update diklik)
   ======================================================= */
if(isset($_POST['update'])){

    $id               = $_POST['id'];
    $judul            = $_POST['judul'];
    
    // Tangkap data teks input form baru Anda
    // (Jika Anda menggunakan Opsi A, ubah $_POST['deskripsi_atas'] menjadi $_POST['deskripsi'])
    $deskripsi_atas   = $_POST['deskripsi_atas']; 
    $deskripsi_bawah  = $_POST['deskripsi_bawah']; 

    if($_FILES['gambar']['name'] != ''){

        $gambar = $_FILES['gambar']['name'];
        $tmp    = $_FILES['gambar']['tmp_name'];

        move_uploaded_file(
            $tmp,
            "../../assets/upload/".$gambar
        );

        // Memperbarui kolom deskripsi_atas dan deskripsi_bawah beserta gambar
        mysqli_query(
            $conn,
            "UPDATE berita SET
            judul            = '$judul',
            deskripsi_atas   = '$deskripsi_atas',
            deskripsi_bawah  = '$deskripsi_bawah',
            gambar           = '$gambar'
            WHERE id='$id'"
        );

    } else {

        // Memperbarui kolom deskripsi_atas dan deskripsi_bawah tanpa mengganti gambar
        mysqli_query(
            $conn,
            "UPDATE berita SET
            judul            = '$judul',
            deskripsi_atas   = '$deskripsi_atas',
            deskripsi_bawah  = '$deskripsi_bawah'
            WHERE id='$id'"
        );

    }

    $_SESSION['success'] = "Berita berhasil diupdate!";
    header("Location: index.php");
    exit();
}

/* =======================================================
2. AMBIL DATA LAMA (Hanya berjalan saat halaman pertama dimuat)
   ======================================================= */
// Pastikan ID diambil murni dari URL browser ($_GET)
$id = isset($_GET['id']) ? $_GET['id'] : '';

$query = mysqli_query(
    $conn,
    "SELECT * FROM berita WHERE id='$id'"
);

$data = mysqli_fetch_array($query);

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta
name="viewport"
content="width=device-width, initial-scale=1.0">

<title>
    Edit Berita
</title>

<!-- BOOTSTRAP -->
<link
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">

<!-- FONT AWESOME -->
<link
rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<!-- GOOGLE FONT -->
<link
href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
rel="stylesheet">

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Poppins',sans-serif;
}

body{

    background:#f4f7fe;

    min-height:100vh;

    padding:40px 0;
}

/* =========================
CONTAINER
========================= */

.form-container{

    max-width:950px;

    margin:auto;
}

/* =========================
HEADER
========================= */

.page-header{

    background:
    linear-gradient(
        135deg,
        #001F54,
        #004AAD
    );

    padding:40px;

    border-radius:30px;

    color:white;

    margin-bottom:35px;

    position:relative;

    overflow:hidden;
}

.page-header::before{

    content:"";

    position:absolute;

    width:250px;
    height:250px;

    background:
    rgba(255,255,255,0.08);

    border-radius:50%;

    top:-100px;
    right:-80px;
}

.page-header h1{

    font-size:40px;

    font-weight:700;

    margin-bottom:10px;

    position:relative;
    z-index:2;
}

.page-header p{

    color:#dbeafe;

    margin:0;

    position:relative;
    z-index:2;
}

/* =========================
CARD
========================= */

.form-card{

    background:white;

    border-radius:30px;

    padding:40px;

    box-shadow:
    0 10px 30px rgba(0,0,0,0.05);
}

/* =========================
LABEL
========================= */

.form-label{

    font-weight:600;

    color:#001F54;

    margin-bottom:10px;
}

/* =========================
FORM CONTROL
========================= */

.form-control{

    border:2px solid #e5e7eb;

    border-radius:18px;

    padding:15px 18px;

    transition:0.3s;

    font-size:15px;
}

.form-control:focus{

    border-color:#004AAD;

    box-shadow:none;
}

textarea.form-control{

    resize:none;
}

/* =========================
IMAGE PREVIEW
========================= */

.preview-box{

    margin-top:20px;

    text-align:center;
}

.preview-box img{

    width:100%;

    max-width:350px;

    height:240px;

    object-fit:cover;

    border-radius:20px;

    box-shadow:
    0 10px 20px rgba(0,0,0,0.08);
}

.preview-text{

    margin-top:10px;

    color:#666;

    font-size:14px;
}

/* =========================
UPLOAD BOX
========================= */

.upload-box{

    border:2px dashed #cbd5e1;

    border-radius:20px;

    padding:30px;

    background:#f8fbff;

    transition:0.3s;
}

.upload-box:hover{

    border-color:#004AAD;

    background:#eef4ff;
}

/* =========================
BUTTON
========================= */

.button-group{

    margin-top:35px;

    display:flex;

    gap:15px;

    flex-wrap:wrap;
}

.btn-custom{

    border:none;

    padding:14px 28px;

    border-radius:50px;

    font-weight:600;

    transition:0.3s;

    text-decoration:none;

    display:inline-flex;

    align-items:center;

    gap:10px;
}

/* UPDATE */

.btn-update{

    background:
    linear-gradient(
        135deg,
        #001F54,
        #004AAD
    );

    color:white;
}

.btn-update:hover{

    transform:translateY(-3px);

    opacity:0.9;
}

/* KEMBALI */

.btn-back{

    background:#e5e7eb;

    color:#111827;
}

.btn-back:hover{

    background:#d1d5db;

    transform:translateY(-3px);
}

/* RESPONSIVE */

@media(max-width:768px){

    body{
        padding:20px;
    }

    .page-header{
        padding:30px;
    }

    .page-header h1{
        font-size:30px;
    }

    .form-card{
        padding:30px 20px;
    }

}

</style>

</head>

<body>

<div class="container form-container">

    <!-- HEADER -->
    <div class="page-header">

        <h1>
            Edit Berita
        </h1>

        <p>
            Perbarui informasi berita GENBI UIN SSC
        </p>

    </div>

    <!-- FORM CARD -->
    <div class="form-card">

        <form method="POST" enctype="multipart/form-data">
            
            <!-- ID Tersembunyi untuk proses update -->
            <input type="hidden" name="id" value="<?php echo $data['id']; ?>">

            <!-- JUDUL -->
            <div class="mb-4">
                <label class="form-label">Judul Berita</label>
                <input type="text" name="judul" class="form-control" value="<?php echo htmlspecialchars($data['judul'] ?? ''); ?>" required>
            </div>

            <!-- DESKRIPSI ATAS -->
<div class="mb-4">
    <label class="form-label">Deskripsi Bagian Atas</label>
    <textarea name="deskripsi_atas" rows="5" class="form-control" required><?php echo htmlspecialchars($data['deskripsi_atas'] ?? ''); ?></textarea>
</div>

<!-- DESKRIPSI BAWAH -->
<div class="mb-4">
    <label class="form-label">Deskripsi Bagian Bawah</label>
    <textarea name="deskripsi_bawah" rows="5" class="form-control" required><?php echo htmlspecialchars($data['deskripsi_bawah'] ?? ''); ?></textarea>
</div>


            <!-- FOTO SEKARANG -->
            <div class="preview-box">
                <img src="../../assets/upload/<?php echo $data['gambar']; ?>" alt="Gambar Berita">
                <div class="preview-text">Gambar berita saat ini</div>
            </div>

            <!-- GANTI FOTO -->
            <div class="mb-4 mt-4">
                <label class="form-label">Ganti Gambar</label>
                <div class="upload-box">
                    <input type="file" name="gambar" class="form-control">
                    <div class="preview-text">Kosongkan jika tidak ingin mengganti gambar</div>
                </div>
            </div>

            <!-- BUTTON -->
            <div class="button-group">
                <!-- UPDATE -->
                <button type="submit" name="update" class="btn-custom btn-update">
                    <i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan
                </button>
                <!-- KEMBALI -->
                <a href="index.php" class="btn-custom btn-back">
                    <i class="fa-solid fa-arrow-left"></i> Kembali
                </a>
            </div>

        </form>

    </div>

</div>

</body>
</html>