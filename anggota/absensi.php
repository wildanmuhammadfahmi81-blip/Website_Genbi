<?php

session_start();

include '../config/koneksi.php';

if(!isset($_SESSION['anggota'])){

    header("Location:login.php");
    exit();

}

$id_anggota = $_SESSION['id_anggota'];

$dataAnggota = mysqli_fetch_assoc(
    mysqli_query(
        $conn,
        "SELECT * FROM anggota
        WHERE id='$id_anggota'"
    )
);

/* =========================
TOTAL KEHADIRAN SAYA
========================= */

$totalSaya = mysqli_num_rows(

    mysqli_query(

        $conn,

        "SELECT *
        FROM absensi
        WHERE anggota_id='$id_anggota'"

    )

);

/*
=========================
PROSES ABSEN
=========================
*/

if(isset($_POST['absen'])){

    $kegiatan_id = $_POST['kegiatan_id'];

    // --- 1. SISIHKAN KODE PENGUNCI DI SINI ---
    $cek_status = mysqli_query($conn, "SELECT status FROM kegiatan_absensi WHERE id='$kegiatan_id'");
    $status_kegiatan = mysqli_fetch_assoc($cek_status)['status'];

    if ($status_kegiatan == 'Tutup') {
        echo "
        <script>
        alert('Maaf, absensi untuk kegiatan ini telah ditutup oleh admin!');
        window.location='absensi.php';
        </script>
        ";
        exit();
    }
    // ----------------------------------------

    /* cek sudah absen atau belum */
    $cek = mysqli_query(
        $conn,
        "SELECT * FROM absensi
        WHERE anggota_id='$id_anggota'
        AND kegiatan_id='$kegiatan_id'"
    );


    if(mysqli_num_rows($cek)>0){

        echo "
        <script>
        alert('Anda sudah absen pada kegiatan ini!');
        </script>
        ";

    }else{

        $nim = $_POST['nim'];
        $jurusan = $_POST['jurusan'];
        $pesan_kesan = $_POST['pesan_kesan'];
        $foto = $_FILES['foto']['name'];
        $tmp  = $_FILES['foto']['tmp_name'];

        $namaFoto =
        time().'_'.$foto;

        move_uploaded_file(

            $tmp,

            "../assets/upload_absensi/".$namaFoto

        );

        mysqli_query(

    $conn,

    "INSERT INTO absensi
    (
        anggota_id,
        kegiatan_id,
        nim,
        jurusan,
        pesan_kesan,
        foto,
        waktu_absen,
        status
    )
    VALUES
    (
        '$id_anggota',
        '$kegiatan_id',
        '$nim',
        '$jurusan',
        '$pesan_kesan',
        '$namaFoto',
        NOW(),
        'Hadir'
    )"

);

        echo "
        <script>

        alert('Absensi berhasil!');

        window.location='absensi.php';

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
Absensi GENBI
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

.page-title{

    color:#001F54;

    font-weight:700;

}

.absensi-card{

    background:white;

    border:none;

    border-radius:25px;

    box-shadow:
    0 10px 25px rgba(0,0,0,.05);

    margin-bottom:25px;

}

.badge-buka{

    background:#22c55e;

    padding:8px 15px;

    border-radius:30px;

}

.alert-success{

    border-radius:18px;

}

.card{

    transition:.3s;

}

.card:hover{

    transform:translateY(-4px);

}

.header-box{

    background:
    linear-gradient(
    135deg,
    #001F54,
    #004AAD
    );

    color:white;

    padding:35px;

    border-radius:30px;

    margin-bottom:25px;

    box-shadow:
    0 15px 35px rgba(0,74,173,.25);

}

.stat-card{

    background:white;

    border-radius:25px;

    padding:25px;

    text-align:center;

    box-shadow:
    0 10px 25px rgba(0,0,0,.06);

}

.stat-card h1{

    font-size:55px;

    font-weight:700;

    color:#001F54;

}

.absensi-card{

    border:none;

    border-radius:30px;

    overflow:hidden;

    box-shadow:
    0 15px 30px rgba(0,0,0,.06);

}

.absensi-card:hover{

    transform:translateY(-5px);

    transition:.3s;

}

.card-top{

    background:
    linear-gradient(
    135deg,
    #001F54,
    #004AAD
    );

    color:white;

    padding:20px;

}

.upload-box{

    border:2px dashed #dbeafe;

    border-radius:15px;

    padding:20px;

    background:#f8fafc;

}

.preview{

    width:100%;
    max-height:250px;

    object-fit:cover;

    border-radius:15px;

    margin-top:15px;

    display:none;

}

.btn-success{

    border-radius:15px;

    padding:12px;

    font-weight:600;

}

.upload-box{

    border:2px dashed #cbd5e1;

    border-radius:15px;

    padding:20px;

    background:#f8fafc;

}

.preview{

    width:100%;

    max-height:250px;

    object-fit:cover;

    border-radius:15px;

    margin-top:15px;

    display:none;

}

.card-top{

    background:
    linear-gradient(
        135deg,
        #001F54,
        #004AAD
    );

    color:white;

    padding:20px;

}

.form-control,
textarea{

    border-radius:15px;
    padding:12px;

    border:1px solid #dbeafe;
}

.form-control:focus,
textarea:focus{

    border-color:#2563eb;

    box-shadow:
    0 0 0 4px rgba(37,99,235,.15);
}

textarea{

    resize:none;
}

.absensi-card{

    background:white;

    border-radius:30px;

    overflow:hidden;

    box-shadow:
    0 15px 35px rgba(0,0,0,.08);
}

</style>

</head>

<body>

<div class="container py-5">

<div class="header-box">

    <h2>

        Halo,
        <?php echo $_SESSION['nama']; ?>

        👋

    </h2>

    <p class="mb-0">

        Divisi :
        <?php echo $_SESSION['divisi']; ?>

    </p>

</div>

<div class="row mb-4">

<div class="col-md-4">

<div class="stat-card">

<h6>

Total Kehadiran

</h6>

<h1>

<?php echo $totalSaya; ?>

</h1>

</div>

</div>

</div>

<div class="row mb-4">

    <i class="fa-solid fa-clipboard-check"></i>

    Absensi GENBI

</h2>

<?php

$kegiatan = mysqli_query(

    $conn,

    "SELECT *
    FROM kegiatan_absensi
    WHERE status='Buka'
    ORDER BY tanggal DESC"

);

if(mysqli_num_rows($kegiatan)==0){

?>

<div class="alert alert-warning">

    Belum ada absensi yang dibuka admin.

</div>

<?php

}else{

while($row=mysqli_fetch_assoc($kegiatan)){

$cekAbsen = mysqli_query(

    $conn,

    "SELECT *
    FROM absensi
    WHERE anggota_id='$id_anggota'
    AND kegiatan_id='".$row['id']."'"

);

$sudahAbsen =
mysqli_num_rows($cekAbsen);

$dataAbsen =
mysqli_fetch_assoc($cekAbsen);

?>

<div class="card absensi-card">

<div class="card-body p-4">

<h4>

    <?php echo $row['nama_kegiatan']; ?>

</h4>

<p>

    <i class="fa-solid fa-calendar"></i>

    <?php echo $row['tanggal']; ?>

</p>

<span class="badge badge-buka">

    <?php echo $row['status']; ?>

</span>

<hr>

<?php if($sudahAbsen > 0){ ?>

<div class="alert alert-success border-0">

    <h5>

        <i class="fa-solid fa-circle-check"></i>

        Anda Sudah Absen

    </h5>

    <p class="mb-2">

        Waktu Absen :

        <b>

            <?php echo $dataAbsen['waktu_absen']; ?>

        </b>

    </p>

    <a
    href="../assets/upload_absensi/<?php echo $dataAbsen['foto']; ?>"
    target="_blank"
    class="btn btn-success btn-sm">

        <i class="fa-solid fa-image"></i>

        Lihat Bukti Foto

    </a>

</div>

<?php }else{ ?>

<form
method="POST"
enctype="multipart/form-data">

<input
type="hidden"
name="kegiatan_id"
value="<?php echo $row['id']; ?>">

<div class="mb-3">

<label class="fw-bold">
Nama Lengkap
</label>

<input
type="text"
class="form-control"
value="<?php echo $_SESSION['nama']; ?>"
readonly>

</div>

<div class="mb-3">

<label class="fw-bold">
NIM
</label>

<input
type="text"
name="nim"
class="form-control"
required>

</div>

<div class="mb-3">

<label class="fw-bold">
Jurusan
</label>

<input
type="text"
name="jurusan"
class="form-control"
required>

</div>

<div class="mb-3">

<label class="fw-bold">
Divisi
</label>

<input
type="text"
class="form-control"
value="<?php echo $_SESSION['divisi']; ?>"
readonly>

</div>

<div class="mb-3">

<label class="fw-bold">
Pesan & Kesan
</label>

<textarea
name="pesan_kesan"
class="form-control"
rows="4"
placeholder="Tuliskan kesan setelah mengikuti kegiatan..."
required></textarea>

</div>

<div class="upload-box">

<label class="fw-bold">

<i class="fa-solid fa-camera"></i>

Upload Bukti Kehadiran

</label>

<input
type="file"
name="foto"
class="form-control"
accept="image/*"
required
onchange="previewImage(event,<?php echo $row['id']; ?>)">

<img
id="preview<?php echo $row['id']; ?>"
class="preview">

</div>

<button
type="submit"
name="absen"
class="btn btn-success w-100 mt-4">

<i class="fa-solid fa-paper-plane"></i>

Kirim Absensi

</button>

</form>

<?php } ?>

</div>

</div>

<?php

}

}
?>
<a
href="dashboard.php"
class="btn btn-secondary">

<i class="fa-solid fa-arrow-left"></i>

Kembali

</a>

</div>

<script>

function previewImage(event,id){

    let preview =
    document.getElementById(
        'preview'+id
    );

    preview.src =
    URL.createObjectURL(
        event.target.files[0]
    );

    preview.style.display =
    'block';

}

</script>

</body>
</html>