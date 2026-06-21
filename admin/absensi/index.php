<?php

session_start();

include '../../config/koneksi.php';

if(!isset($_SESSION['login'])){
    header("Location:../login.php");
    exit();
}

$data = mysqli_query($conn,
"SELECT * FROM kegiatan_absensi
ORDER BY id DESC");

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Absensi</title>

    <!-- BOOTSTRAP & ICONS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <!-- GOOGLE FONT POPPINS -->
    <link href="https://googleapis.com" rel="stylesheet">

        <style>
        *{
            font-family: 'Poppins', sans-serif;
        }

        body{
            background:#f4f7fe;
            color: #2b3674;
        }

        .page-header{
            background: linear-gradient(135deg, #001F54, #004AAD);
            color:white;
            padding:35px;
            border-radius:24px;
            margin-bottom:25px;
            box-shadow: 0 10px 30px rgba(0,74,173,.15);
        }

        .table-card {
            background: white;
            border-radius: 24px;
            padding: 25px;
            box-shadow: 0 10px 25px rgba(0,0,0,.03);
            border: none;
        }

        .table{
            vertical-align:middle;
            margin-bottom: 0;
        }

        /* PERBAIKAN: Hapus !important di sini agar bisa ditimpa saat dark mode aktif */
        .table th {
            font-weight: 600;
            background-color: #f7f9fc;
            color: #a3aed0;
            border-bottom: 1px solid #e9edf7;
            padding: 15px 10px;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .table td {
            padding: 15px 10px;
            border-bottom: 1px solid #e9edf7;
            color: #2b3674;
            font-weight: 500;
            font-size: 15px;
        }

        .btn-custom {
            border-radius: 14px;
            padding: 10px 20px;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .btn-custom:hover {
            transform: translateY(-2px);
        }

        .btn-action{
            border-radius: 10px;
            width: 34px;
            height: 34px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0;
        }

        .badge-status {
            padding: 6px 12px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 13px;
        }

        .badge-buka{
            background-color: #d1fae5 !important;
            color: #065f46 !important;
        }

        .badge-tutup{
            background-color: #fee2e2 !important;
            color: #991b1b !important;
        }

        .aksi-group {
            display: flex;
            gap: 6px;
        }

        @media (max-width:768px){
            .page-header{ padding:25px 20px; border-radius: 18px; }
            .page-header h2{ font-size:20px; }
            .page-header p { font-size: 14px; }
            .table-card { padding: 15px; border-radius: 18px; }
            .action-top-group { display: flex; gap: 10px; }
            .action-top-group .btn-custom { flex: 1; padding: 12px 10px; font-size: 13px; text-align: center; justify-content: center; }
            .col-no { display: none; }
            .table th, .table td { padding: 12px 8px; font-size: 14px; }
        }

        /* ===================================================
           KODE FIX PREMIUM MODE MALAM (DIPERKUAT DENGAN BODY.DARK-MODE)
           =================================================== */

        /* 1. Latar Belakang Utama */
        body.dark-mode {
            background-color: #0f172a !important; 
            background: #0f172a !important; 
            color: #f8fafc !important;
        }

        /* 2. Mengubah Kotak Putih Tempat Tabel Menjadi Abu Gelap */
        body.dark-mode .table-card {
            background-color: #1e293b !important;
            background: #1e293b !important;
            border: 1px solid #334155 !important;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3) !important;
        }

        /* 3. Menghancurkan Kuncian Warna Putih Pada Baris Judul Tabel (TH) */
        body.dark-mode table.table th {
            background-color: #1e293b !important;
            background: #1e293b !important;
            color: #94a3b8 !important;
            border-bottom: 2px solid #334155 !important;
        }

        /* 4. Menghancurkan Kuncian Warna Biru Pada Kolom Isi Tabel (TD) */
        body.dark-mode table.table td {
            background-color: #1e293b !important;
            background: #1e293b !important;
            color: #e2e8f0 !important;
            border-bottom: 1px solid #334155 !important;
        }

        /* 5. Teks-Teks Tambahan */
        body.dark-mode small.text-muted,
        body.dark-mode table.table td small {
            color: #94a3b8 !important; 
        }

        body.dark-mode .page-header h2 {
            color: #ffffff !important;
        }
    </style>
</head>
<body>

<!-- 1. SCRIPT DETEKSI TEMA INSTAN (Langsung mengubah warna element secara paksa) -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        if (localStorage.getItem('theme') === 'dark') {
            document.body.style.setProperty('background-color', '#0f172a', 'important');
            document.body.style.setProperty('color', '#f8fafc', 'important');
            
            // Ubah warna card tabel
            const tableCard = document.querySelector('.table-card');
            if(tableCard) {
                tableCard.style.setProperty('background-color', '#1e293b', 'important');
                tableCard.style.setProperty('border', '1px solid #334155', 'important');
            }

            // Ubah semua baris tabel (Th dan Td)
            const tableRows = document.querySelectorAll('table.table th, table.table td');
            tableRows.forEach(el => {
                el.style.setProperty('background-color', '#1e293b', 'important');
                el.style.setProperty('color', '#e2e8f0', 'important');
                el.style.setProperty('border-color', '#334155', 'important');
            });

            // Ubah teks kecil nama kegiatan dan tanggal
            const textMuted = document.querySelectorAll('.text-muted, small');
            textMuted.forEach(el => {
                el.style.setProperty('color', '#94a3b8', 'important');
            });
        }
    });
</script>

<div class="container py-4 py-md-5">

    <!-- ALERT SAKTI UNTUK NOTIFIKASI -->
    <?php if(isset($_SESSION['success'])){ ?>
        <div class="alert alert-success border-0 shadow-sm mb-4" style="border-radius: 14px;">
            <i class="bi bi-check-circle-fill me-2"></i> <?= $_SESSION['success']; unset($_SESSION['success']); ?>
        </div>
    <?php } ?>

    <!-- HEADER -->
    <div class="page-header">
        <h2><i class="bi bi-clipboard-check"></i> Kelola Absensi GENBI</h2>
        <p class="mb-0 text-white-50">Kelola kegiatan dan absensi anggota</p>
    </div>

    <!-- BUTTON TOP GROUP -->
    <div class="mb-4 action-top-group">
        <a href="../dashboard.php" class="btn btn-light text-primary btn-custom d-inline-flex align-items-center gap-2">
            <i class="bi bi-arrow-left"></i> <span>Dashboard</span>
        </a>
        <a href="tambah.php" class="btn btn-success btn-custom d-inline-flex align-items-center gap-2">
            <i class="bi bi-plus-circle"></i> <span>Buat Absensi</span>
        </a>
    </div>

    <!-- MAIN CARD TABLE -->
    <div class="table-card">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th class="col-no">No</th>
                        <th>Nama Kegiatan</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    while($row = mysqli_fetch_assoc($data)){
                    ?>
                    <tr>
                        <td class="col-no"><?= $no++; ?></td>
                        <td>
                            <span class="d-block fw-semibold"><?= htmlspecialchars($row['nama_kegiatan']); ?></span>
                        </td>
                        <td><small class="text-muted"><?= htmlspecialchars($row['tanggal']); ?></small></td>
                        <td>
                            <?php if($row['status'] == "Buka"){ ?>
                                <span class="badge badge-status badge-buka">Buka</span>
                            <?php } else { ?>
                                <span class="badge badge-status badge-tutup">Tutup</span>
                            <?php } ?>
                        </td>
                        <td>
                            <div class="aksi-group">
                                <!-- TOMBOL TOGGLE STATUS BARU -->
                                <?php if($row['status'] == "Buka"){ ?>
                                    <a href="status.php?id=<?= $row['id']; ?>&set=Tutup" class="btn btn-secondary btn-sm btn-action" title="Tutup Absensi">
                                        <i class="bi bi-lock-fill"></i>
                                    </a>
                                <?php } else { ?>
                                    <a href="status.php?id=<?= $row['id']; ?>&set=Buka" class="btn btn-success btn-sm btn-action" title="Buka Absensi">
                                        <i class="bi bi-unlock-fill"></i>
                                    </a>
                                <?php } ?>

                                <a href="peserta.php?id=<?= $row['id']; ?>" class="btn btn-info text-white btn-sm btn-action" title="Lihat Peserta">
                                    <i class="bi bi-people-fill"></i>
                                </a>
                                <a href="edit.php?id=<?= $row['id']; ?>" class="btn btn-warning text-white btn-sm btn-action" title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <a
                                href="hapus.php?id=<?= $row['id']; ?>"
                                class="btn btn-danger btn-sm btn-action btn-hapus"
                                title="Hapus">

                                <i class="bi bi-trash"></i>

                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<script>

document.addEventListener('DOMContentLoaded', function(){

    if(
        localStorage.getItem('darkMode')
        === 'enabled'
    ){

        document.body.classList.add(
            'dark-mode'
        );

    }

});

</script>

<!-- TARUH INI DI BAGIAN PALING BAWAH FILE INDEX.PHP (DAFTAR KEGIATAN) -->
<?php if(isset($_SESSION['success_sweet'])){ ?>
    <script>
        Swal.fire({
            title: 'Berhasil!',
            text: '<?php echo $_SESSION['success_sweet']; ?>',
            icon: 'success',
            confirmButtonColor: '#004AAD',
            timer: 2500,
            timerProgressBar: true
        });
    </script>
<?php 
    // Hapus session agar tidak muncul terus-menerus saat di-refresh
    unset($_SESSION['success_sweet']); 
} 
?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

document.querySelectorAll('.btn-hapus').forEach(button => {

    button.addEventListener('click', function(e){

        e.preventDefault();

        const url = this.getAttribute('href');

        Swal.fire({

            title: 'Hapus Data?',
            text: 'Data yang dihapus tidak dapat dikembalikan lagi!',
            icon: 'warning',

            showCancelButton: true,

            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',

            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',

            reverseButtons: true

        }).then((result) => {

            if(result.isConfirmed){

                Swal.fire({

                    title: 'Menghapus...',
                    text: 'Mohon tunggu sebentar',
                    allowOutsideClick: false,

                    didOpen: () => {
                        Swal.showLoading();
                    }

                });

                window.location.href = url;

            }

        });

    });

});

</script>

</body>

</html>

