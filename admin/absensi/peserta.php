<?php

session_start();

include '../../config/koneksi.php';

if(!isset($_SESSION['login'])){
    header("Location: ../login.php");
    exit();
}

if(!isset($_GET['id'])){
    header("Location: index.php");
    exit();
}

$id = (int)$_GET['id'];

/* =========================
   DATA KEGIATAN
========================= */

$kegiatan = mysqli_query(
    $conn,
    "SELECT *
    FROM kegiatan_absensi
    WHERE id='$id'"
);

$dataKegiatan = mysqli_fetch_assoc($kegiatan);

/* Jika kegiatan tidak ditemukan */
if(!$dataKegiatan){

    echo "
    <script>
        alert('Kegiatan tidak ditemukan!');
        window.location='index.php';
    </script>
    ";

    exit();
}

/* =========================
   TOTAL PESERTA
========================= */

$totalPeserta = mysqli_fetch_assoc(

    mysqli_query(

        $conn,

        "SELECT COUNT(*) AS total
        FROM absensi
        WHERE kegiatan_id='$id'"

    )

)['total'];

/* =========================
   DATA PESERTA
========================= */

$peserta = mysqli_query(
    $conn,
    "SELECT
    absensi.*,
    anggota.nama,
    anggota.divisi,
    anggota.nim,
    anggota.jurusan

    FROM absensi

    JOIN anggota
    ON absensi.anggota_id = anggota.id

    WHERE absensi.kegiatan_id='$id'

    ORDER BY absensi.waktu_absen ASC"
);

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peserta Absensi</title>

    <!-- BOOTSTRAP, FONT AWESOME, POPPINS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

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

        .card-custom{
            background:white;
            border:none;
            border-radius:24px;
            padding:10px;
            box-shadow: 0 10px 25px rgba(0,0,0,.03);
        }

        .table{
            vertical-align:middle;
            margin-bottom: 0;
        }

        /* Memberikan batas minimal lebar tabel di HP agar kolom tidak saling berhimpitan */
        @media (max-width: 768px) {
            .table {
                min-width: 600px; 
            }
        }

        .table th {
            font-weight: 600;
            background-color: #f7f9fc !important;
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

        .foto-bukti{
            width:55px;
            height:55px;
            object-fit:cover;
            border-radius:12px;
            border: 2px solid #fff;
            box-shadow: 0 4px 10px rgba(0,0,0,0.08);
            transition: transform 0.2s ease;
        }

        .foto-bukti:hover {
            transform: scale(1.08);
        }

        .btn-custom {
            border-radius: 14px;
            padding: 10px 24px;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .btn-custom:hover {
            transform: translateY(-2px);
        }

        /* RESPONSIVE MOBILE AREA */
        @media (max-width:768px){
            .page-header{
                padding:25px 20px;
                border-radius: 18px;
            }

            .page-header h2{ font-size:20px; }
            .page-header h5{ font-size:16px; }

            .card-custom {
                border-radius: 18px;
            }

            .card-body {
                padding: 15px !important;
            }

            /* Cukup sembunyikan No saja agar hemat ruang utama */
            .col-no {
                display: none;
            }

            .table th, .table td {
                padding: 12px 8px;
                font-size: 14px;
            }

            .foto-bukti {
                width: 48px;
                height: 48px;
                border-radius: 8px;
            }
        }

       /* --- BASE UTAMA UNTUK TOMBOL (DESKTOP) --- */
.area-tombol-aksi {
    display: flex !important;
    flex-direction: row;
    gap: 12px !important;
    width: 100% !important;
}

.btn-back-premium, .btn-success {
    font-weight: 600 !important;
    font-size: 14px !important;
    text-decoration: none !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    border-radius: 14px !important;
    padding: 12px 28px !important;
    transition: all 0.3s ease !important;
}

.btn-back-premium {
    background: #f1f5f9 !important;
    color: #31765d !important;
    border: 1px solid #e2e8f0 !important;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.02) !important;
}

.btn-back-premium:hover {
    background: #e2e8f0 !important;
    color: #1e293b !important;
    transform: translateY(-2px) !important;
}

.btn-success {
    background: #198754 !important;
    color: #ffffff !important;
    border: 1px solid #157347 !important;
    box-shadow: 0 2px 6px rgba(25, 135, 84, 0.2) !important;
}

.btn-success:hover {
    background: #157347 !important;
    transform: translateY(-2px) !important;
    box-shadow: 0 4px 12px rgba(25, 135, 84, 0.3) !important;
}

/* --- RESPONSIVE KHUSUS LAYAR HP (DI BAWAH 768px) --- */
@media (max-width: 768px) {
    .area-tombol-aksi {
        flex-direction: column !important; /* Memaksa tombol turun kebawah */
        gap: 10px !important;
    }
    
    .btn-back-premium, .btn-success {
        width: 100% !important; /* Memaksa selebar layar HP */
        padding: 14px !important;
        border-radius: 16px !important;
        font-size: 15px !important;
    }
}

.action-top-group{
    display:flex;
    gap:15px;
    margin-bottom:25px;
}

.btn-nav{
    flex:1;
    text-decoration:none;
    display:flex;
    align-items:center;
    gap:15px;
    padding:16px 20px;
    border-radius:20px;
    color:white;
    transition:.3s ease;
    position:relative;
    overflow:hidden;
    box-shadow:0 8px 25px rgba(0,0,0,.12);
}

.btn-nav::before{
    content:'';
    position:absolute;
    top:0;
    left:-100%;
    width:100%;
    height:100%;
    background:rgba(255,255,255,.15);
    transition:.5s;
}

.btn-nav:hover::before{
    left:100%;
}

.btn-nav:hover{
    transform:translateY(-4px);
}

.btn-nav i{
    font-size:32px;
}

.btn-nav div{
    display:flex;
    flex-direction:column;
}

.btn-nav small{
    opacity:.8;
    font-size:12px;
}

.btn-nav span{
    font-size:16px;
    font-weight:700;
}

/* Tombol Dashboard */
.btn-back{
    background:linear-gradient(135deg,#001F54,#004AAD);
}

/* Tombol Export */
.btn-export{
    background:linear-gradient(135deg,#198754,#20c997);
}

/* Mobile */
@media(max-width:768px){

    .action-top-group{
        flex-direction:column;
    }

    .btn-nav{
        width:100%;
        padding:15px;
    }

    .btn-nav i{
        font-size:28px;
    }

    .btn-nav span{
        font-size:15px;
    }
}

.stat-card{

    background:white;

    border-radius:20px;

    padding:25px;

    text-align:center;

    box-shadow:
    0 10px 25px rgba(0,0,0,.05);

}

.stat-card h2{

    font-size:40px;

    font-weight:700;

    color:#001F54;

}

.foto-bukti{

    width:60px;
    height:60px;

    object-fit:cover;

    border-radius:12px;

    transition:.3s;
}

.foto-bukti:hover{

    transform:scale(1.08);

}

.modal-content{

    border-radius:20px;

    border:none;

}
    </style>
</head>
<body>

<div class="container py-4 py-md-5">

    <!-- HEADER INFORMASI KEGIATAN -->
    <div class="page-header">
        <h2 class="mb-2">
            <i class="fa-solid fa-users text-white-50 me-2"></i> Peserta Absensi
        </h2>
        <h5 class="fw-semibold mb-1"><?php echo htmlspecialchars($dataKegiatan['nama_kegiatan']); ?></h5>
        <p class="mb-0 text-white-50"><i class="fa-regular fa-calendar me-1"></i> <?php echo htmlspecialchars($dataKegiatan['tanggal']); ?></p>
    </div>

    <!-- MAIN CARD TABLE -->
<div class="card card-custom">
    <div class="card-body p-3 p-md-4">

        <!-- table-responsive murni tanpa paksaan min-width -->
        <div class="table-responsive mb-4" style="overflow-x: auto; -webkit-overflow-scrolling: touch;">
            <table class="table" style="min-width: 100%;">
                <thead>

                <tr>

                <th>Nama</th>

                <th>NIM</th>

                <th>Jurusan</th>

                <th>Divisi</th>

                <th>Pesan & Kesan</th>

                <th>Foto</th>

                <th>Waktu</th>

                </tr>

                </thead>
                <tbody>

<?php if(mysqli_num_rows($peserta) > 0){ ?>

    <?php while($row = mysqli_fetch_assoc($peserta)){ ?>

    <tr>

        <td>
            <?= htmlspecialchars($row['nama'] ?? '-'); ?>
        </td>

        <td>
            <?= htmlspecialchars($row['nim'] ?? '-'); ?>
        </td>

        <td>
            <?= htmlspecialchars($row['jurusan'] ?? '-'); ?>
        </td>

        <td>
            <span class="badge bg-light text-secondary border">
                <?= htmlspecialchars($row['divisi'] ?? '-'); ?>
            </span>
        </td>

        <td>

            <?php if(!empty($row['pesan_kesan'])){ ?>

            <button
                class="btn btn-info btn-sm"
                data-bs-toggle="modal"
                data-bs-target="#modal<?= $row['id']; ?>">

                <i class="bi bi-chat-left-text"></i>
                Lihat

            </button>

            <?php } else { ?>

            <span class="badge bg-secondary">
                Tidak Ada
            </span>

            <?php } ?>

        </td>

        <td>

            <?php if(!empty($row['foto'])){ ?>

            <a
                href="../../assets/upload_absensi/<?= $row['foto']; ?>"
                target="_blank">

                <img
                    src="../../assets/upload_absensi/<?= $row['foto']; ?>"
                    class="foto-bukti"
                    alt="Foto Bukti">

            </a>

            <?php } else { ?>

            <span class="text-muted">
                Tidak ada foto
            </span>

            <?php } ?>

        </td>

        <td>
            <?= htmlspecialchars($row['waktu_absen'] ?? '-'); ?>
        </td>

    </tr>

    <!-- MODAL PESAN KESAN -->

    <div
        class="modal fade"
        id="modal<?= $row['id']; ?>"
        tabindex="-1">

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content">

                <div class="modal-header bg-primary text-white">

                    <h5 class="modal-title">

                        <i class="bi bi-chat-left-text-fill me-2"></i>
                        Pesan & Kesan Peserta

                    </h5>

                    <button
                        type="button"
                        class="btn-close btn-close-white"
                        data-bs-dismiss="modal">
                    </button>

                </div>

                <div class="modal-body">

                    <div class="mb-2">

                        <strong>Nama :</strong>
                        <?= htmlspecialchars($row['nama'] ?? '-'); ?>

                    </div>

                    <hr>

                    <p style="white-space:pre-line;">

                        <?= htmlspecialchars($row['pesan_kesan'] ?? 'Belum ada pesan & kesan.'); ?>

                    </p>

                </div>

            </div>

        </div>

    </div>

    <?php } ?>

<?php } else { ?>

<tr>

    <td colspan="7" class="text-center text-muted py-5">

        <i
            class="bi bi-inbox"
            style="font-size:40px;display:block;margin-bottom:10px;">
        </i>

        Belum ada peserta yang melakukan absensi.

    </td>

</tr>

<?php } ?>

</tbody>

            </table>
        </div>

        <!-- TOMBOL KEMBALI DAN EXCEL (GAYA LANGSUNG / INLINE CSS) -->
<div class="action-top-group">

    <a href="hapus.php" class="btn-nav btn-back">
        <i class="bi bi-arrow-left-circle-fill"></i>

        <div class="text-group">
            <span class="title">Dashboard</span>
            <span class="subtitle">Kembali ke halaman utama</span>
        </div>
    </a>

    <a href="export_excel.php?id=<?= $id ?>" class="btn-nav btn-export">
        <i class="bi bi-file-earmark-excel-fill"></i>

        <div class="text-group">
            <span class="title">Export Excel</span>
            <span class="subtitle">Download laporan absensi</span>
        </div>
    </a>

</div>

</div>

<script>

document
.getElementById('searchInput')
.addEventListener('keyup', function(){

let value =
this.value.toLowerCase();

let rows =
document.querySelectorAll(
'tbody tr'
);

rows.forEach(row=>{

row.style.display =
row.innerText
.toLowerCase()
.includes(value)

? ''

: 'none';

});

});

</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

