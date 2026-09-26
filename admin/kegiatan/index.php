<?php
session_start();
include '../../config/koneksi.php';

if(!isset($_SESSION['login'])){
    header("Location: ../login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Data Kegiatan - GENBI</title>

<!-- BOOTSTRAP -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- FONT AWESOME -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<!-- GOOGLE FONT -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<!-- SWEETALERT2 -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

<style>
    :root {
        --primary: #004AAD;
        --secondary: #001F54;
        --bg-color: #f4f7fe;
        --card-bg: #ffffff;
        --text-dark: #1e293b;
        --text-muted: #64748b;
        --border-color: #e2e8f0;
    }

    /* DARK MODE VARIABLES */
    body.dark-mode {
        --bg-color: #0f172a;
        --card-bg: #1e293b;
        --text-dark: #f8fafc;
        --text-muted: #94a3b8;
        --border-color: #334155;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Poppins', sans-serif;
    }

    body {
        background: var(--bg-color);
        min-height: 100vh;
        color: var(--text-dark);
        transition: background 0.3s ease, color 0.3s ease;
    }

    .container-custom {
        padding: 40px;
        max-width: 1200px;
        margin: auto;
    }

    /* =========================
       ANIMATION
    ========================= */
    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* =========================
       HEADER
    ========================= */
    .page-header {
        background: linear-gradient(135deg, var(--secondary) 0%, var(--primary) 100%);
        border-radius: 24px;
        padding: 40px 45px;
        color: white;
        margin-bottom: 40px;
        position: relative;
        overflow: hidden;
        box-shadow: 0 15px 35px rgba(0, 74, 173, 0.2);
        animation: fadeUp 0.6s ease-out;
    }

    .page-header::before {
        content: "";
        position: absolute;
        width: 300px;
        height: 300px;
        background: rgba(255, 255, 255, 0.08);
        border-radius: 50%;
        top: -100px;
        right: -80px;
        backdrop-filter: blur(5px);
    }

    .page-header h1 {
        font-size: 36px;
        font-weight: 700;
        margin-bottom: 8px;
        position: relative;
        z-index: 2;
        letter-spacing: -0.5px;
    }

    .page-header p {
        color: rgba(255, 255, 255, 0.85);
        margin: 0;
        font-size: 15px;
        position: relative;
        z-index: 2;
    }

    /* =========================
       BUTTONS
    ========================= */
    .header-buttons {
        margin-top: 30px;
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
        position: relative;
        z-index: 2;
    }

    .btn-custom {
        border: none;
        padding: 12px 24px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 14px;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.05);
    }

    .btn-dashboard {
        background: white;
        color: var(--secondary);
    }

    .btn-dashboard:hover {
        background: #f8fafc;
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }

    .btn-add {
        background: #10b981;
        color: white;
    }

    .btn-add:hover {
        background: #059669;
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(16, 185, 129, 0.3);
        color: white;
    }

    /* =========================
       TABLE CARD
    ========================= */
    .table-card {
        background: var(--card-bg);
        border-radius: 24px;
        padding: 30px;
        box-shadow: 0 15px 35px rgba(0,0,0,0.03);
        animation: fadeUp 0.6s ease-out 0.1s both;
        transition: background 0.3s ease;
    }

    .table-responsive {
        border-radius: 16px;
        overflow: hidden;
    }

    /* =========================
       TABLE
    ========================= */
    .table {
        margin-bottom: 0;
        vertical-align: middle;
        color: var(--text-dark);
    }

    .table thead {
        background: var(--secondary);
        color: white;
    }

    .table thead th {
        border: none;
        padding: 18px 20px;
        font-size: 14px;
        font-weight: 600;
        letter-spacing: 0.5px;
        text-transform: uppercase;
    }

    .table tbody tr {
        transition: all 0.2s ease;
        border-bottom: 1px solid var(--border-color);
    }

    .table tbody tr:last-child {
        border-bottom: none;
    }

    .table tbody tr:hover {
        background: rgba(0, 74, 173, 0.03);
    }

    body.dark-mode .table tbody tr:hover {
        background: rgba(255, 255, 255, 0.05);
    }

    .table tbody td {
        padding: 20px;
        border: none;
        background: transparent;
        color: inherit;
    }

    /* =========================
       IMAGE
    ========================= */
    .img-wrapper {
        position: relative;
        width: 120px;
        height: 80px;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    }

    .kegiatan-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .img-wrapper:hover .kegiatan-img {
        transform: scale(1.1);
    }

    /* =========================
       TEXT ELEMENTS
    ========================= */
    .judul-kegiatan {
        font-weight: 600;
        font-size: 16px;
        margin-bottom: 5px;
    }

    .info-text {
        color: var(--text-muted);
        font-size: 14px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .info-text i {
        color: var(--primary);
    }

    body.dark-mode .info-text i {
        color: #60a5fa;
    }

    /* =========================
       ACTION BUTTONS
    ========================= */
    .action-buttons {
        display: flex;
        gap: 10px;
    }

    .btn-action {
        border: none;
        padding: 10px 16px;
        border-radius: 12px;
        font-size: 13px;
        font-weight: 600;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        text-decoration: none;
    }

    .btn-edit {
        background: #fef08a;
        color: #854d0e;
    }

    .btn-edit:hover {
        background: #fde047;
        color: #713f12;
        transform: translateY(-2px);
        box-shadow: 0 5px 10px rgba(250, 204, 21, 0.3);
    }

    .btn-delete {
        background: #fecaca;
        color: #991b1b;
    }

    .btn-delete:hover {
        background: #fca5a5;
        color: #7f1d1d;
        transform: translateY(-2px);
        box-shadow: 0 5px 10px rgba(239, 68, 68, 0.3);
    }

    /* =========================
       EMPTY DATA
    ========================= */
    .empty-data {
        text-align: center;
        padding: 60px 20px;
    }

    .empty-data-icon {
        width: 80px;
        height: 80px;
        background: #f1f5f9;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
    }

    body.dark-mode .empty-data-icon { background: #334155; }

    .empty-data-icon i {
        font-size: 40px;
        color: var(--text-muted);
    }

    .empty-data h4 {
        font-weight: 600;
        margin-bottom: 8px;
    }

    .empty-data p {
        color: var(--text-muted);
        font-size: 15px;
    }

    /* =========================
       RESPONSIVE
    ========================= */
    @media(max-width: 768px){
        .container-custom { padding: 20px; }
        .page-header { padding: 30px; }
        .page-header h1 { font-size: 28px; }
        .header-buttons { flex-direction: column; width: 100%; }
        .btn-custom { width: 100%; justify-content: center; }
        .table-card { padding: 20px 15px; }
        .action-buttons { flex-direction: column; }
    }
</style>
</head>
<body>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php if(isset($_SESSION['success'])): ?>
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: '<?php echo $_SESSION['success']; ?>',
        confirmButtonColor: '#004AAD',
        confirmButtonText: 'OK',
        borderRadius: '20px'
    });
</script>
<?php unset($_SESSION['success']); endif; ?>

<div class="container-custom">
    <!-- HEADER -->
    <div class="page-header">
        <h1>Kelola Kegiatan</h1>
        <p>Kelola seluruh kegiatan dan dokumentasi event GENBI UIN SSC</p>
        
        <div class="header-buttons">
            <a href="../dashboard.php" class="btn-custom btn-dashboard">
                <i class="fa-solid fa-arrow-left"></i> Dashboard
            </a>
            <a href="tambah.php" class="btn-custom btn-add">
                <i class="fa-solid fa-plus"></i> Tambah Kegiatan
            </a>
        </div>
    </div>

    <!-- TABLE CARD -->
    <div class="table-card">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th width="5%" class="text-center">No</th>
                        <th width="15%">Foto</th>
                        <th width="30%">Judul Kegiatan</th>
                        <th width="15%">Tanggal</th>
                        <th width="20%">Lokasi</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $query = mysqli_query($conn, "SELECT * FROM kegiatan ORDER BY id DESC");
                    
                    if(mysqli_num_rows($query) > 0){
                        while($data = mysqli_fetch_array($query)){
                    ?>
                    <tr>
                        <td class="text-center font-weight-bold"><?php echo $no++; ?></td>
                        
                        <!-- FOTO -->
                        <td>
                            <div class="img-wrapper">
                                <img src="../../assets/upload/kegiatan/<?php echo $data['gambar']; ?>" class="kegiatan-img" alt="<?php echo $data['judul']; ?>">
                            </div>
                        </td>

                        <!-- JUDUL -->
                        <td>
                            <div class="judul-kegiatan"><?php echo $data['judul']; ?></div>
                        </td>

                        <!-- TANGGAL -->
                        <td>
                            <div class="info-text">
                                <i class="fa-regular fa-calendar-days"></i>
                                <?php echo date('d M Y', strtotime($data['tanggal'])); ?>
                            </div>
                        </td>

                        <!-- LOKASI -->
                        <td>
                            <div class="info-text">
                                <i class="fa-solid fa-location-dot"></i>
                                <?php echo $data['lokasi']; ?>
                            </div>
                        </td>

                        <!-- AKSI -->
                        <td>
                            <div class="action-buttons">
                                <a href="edit.php?id=<?php echo $data['id']; ?>" class="btn-action btn-edit btn-edit-popup">
                                    <i class="fa-solid fa-pen"></i> Edit
                                </a>
                                <a href="hapus.php?id=<?php echo $data['id']; ?>" class="btn-action btn-delete btn-hapus">
                                    <i class="fa-solid fa-trash"></i> Hapus
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php
                        }
                    } else {
                    ?>
                    <tr>
                        <td colspan="6">
                            <div class="empty-data">
                                <div class="empty-data-icon">
                                    <i class="fa-regular fa-folder-open"></i>
                                </div>
                                <h4>Belum Ada Kegiatan</h4>
                                <p>Silakan klik tombol "Tambah Kegiatan" untuk mulai mencatat event.</p>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- SCRIPTS -->
<script>
document.querySelectorAll('.btn-hapus').forEach(button => {
    button.addEventListener('click', function(e){
        e.preventDefault();
        const link = this.getAttribute('href');
        
        Swal.fire({
            title: 'Hapus Kegiatan?',
            text: 'Data yang dihapus tidak bisa dikembalikan!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#64748b',
            confirmButtonText: '<i class="fa-solid fa-trash"></i> Ya, Hapus!',
            cancelButtonText: 'Batal',
            borderRadius: '20px'
        }).then((result) => {
            if(result.isConfirmed){
                window.location.href = link;
            }
        });
    });
});

document.querySelectorAll('.btn-edit-popup').forEach(button => {
    button.addEventListener('click', function(e){
        e.preventDefault();
        const link = this.getAttribute('href');
        
        Swal.fire({
            title: 'Edit Kegiatan',
            text: 'Masuk ke halaman edit kegiatan?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#eab308',
            cancelButtonColor: '#64748b',
            confirmButtonText: '<i class="fa-solid fa-pen"></i> Ya, Edit',
            cancelButtonText: 'Batal',
            borderRadius: '20px'
        }).then((result) => {
            if(result.isConfirmed){
                Swal.fire({
                    title: 'Membuka Editor...',
                    text: 'Mohon tunggu sebentar',
                    timer: 800,
                    showConfirmButton: false,
                    icon: 'success',
                    borderRadius: '20px'
                });
                setTimeout(() => {
                    window.location.href = link;
                }, 800);
            }
        });
    });
});
</script>

<!-- Dark Mode Script (Pastikan path file ini benar sesuai direktori Anda) -->
<script src="../assets/js/darkmode.js"></script>

</body>
</html>