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

</style>

</head>

<body>

<div class="container py-5">

<div class="card card-custom">

<div class="card-body p-4">

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

</table>

</div>

<tbody>

<?php

$no = 1;

while($row=mysqli_fetch_assoc($query)){

?>

<tr>

<td>

    <?php echo $no++; ?>

</td>

<td>

    <?php echo $row['nama_kegiatan']; ?>

</td>

<td>

    <?php echo $row['tanggal']; ?>

</td>

<td>

<span class="badge bg-success">

    <?php echo $row['status']; ?>

</span>

</td>

<td>

    <?php echo $row['waktu_absen']; ?>

</td>

<td>

<a
href="../assets/upload_absensi/<?php echo $row['foto']; ?>"
target="_blank">

<img
src="../assets/upload_absensi/<?php echo $row['foto']; ?>"
class="foto">

</a>

</td>

</tr>

<?php } ?>

</tbody>

</table>

<div class="d-grid mt-3">

<a
href="dashboard.php"
class="btn btn-secondary">

<i class="fa-solid fa-arrow-left"></i>
Kembali ke Dashboard

</a>

</div>

</div>

</div>

</body>
</html>