<?php

session_start();

include '../config/koneksi.php';

if(!isset($_SESSION['anggota'])){

    header("Location:login.php");
    exit();

}

$id_anggota = $_SESSION['id_anggota'];

/*
=========================
AMBIL DATA ANGGOTA
=========================
*/

$data = mysqli_fetch_assoc(

    mysqli_query(

        $conn,

        "SELECT *
        FROM anggota
        WHERE id='$id_anggota'"

    )

);

/*
=========================
TOTAL KEHADIRAN
=========================
*/

$totalHadir = mysqli_num_rows(

    mysqli_query(

        $conn,

        "SELECT *
        FROM absensi
        WHERE anggota_id='$id_anggota'"

    )

);

/*
=========================
UPDATE DATA DIRI
=========================
*/

if(isset($_POST['update_data'])){

    $nim      = mysqli_real_escape_string(
        $conn,
        $_POST['nim']
    );

    $jurusan  = mysqli_real_escape_string(
        $conn,
        $_POST['jurusan']
    );

    mysqli_query(

        $conn,

        "UPDATE anggota
        SET
        nim='$nim',
        jurusan='$jurusan'
        WHERE id='$id_anggota'"

    );

    echo "
    <script>

    alert('Data berhasil diperbarui');

    window.location='profil.php';

    </script>
    ";

}

/*
=========================
UPLOAD FOTO
=========================
*/

if(isset($_POST['upload_foto'])){

    $foto = $_FILES['foto']['name'];

    $tmp  = $_FILES['foto']['tmp_name'];

    if($foto != ''){

        $namaFoto =
        time().'_'.$foto;

        move_uploaded_file(

            $tmp,

            "../assets/foto_anggota/".$namaFoto

        );

        mysqli_query(

            $conn,

            "UPDATE anggota
            SET foto='$namaFoto'
            WHERE id='$id_anggota'"

        );

        echo "
        <script>
        alert('Foto berhasil diperbarui');
        window.location='profil.php';
        </script>
        ";

    }

}

?>

<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">

<meta
name="viewport"
content="width=device-width, initial-scale=1.0">

<title>
Profil Saya
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

.profile-card{

    background:white;

    border:none;

    border-radius:30px;

    overflow:hidden;

    box-shadow:
    0 15px 35px rgba(0,0,0,.08);

}

.profile-header{

    background:
    linear-gradient(
    135deg,
    #001F54,
    #004AAD
    );

    color:white;

    text-align:center;

    padding:40px;

}

.profile-img{

    width:130px;

    height:130px;

    object-fit:cover;

    border-radius:50%;

    border:5px solid white;

    margin-bottom:15px;

}

.info-box{

    background:#f8fafc;

    border-radius:15px;

    padding:15px;

    margin-bottom:15px;

}

.stat-card{

    background:white;

    border-radius:20px;

    padding:20px;

    text-align:center;

    box-shadow:
    0 10px 25px rgba(0,0,0,.05);

}

.stat-card h2{

    color:#001F54;

    font-weight:700;

}

</style>

</head>

<body>

<div class="container py-5">

<div class="row justify-content-center">

<div class="col-lg-8">

<div class="profile-card">

<div class="profile-header">

<?php

if(!empty($data['foto'])){

?>

<img
src="../assets/foto_anggota/<?php echo $data['foto']; ?>"
class="profile-img">

<?php

}else{

?>

<img
src="https://ui-avatars.com/api/?name=<?php echo urlencode($data['nama']); ?>&background=ffffff&color=001F54&size=200"
class="profile-img">

<?php

}

?>

<h3>

<?php echo $data['nama']; ?>

</h3>

<p class="mb-0">

<?php echo $data['divisi']; ?>

</p>

</div>

<div class="card-body p-4">

<div class="row mb-4">

<div class="col-md-4">

<div class="stat-card">

<h6>Total Kehadiran</h6>

<h2>

<?php echo $totalHadir; ?>

</h2>

</div>

</div>

</div>

<div class="info-box">

<b>
Username
</b>

<br>

<?php echo $data['username']; ?>

</div>

<div class="info-box">

<b>
Nama Lengkap
</b>

<br>

<?php echo $data['nama']; ?>

</div>

<div class="info-box">

<b>
Divisi
</b>

<br>

<?php echo $data['divisi']; ?>

</div>

<hr>

<h5 class="mb-3">
<i class="fa-solid fa-user-pen"></i>
Lengkapi Data Diri
</h5>

<form method="POST">

<div class="mb-3">
<label class="form-label">
NIM
</label>

<input
type="text"
name="nim"
class="form-control"
value="<?php echo $data['nim']; ?>">
</div>

<div class="mb-3">
<label class="form-label">
Jurusan
</label>

<input
type="text"
name="jurusan"
class="form-control"
value="<?php echo $data['jurusan']; ?>">
</div>

<button
type="submit"
name="update_data"
class="btn btn-success">

<i class="fa-solid fa-floppy-disk"></i>

Simpan Data

</button>

</form>

<hr>

<h5 class="mb-3">

<i class="fa-solid fa-camera"></i>

Ganti Foto Profil

</h5>

<form
method="POST"
enctype="multipart/form-data">

<input
type="file"
name="foto"
class="form-control mb-3"
required>

<button
type="submit"
name="upload_foto"
class="btn btn-primary">

Simpan Foto

</button>

</form>

<hr>

<div class="d-flex gap-2">

<a
href="ganti-password.php"
class="btn btn-warning">

<i class="fa-solid fa-key"></i>

Update Password

</a>

<a
href="dashboard.php"
class="btn btn-secondary">

<i class="fa-solid fa-arrow-left"></i>

Kembali

</a>

</div>


</div>

</div>

</div>

</div>

</div>

</body>

</html>