<?php

session_start();

include '../../config/koneksi.php';

if(!isset($_SESSION['login'])){
    header("Location: ../login.php");
    exit();
}

if(isset($_POST['submit'])){

    $judul            = $_POST['judul'];

    $deskripsi_atas   = $_POST['deskripsi_atas'];

    $deskripsi_bawah  = $_POST['deskripsi_bawah'];

    /* COVER */
    $gambar = $_FILES['gambar']['name'];
    $gambar_isi = $_FILES['gambar_isi']['name'];
    $tmp    = $_FILES['gambar']['tmp_name'];

    move_uploaded_file(
        $tmp,
        "../../assets/upload/".$gambar
    );

    /* GAMBAR ISI */
    $gambar_isi = $_FILES['gambar_isi']['name'];

    if($gambar_isi != ''){

        move_uploaded_file(

            $_FILES['gambar_isi']['tmp_name'],

            "../../assets/upload/".$gambar_isi

        );

    }

    mysqli_query($conn,
    "INSERT INTO berita (

        judul,
        deskripsi_atas,
        deskripsi_bawah,
        gambar,
        gambar_isi,
        tanggal

    ) VALUES (

        '$judul',
        '$deskripsi_atas',
        '$deskripsi_bawah',
        '$gambar',
        '$gambar_isi',
        NOW()

    )"
);

    echo "
    <script>

        alert('Berita berhasil ditambahkan!');

        window.location='index.php';

    </script>
    ";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">

<meta
name="viewport"
content="width=device-width, initial-scale=1.0">

<title>
    Tambah Berita
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

    max-width:900px;

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
UPLOAD BOX
========================= */

.upload-box{

    border:2px dashed #cbd5e1;

    border-radius:20px;

    padding:30px;

    background:#f8fbff;

    transition:0.3s;

    text-align:center;
}

.upload-box:hover{

    border-color:#004AAD;

    background:#eef4ff;
}

.upload-box i{

    font-size:45px;

    color:#004AAD;

    margin-bottom:15px;
}

.upload-box p{

    color:#666;

    margin-bottom:20px;
}

/* =========================
BUTTONS
========================= */

.button-group{

    display:flex;

    gap:15px;

    flex-wrap:wrap;

    margin-top:35px;
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

/* SIMPAN */

.btn-save{

    background:
    linear-gradient(
        135deg,
        #001F54,
        #004AAD
    );

    color:white;
}

.btn-save:hover{

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
            Tambah Berita
        </h1>

        <p>
            Tambahkan informasi dan berita terbaru GENBI UIN SSC
        </p>

    </div>

    <!-- FORM -->
    <div class="form-card">

        <form
        method="POST"
        enctype="multipart/form-data">

            <!-- JUDUL -->
            <div class="mb-4">

                <label class="form-label">

                    Judul Berita

                </label>

                <input
                type="text"
                name="judul"
                class="form-control"
                placeholder="Masukkan judul berita..."
                required>

            </div>

            <!-- DESKRIPSI -->
            <div class="mb-4">

<label class="form-label">

Isi Berita (Bagian Atas)

</label>

Isi Berita (Bagian Atas)

</label>

<textarea
name="deskripsi_atas"
rows="8"
class="form-control"
required></textarea>

</div>

<div class="mb-4">

<label class="form-label">

Isi Berita (Bagian Bawah)

</label>

<textarea
name="deskripsi_bawah"
rows="8"
class="form-control"
required></textarea>

</div>

            <!-- UPLOAD -->
            <div class="mb-4">

                <label class="form-label">

                    Upload Gambar

                </label>

                <div class="upload-box">

                    <i class="fa-solid fa-cloud-arrow-up"></i>

                    <p>
                        Upload gambar terbaik untuk berita
                    </p>

                    <input
                    type="file"
                    name="gambar"
                    class="form-control"
                    required>

                </div>

            </div>

            <div class="mb-3">

<label>
    Gambar Isi Berita
</label>

<input
type="file"
name="gambar_isi"
class="form-control">

<small class="text-muted">
Foto yang tampil di dalam isi berita
</small>

</div>

            <!-- BUTTON -->
            <div class="button-group">

                <!-- SIMPAN -->
                <button
                type="submit"
                name="submit"
                class="btn-custom btn-save">

                    <i class="fa-solid fa-floppy-disk"></i>

                    Simpan Berita

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