<?php

session_start();

include '../../config/koneksi.php';

if(!isset($_SESSION['login'])){
    header("Location: ../login.php");
    exit();
}

$id = $_GET['id'];

$data = mysqli_fetch_array(
    mysqli_query(
        $conn,
        "SELECT * FROM kegiatan WHERE id='$id'"
    )
);

?>

<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">

<meta
name="viewport"
content="width=device-width, initial-scale=1.0">

<title>
    Edit Kegiatan
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
INPUT
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

    margin-top:15px;

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
            Edit Kegiatan
        </h1>

        <p>
            Perbarui informasi kegiatan GENBI UIN SSC
        </p>

    </div>

    <!-- FORM CARD -->
    <div class="form-card">

        <form
        action="update.php"
        method="POST"
        enctype="multipart/form-data">

            <!-- ID -->
            <input
            type="hidden"
            name="id"
            value="<?php echo $data['id']; ?>">

            <!-- JUDUL -->
            <div class="mb-4">

                <label class="form-label">

                    Judul Kegiatan

                </label>

                <input
                type="text"
                name="judul"
                class="form-control"
                value="<?php echo $data['judul']; ?>"
                required>

            </div>

            <!-- ROW -->
            <div class="row">

                <!-- TANGGAL -->
                <div class="col-md-6 mb-4">

                    <label class="form-label">

                        Tanggal Kegiatan

                    </label>

                    <input
                    type="date"
                    name="tanggal"
                    class="form-control"
                    value="<?php echo $data['tanggal']; ?>"
                    required>

                </div>

                <!-- LOKASI -->
                <div class="col-md-6 mb-4">

                    <label class="form-label">

                        Lokasi Kegiatan

                    </label>

                    <input
                    type="text"
                    name="lokasi"
                    class="form-control"
                    value="<?php echo $data['lokasi']; ?>"
                    required>

                </div>

            </div>

            <!-- DESKRIPSI -->
            <div class="mb-4">

                <label class="form-label">

                    Deskripsi Kegiatan

                </label>

                <textarea
                name="deskripsi"
                rows="6"
                class="form-control"
                required><?php echo $data['deskripsi']; ?></textarea>

            </div>

            <!-- UPLOAD -->
            <div class="mb-4">

                <label class="form-label">

                    Ganti Foto Kegiatan

                </label>

                <div class="upload-box">

                    <input
                    type="file"
                    name="gambar"
                    class="form-control">

                    <div class="preview-text">

                        Kosongkan jika tidak ingin mengganti gambar

                    </div>

                </div>

            </div>

            <!-- FOTO LAMA -->
            <div class="preview-box">

                <img
                src="../../assets/upload/kegiatan/<?php echo $data['gambar']; ?>">

                <div class="preview-text">

                    Foto kegiatan saat ini

                </div>

            </div>

            <!-- BUTTON -->
            <div class="button-group">

                <!-- UPDATE -->
                <button
                type="submit"
                class="btn-custom btn-update">

                    <i class="fa-solid fa-pen-to-square"></i>

                    Update Kegiatan

                </button>

                <!-- KEMBALI -->
                <a
                href="index.php"
                class="btn-custom btn-back">

                    <i class="fa-solid fa-arrow-left"></i>

                    Kembali

                </a>

            </div>

        </form>

    </div>

</div>

</body>
</html>