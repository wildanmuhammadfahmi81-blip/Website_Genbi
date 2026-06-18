<?php

session_start();

include '../../config/koneksi.php';

$id = $_GET['id'];

$data = mysqli_fetch_assoc(

    mysqli_query(

        $conn,

        "SELECT * FROM kegiatan_absensi
        WHERE id='$id'"

    )

);

if(isset($_POST['simpan'])){

    $nama =
    $_POST['nama_kegiatan'];

    $tanggal =
    $_POST['tanggal'];

    $status =
    $_POST['status'];

    mysqli_query(

        $conn,

        "UPDATE kegiatan_absensi SET

        nama_kegiatan='$nama',
        tanggal='$tanggal',
        status='$status'

        WHERE id='$id'"

    );

    echo "

    <script>

    alert('Data berhasil diubah');

    window.location='index.php';

    </script>

    ";

}

?>

<!DOCTYPE html>
<html>
<head>

<title>Edit Absensi</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>

body{
    background:#f4f7fe;
}

.page-header{
    background:linear-gradient(135deg,#001F54,#004AAD);
    color:white;
    padding:30px;
    border-radius:25px;
    margin-bottom:25px;
    box-shadow:0 10px 30px rgba(0,74,173,.25);
}

.form-card{
    background:white;
    border:none;
    border-radius:25px;
    padding:30px;
    box-shadow:0 10px 25px rgba(0,0,0,.06);
}

.form-label{
    font-weight:600;
    color:#001F54;
}

.form-control,
.form-select{
    border-radius:12px;
    padding:12px;
}

.btn{
    border-radius:12px;
    padding:10px 20px;
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

</style>

</head>

<body>

<div class="container py-5">

<div class="page-header">

<h2>

<i class="bi bi-pencil-square"></i>

Edit Absensi GENBI

</h2>

<p class="mb-0">

Perbarui data kegiatan absensi anggota

</p>

</div>

<div class="form-card">

<form method="POST">

<div class="mb-3">

<label class="form-label">

Nama Kegiatan

</label>

<input
type="text"
name="nama_kegiatan"
class="form-control"
value="<?php echo $data['nama_kegiatan']; ?>"
required>

</div>

<div class="mb-3">

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

<div class="mb-4">

<label class="form-label">

Status Absensi

</label>

<select
name="status"
class="form-select">

<option
value="Buka"
<?php if($data['status']=="Buka") echo "selected"; ?>>

Buka

</option>

<option
value="Tutup"
<?php if($data['status']=="Tutup") echo "selected"; ?>>

Tutup

</option>

</select>

</div>

<div class="d-flex gap-2 flex-wrap">

<button
type="submit"
name="simpan"
class="btn btn-warning">

<i class="bi bi-save"></i>

Simpan Perubahan

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