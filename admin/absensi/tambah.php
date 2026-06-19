<?php

session_start();

include '../../config/koneksi.php';

if(isset($_POST['submit'])){

    $nama =
    $_POST['nama_kegiatan'];

    $tanggal =
    $_POST['tanggal'];

    mysqli_query($conn,

    "INSERT INTO kegiatan_absensi
    (
        nama_kegiatan,
        tanggal,
        status
    )
    VALUES
    (
        '$nama',
        '$tanggal',
        'Buka'
    )");

    header("Location:index.php");

}

?>

<!DOCTYPE html>
<html>
<head>

<meta charset="UTF-8">

<meta
name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Buat Absensi GENBI</title>

<link
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">

<link
rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>

body{

    background:#f4f7fe;

}

.page-header{

    background:
    linear-gradient(
    135deg,
    #001F54,
    #004AAD
    );

    color:white;

    padding:30px;

    border-radius:25px;

    margin-bottom:25px;

    box-shadow:
    0 10px 30px rgba(0,74,173,.25);

}

.form-card{

    background:white;

    border:none;

    border-radius:25px;

    padding:30px;

    box-shadow:
    0 10px 25px rgba(0,0,0,.06);

}

.form-label{

    font-weight:600;

    color:#001F54;

}

.form-control{

    border-radius:12px;

    padding:12px;

}

.btn{

    border-radius:12px;

    padding:10px 20px;

}

.btn-success{

    background:
    linear-gradient(
        135deg,
        #16a34a,
        #22c55e
    );

    border:none;

    box-shadow:
    0 8px 20px rgba(34,197,94,.25);
}

.btn-success:hover{

    transform:translateY(-3px);

    box-shadow:
    0 12px 25px rgba(34,197,94,.35);
}

@media(max-width:768px){

    .page-header{

        padding:20px;

    }

    .page-header h2{

        font-size:22px;

    }

    .form-card{

        padding:20px;

    }

    .btn{

        width:100%;

        margin-bottom:10px;

    }

}

.input-group-custom{

    position:relative;

}

.input-group-custom i{

    position:absolute;

    left:18px;
    top:50%;

    transform:translateY(-50%);

    color:#004AAD;

    z-index:5;
}

.input-group-custom .form-control{

    padding-left:50px;

    height:55px;

    border-radius:15px;

    border:2px solid #eef2ff;

    transition:.3s;
}

.input-group-custom .form-control:focus{

    border-color:#2563eb;

    box-shadow:
    0 0 0 4px rgba(37,99,235,.15);

}

.preview-box{

    background:#eef4ff;

    border-left:5px solid #2563eb;

    padding:18px;

    border-radius:15px;

    margin-bottom:25px;
}

.preview-box h6{

    color:#004AAD;

    font-weight:700;
}

.page-header{

    position:relative;

    overflow:hidden;
}

.page-header::before{

    content:'';

    width:180px;
    height:180px;

    background:
    rgba(255,255,255,.08);

    border-radius:50%;

    position:absolute;

    top:-60px;
    right:-40px;
}

</style>

</head>

<body>

<div class="container py-5">

<div class="page-header">

<h2>

<i class="bi bi-plus-circle-fill"></i>

Buat Absensi GENBI

</h2>

<p class="mb-0">

Tambahkan kegiatan baru untuk absensi anggota

</p>

</div>

<div class="form-card">

<form method="POST">

<div class="mb-3">

<label class="form-label">

Nama Kegiatan

</label>

<div class="input-group-custom">

    <i class="bi bi-calendar-event"></i>

    <input
    type="text"
    name="nama_kegiatan"
    class="form-control"
    placeholder="Contoh: Rapat Bulanan GENBI"
    required>

</div>

</div>

<div class="mb-4">

<label class="form-label">

Tanggal Kegiatan

</label>

<div class="input-group-custom">

    <i class="bi bi-calendar-date"></i>

    <input
    type="date"
    name="tanggal"
    class="form-control"
    required>

</div>

</div>

<div class="preview-box">

    <h6>
        <i class="bi bi-lightbulb"></i>
        Tips
    </h6>

    <p class="mb-0">
        Pastikan nama kegiatan jelas dan sesuai agenda GENBI agar anggota mudah mengenali absensi.
    </p>

</div>

<div class="d-flex gap-2 flex-wrap">

<button
type="submit"
name="submit"
class="btn btn-success">

<i class="bi bi-check-circle"></i>

Simpan

</button>

<a
href="index.php"
class="btn btn-secondary">

<i class="bi bi-arrow-left-circle"></i>

Kembali

</a>

</div>

</form>

</div>

</div>

</body>

</html>