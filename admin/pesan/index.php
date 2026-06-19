<?php

session_start();
include '../../config/koneksi.php';

if(!isset($_SESSION['login'])){
    header("Location: ../login.php");
    exit();
}

$query = mysqli_query(
    $conn,
    "SELECT * FROM pesan_kesan ORDER BY id ASC"
);

?>

<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Pesan & Kesan</title>

<link
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">

<link
rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<link
rel="stylesheet"
href="../../assets/css/style.css">

<style>

body{
    background:#f4f7fe;
    font-family:'Poppins',sans-serif;
}

.page-header{

    background:linear-gradient(
        135deg,
        #002B7F,
        #0A4DA2
    );

    border-radius:35px;

    padding:50px;

    color:white;

    margin-bottom:40px;

    position:relative;

    overflow:hidden;
}

.page-header::after{

    content:'';

    position:absolute;

    width:220px;
    height:220px;

    border-radius:50%;

    background:rgba(255,255,255,.08);

    right:-40px;
    top:-40px;
}

.table-wrapper{

    background:white;

    border-radius:30px;

    padding:35px;

    box-shadow:
    0 12px 30px rgba(0,0,0,.06);
}

.table thead{

    background:#0A3278;

    color:white;
}

.table thead th{

    padding:18px;

    border:none;
}

.table tbody td{

    padding:20px 18px;

    vertical-align:middle;
}

.btn-back{

    background:white;

    color:#0A3278;

    border-radius:50px;

    padding:12px 28px;

    font-weight:600;

    text-decoration:none;
}

.btn-back:hover{

    background:#f3f4f6;
}

/* ===================================================
   PERBAIKAN FITUR MODE MALAM HALAMAN PESAN & KESAN
   =================================================== */

body.dark-mode {
    background: #0f172a !important;
    color: #f8fafc !important;
}

/* 1. Memaksa Kotak Pembungkus Tabel Menjadi Abu-Abu Gelap */
body.dark-mode .table-wrapper {
    background: #1e293b !important;
    border: 1px solid #334155 !important;
    box-shadow: 0 12px 30px rgba(0, 0, 0, 0.3) !important;
}

/* 2. Mengatur Warna Baris Judul Tabel (Thead) di Layar Gelap */
body.dark-mode .table thead {
    background: #0f172a !important;
}

body.dark-mode .table thead th {
    background-color: #0f172a !important;
    color: #94a3b8 !important;
    border-bottom: 2px solid #334155 !important;
}

/* 3. Menghancurkan Kuncian Teks Putih Pada Latar Belakang Terang */
body.dark-mode .table tbody tr td {
    background-color: #1e293b !important;
    color: #e2e8f0 !important;
    border-bottom: 1px solid #334155 !important;
}

/* 4. Menyesuaikan Teks Utama Judul Halaman Saja */
body.dark-mode h1,
body.dark-mode h2,
body.dark-mode h3,
body.dark-mode p {
    color: #ffffff !important;
}

/* 5. Perbaikan Teks Tanggal yang Menggunakan Class .text-muted */
body.dark-mode .table tbody td.text-muted,
body.dark-mode .table tbody td.text-muted i {
    color: #94a3b8 !important;
}

</style>

</head>
<body>

<div class="container py-5">

    <!-- HEADER -->
    <div class="page-header">

        <h1 class="fw-bold mb-2">
            Pesan & Kesan Masuk
        </h1>

        <p class="mb-4 fs-5">
            Kelola seluruh pesan dari pengunjung website GENBI UIN SSC
        </p>

        <a
        href="../dashboard.php"
        class="btn-back">

            <i class="fa-solid fa-arrow-left me-2"></i>

            Dashboard

        </a>

    </div>

    <!-- TABLE -->
    <div class="table-wrapper">

        <table class="table align-middle">

            <thead>

<tr>

    <th width="80">
        No
    </th>

    <th>
        Nama
    </th>

    <th>
        Pesan
    </th>

    <th width="220">
        Tanggal
    </th>

    <th width="120">
        Aksi
    </th>

</tr>

</thead>

            <tbody>

                <?php $no=1; ?>

                <?php while($row=mysqli_fetch_array($query)){ ?>

                <tr>

                    <td>
                        <?php echo $no++; ?>
                    </td>

                    <td class="fw-semibold">
                        <?php echo $row['nama']; ?>
                    </td>

                    <td>
                        <?php echo $row['pesan']; ?>
                    </td>

                    <td class="text-muted">
                        <i class="fa-regular fa-calendar me-2"></i>
                        <?php echo $row['tanggal']; ?>
                    </td>

                    <td>

   <a
href="hapus.php?id=<?php echo $row['id']; ?>"
class="btn btn-danger btn-sm btn-hapus">

    <i class="fa-solid fa-trash"></i>

</a>
                </tr>

                <?php } ?>

            </tbody>

        </table>

    </div>

</div>

<script src="../assets/js/darkmode.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

document.querySelectorAll('.btn-hapus').forEach(button => {

    button.addEventListener('click', function(e){

        e.preventDefault();

        let url = this.getAttribute('href');

        Swal.fire({

            title: 'Hapus Pesan?',
            text: 'Data yang dihapus tidak dapat dikembalikan.',
            icon: 'warning',

            showCancelButton: true,

            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',

            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'

        }).then((result) => {

            if(result.isConfirmed){

                window.location.href = url;

            }

        });

    });

});

</script>

<?php if(isset($_GET['hapus'])){ ?>

<script>

document.addEventListener("DOMContentLoaded", function(){

    Swal.fire({

        icon:'success',

        title:'Berhasil!',

        text:'Pesan berhasil dihapus.',

        showConfirmButton:false,

        timer:2000

    });

});

</script>

<?php } ?>

</body>
</html>