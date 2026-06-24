<?php

session_start();

include '../config/koneksi.php';

if(!isset($_SESSION['anggota'])){

    header("Location:login.php");
    exit();

}

$id_anggota = $_SESSION['id_anggota'];

$query = mysqli_query(

    $conn,

    "SELECT

    absensi.*,
    kegiatan_absensi.nama_kegiatan,
    kegiatan_absensi.tanggal

    FROM absensi

    JOIN kegiatan_absensi

    ON absensi.kegiatan_id =
    kegiatan_absensi.id

    WHERE absensi.anggota_id='$id_anggota'

    ORDER BY absensi.waktu_absen DESC"

);

?>

<!DOCTYPE html>
<html>
<head>

<meta charset="UTF-8">

<meta
name="viewport"
content="width=device-width, initial-scale=1.0">

<title>
Riwayat Absensi
</title>

<link
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">

<link
rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<style>

body{

    background:#f4f7fe;

}

.card-custom{

    background:white;

    border:none;

    border-radius:25px;

    box-shadow:
    0 10px 25px rgba(0,0,0,.05);

}

.foto{

    width:70px;
    height:70px;

    border-radius:12px;

    object-fit:cover;

}

.page-title{

    color:#001F54;

    font-weight:700;

}

.table-responsive{
    border-radius:20px;
}

@media(max-width:768px){

    .container{
        padding-left:12px;
        padding-right:12px;
    }

    .card-custom{
        border-radius:20px;
    }

    .card-body{
        padding:20px !important;
    }

    .page-title{
        font-size:22px;
        text-align:center;
    }

    .table{
        min-width:750px;
        font-size:13px;
    }

    .table th{
        white-space:nowrap;
    }

    .table td{
        white-space:nowrap;
        vertical-align:middle;
    }

    .foto{
        width:55px;
        height:55px;
    }

    .btn-secondary{
        width:100%;
        margin-top:15px;
    }

}

.page-header{

    background:linear-gradient(
        135deg,
        #001F54,
        #004AAD
    );

    color:white;

    padding:30px;

    border-radius:25px;

    margin-bottom:25px;

    box-shadow:
    0 15px 35px rgba(0,74,173,.2);

}

.page-header h2{

    font-weight:700;
    margin-bottom:5px;

}

.page-header p{

    opacity:.9;
    margin:0;

}

.stat-box{

    background:white;

    border-radius:20px;

    padding:25px;

    text-align:center;

    box-shadow:
    0 10px 25px rgba(0,0,0,.05);

    margin-bottom:25px;

}

.stat-box h2{

    font-size:42px;
    font-weight:700;
    color:#001F54;

}

.stat-box p{

    margin:0;
    color:#64748b;

}

.table{

    margin-bottom:0;

}

.table thead{

    background:#001F54;
    color:white;

}

.table thead th{

    border:none;
    padding:15px;

}

.table tbody td{

    padding:15px;
    vertical-align:middle;

}

.badge-status{

    background:#22c55e;
    color:white;

    padding:8px 14px;

    border-radius:50px;

    font-size:12px;

}

.foto{

    width:70px;
    height:70px;

    border-radius:15px;

    object-fit:cover;

    transition:.3s;

}

.foto:hover{

    transform:scale(1.1);

}

.btn-kembali{

    background:#001F54;
    color:white;

    border:none;

    border-radius:15px;

    padding:12px;

    font-weight:600;

}

.btn-kembali:hover{

    background:#00327f;
    color:white;

}

</style>

</head>

<body>

<div class="container py-5">

<div class="card card-custom">

<div class="card-body p-4">

<div class="row mb-4">

<div class="col-md-4">

<div class="stat-card">

<h6>Total Kehadiran</h6>

<h2>

<?php echo mysqli_num_rows($query); ?>

</h2>

</div>

</div>

</div>

<h2 class="page-title mb-4">

    <i class="fa-solid fa-clock-rotate-left"></i>

    Riwayat Absensi

</h2>

<div class="table-responsive">

<table class="table table-bordered table-hover">

<thead>

<tr>
<th>No</th>
<th>Kegiatan</th>
<th>Tanggal</th>
<th>Status</th>
<th>Waktu Absen</th>
<th>Foto</th>
</tr>

</thead>

<tbody>

<?php

$no = 1;

while($row=mysqli_fetch_assoc($query)){

?>

<tr>

<td><?= $no++; ?></td>

<td><?= $row['nama_kegiatan']; ?></td>

<td><?= $row['tanggal']; ?></td>

<td>

<span class="badge bg-success">

<?= $row['status']; ?>

</span>

</td>

<td><?= $row['waktu_absen']; ?></td>

<td>

<a
href="../assets/upload_absensi/<?= $row['foto']; ?>"
target="_blank">

<img
src="../assets/upload_absensi/<?= $row['foto']; ?>"
class="foto">

</a>

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

<div class="d-grid mt-3">

<a
href="dashboard.php"
class="btn btn-kembali"

<i class="fa-solid fa-arrow-left"></i>
Kembali ke Dashboard

</a>

</div>

</div>

</div>

</body>
</html>