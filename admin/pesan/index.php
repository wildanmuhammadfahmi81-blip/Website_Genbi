<?php
session_start();
include '../../config/koneksi.php';

if(!isset($_SESSION['login'])){
    header("Location: ../login.php");
    exit();
}

// Mengubah menjadi DESC agar pesan terbaru muncul paling atas
$query = mysqli_query($conn, "SELECT * FROM pesan_kesan ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Pesan & Kesan - GENBI</title>

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
        color: var(--text-dark);
        min-height: 100vh;
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
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 20px;
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

    .header-content {
        position: relative;
        z-index: 2;
    }

    .page-header h1 {
        font-size: 32px;
        font-weight: 700;
        margin-bottom: 8px;
        letter-spacing: -0.5px;
    }

    .page-header p {
        color: rgba(255, 255, 255, 0.85);
        margin: 0;
        font-size: 15px;
    }

    .btn-dashboard {
        background: white;
        color: var(--secondary);
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
        position: relative;
        z-index: 2;
        box-shadow: 0 4px 6px rgba(0,0,0,0.05);
    }

    .btn-dashboard:hover {
        background: #f8fafc;
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        color: var(--secondary);
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
       TABLE STYLING
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

    /* USER INFO LAYOUT */
    .user-profile {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .user-avatar {
        width: 45px;
        height: 45px;
        background: rgba(0, 74, 173, 0.1);
        color: var(--primary);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 18px;
    }

    body.dark-mode .user-avatar {
        background: rgba(96, 165, 250, 0.15);
        color: #60a5fa;
    }

    .user-name {
        font-weight: 600;
        font-size: 15px;
        color: var(--text-dark);
    }

    .message-text {
        color: var(--text-muted);
        font-size: 14px;
        line-height: 1.6;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .date-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: var(--bg-color);
        padding: 8px 15px;
        border-radius: 50px;
        font-size: 13px;
        color: var(--text-muted);
        font-weight: 500;
        border: 1px solid var(--border-color);
    }

    /* =========================
       ACTION BUTTONS
    ========================= */
    .btn-delete {
        background: #fee2e2;
        color: #991b1b;
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

    body.dark-mode .btn-delete {
        background: rgba(239, 68, 68, 0.15);
        color: #fca5a5;
    }

    .btn-delete:hover {
        background: #fecaca;
        transform: translateY(-2px);
        box-shadow: 0 5px 10px rgba(239, 68, 68, 0.2);
        color: #7f1d1d;
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
        font-size: 35px;
        color: var(--text-muted);
    }

    .empty-data h4 { font-weight: 600; margin-bottom: 8px; }
    .empty-data p { color: var(--text-muted); font-size: 15px; }

    /* =========================
       RESPONSIVE
    ========================= */
    @media(max-width: 768px){
        .container-custom { padding: 20px; }
        .page-header { padding: 30px; flex-direction: column; text-align: center; }
        .page-header h1 { font-size: 26px; }
        .btn-dashboard { width: 100%; justify-content: center; }
        .table-card { padding: 20px 15px; }
        
        /* Penyesuaian agar tabel bisa di-scroll di HP */
        .table-responsive { overflow-x: auto; -webkit-overflow-scrolling: touch; }
        .table { min-width: 700px; }
    }
</style>
</head>
<body>

<div class="container-custom">

    <!-- HEADER -->
    <div class="page-header">
        <div class="header-content">
            <h1>Pesan & Kesan Masuk</h1>
            <p>Kelola seluruh pesan dan *feedback* dari pengunjung website GENBI</p>
        </div>
        <a href="../dashboard.php" class="btn-dashboard">
            <i class="fa-solid fa-arrow-left"></i> Dashboard
        </a>
    </div>

    <!-- TABLE CARD -->
    <div class="table-card">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th width="5%" class="text-center">No</th>
                        <th width="25%">Pengirim</th>
                        <th width="40%">Isi Pesan</th>
                        <th width="20%">Tanggal</th>
                        <th width="10%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    if(mysqli_num_rows($query) > 0) {
                        while($row = mysqli_fetch_array($query)){ 
                            // Mengambil inisial huruf pertama dari nama
                            $inisial = strtoupper(substr($row['nama'], 0, 1));
                    ?>
                    <tr>
                        <td class="text-center font-weight-bold"><?php echo $no++; ?></td>
                        
                        <!-- PENGIRIM (Dengan Avatar Initial) -->
                        <td>
                            <div class="user-profile">
                                <div class="user-avatar"><?php echo $inisial; ?></div>
                                <div class="user-name"><?php echo $row['nama']; ?></div>
                            </div>
                        </td>

                        <!-- ISI PESAN (Dibatasi 2 baris agar rapi) -->
                        <td>
                            <div class="message-text" title="<?php echo htmlspecialchars($row['pesan']); ?>">
                                <?php echo $row['pesan']; ?>
                            </div>
                        </td>

                        <!-- TANGGAL -->
                        <td>
                            <div class="date-badge">
                                <i class="fa-regular fa-calendar-days"></i>
                                <?php echo date('d M Y', strtotime($row['tanggal'])); ?>
                            </div>
                        </td>

                        <!-- AKSI -->
                        <td>
                            <a href="hapus.php?id=<?php echo $row['id']; ?>" class="btn-delete btn-hapus">
                                <i class="fa-solid fa-trash"></i> Hapus
                            </a>
                        </td>
                    </tr>
                    <?php 
                        }
                    } else {
                    ?>
                    <!-- EMPTY STATE -->
                    <tr>
                        <td colspan="5">
                            <div class="empty-data">
                                <div class="empty-data-icon">
                                    <i class="fa-solid fa-envelope-open"></i>
                                </div>
                                <h4>Kotak Masuk Kosong</h4>
                                <p>Belum ada pesan atau kesan baru dari pengunjung website.</p>
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
<script src="../assets/js/darkmode.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
// Konfigurasi SweetAlert Delete
document.querySelectorAll('.btn-hapus').forEach(button => {
    button.addEventListener('click', function(e){
        e.preventDefault();
        let url = this.getAttribute('href');
        
        // Cek status dark mode untuk styling SweetAlert
        const isDark = document.body.classList.contains('dark-mode');

        Swal.fire({
            title: 'Hapus Pesan?',
            text: 'Data yang dihapus tidak dapat dikembalikan.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#64748b',
            confirmButtonText: '<i class="fa-solid fa-trash"></i> Ya, Hapus!',
            cancelButtonText: 'Batal',
            background: isDark ? '#1e293b' : '#ffffff',
            color: isDark ? '#f8fafc' : '#1e293b',
            borderRadius: '20px'
        }).then((result) => {
            if(result.isConfirmed){
                window.location.href = url;
            }
        });
    });
});
</script>

<?php 
// Notifikasi Sukses Menghapus (Bisa menerima dari $_GET['hapus'] atau $_SESSION)
if(isset($_GET['hapus']) || isset($_SESSION['success'])) { 
    // Hapus session jika ada agar tidak muncul terus
    if(isset($_SESSION['success'])) unset($_SESSION['success']);
?>
<script>
document.addEventListener("DOMContentLoaded", function(){
    const isDark = document.body.classList.contains('dark-mode');
    
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: 'Pesan pengunjung telah dihapus.',
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true,
        background: isDark ? '#1e293b' : '#ffffff',
        color: isDark ? '#f8fafc' : '#1e293b',
        borderRadius: '20px'
    });
});
</script>
<?php } ?>

</body>
</html>