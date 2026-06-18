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

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Data Berita
    </title>

    <!-- BOOTSTRAP -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <!-- FONT AWESOME -->
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    >

    <!-- GOOGLE FONT -->
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet"
    >

    <style>

        *{
            font-family:'Poppins',sans-serif;
        }

        body{

            background:#f4f7fe;

            min-height:100vh;
        }

        /* =========================
        CONTAINER
        ========================= */

        .container-custom{

            padding:40px;
        }

        /* =========================
        HEADER
        ========================= */

        .page-header{

            background:
            linear-gradient(
                135deg,
                #001F54,
                #004AAD
            );

            border-radius:30px;

            padding:40px;

            color:white;

            margin-bottom:35px;

            position:relative;

            overflow:hidden;
        }

        .page-header::before{

            content:"";

            position:absolute;

            width:250px;
            height:250px;

            background:
            rgba(255,255,255,0.08);

            border-radius:50%;

            top:-100px;
            right:-80px;
        }

        .page-header h1{

            font-size:40px;

            font-weight:700;

            margin-bottom:10px;

            position:relative;
            z-index:2;
        }

        .page-header p{

            color:#dbeafe;

            margin:0;

            position:relative;
            z-index:2;
        }

        /* =========================
        BUTTONS
        ========================= */

        .header-buttons{

            margin-top:25px;

            display:flex;

            gap:15px;

            flex-wrap:wrap;

            position:relative;
            z-index:2;
        }

        .btn-custom{

            border:none;

            padding:12px 22px;

            border-radius:50px;

            font-weight:600;

            transition:0.3s;

            text-decoration:none;

            display:inline-flex;

            align-items:center;

            gap:10px;
        }

        .btn-dashboard{

            background:white;

            color:#001F54;
        }

        .btn-dashboard:hover{

            background:#dbeafe;

            transform:translateY(-3px);
        }

        .btn-add{

            background:#22c55e;

            color:white;
        }

        .btn-add:hover{

            background:#16a34a;

            transform:translateY(-3px);
        }

        /* =========================
        TABLE CARD
        ========================= */

        .table-card{

            background:white;

            border-radius:30px;

            padding:30px;

            box-shadow:
            0 10px 30px rgba(0,0,0,0.05);
        }

        /* =========================
        TABLE
        ========================= */

        .table{

            vertical-align:middle;
        }

        .table thead{

            background:#001F54;

            color:white;
        }

        .table thead th{

            border:none;

            padding:18px;

            font-size:15px;
        }

        .table tbody tr{

            transition:0.3s;
        }

        .table tbody tr:hover{

            background:#f8fbff;
        }

        .table tbody td{

            padding:18px;

            border-color:#eef2ff;
        }

        /* =========================
        IMAGE
        ========================= */

        .berita-img{

            width:120px;

            height:80px;

            object-fit:cover;

            border-radius:15px;

            box-shadow:
            0 5px 15px rgba(0,0,0,0.08);
        }

        /* =========================
        TITLE
        ========================= */

        .judul-berita{

            font-weight:600;

            color:#001F54;

            font-size:16px;
        }

        /* =========================
        DATE
        ========================= */

        .tanggal{

            color:#666;

            font-size:14px;
        }

        /* =========================
        ACTION BUTTON
        ========================= */

        .btn-action{

            border:none;

            padding:10px 16px;

            border-radius:12px;

            font-size:14px;

            font-weight:600;

            transition:0.3s;

            margin-right:8px;
        }

        .btn-edit{

            background:#facc15;

            color:#111827;
        }

        .btn-edit:hover{

            background:#eab308;

            transform:translateY(-2px);
        }

        .btn-delete{

            background:#ef4444;

            color:white;
        }

        .btn-delete:hover{

            background:#dc2626;

            transform:translateY(-2px);
        }

        /* =========================
        EMPTY
        ========================= */

        .empty-data{

            text-align:center;

            padding:50px 20px;

            color:#666;
        }

        .empty-data i{

            font-size:60px;

            margin-bottom:20px;

            color:#cbd5e1;
        }

        /* =========================
        RESPONSIVE
        ========================= */

        @media(max-width:768px){

            .container-custom{
                padding:20px;
            }

            .page-header{
                padding:30px;
            }

            .page-header h1{
                font-size:30px;
            }

            .table-card{
                overflow-x:auto;
            }

            .berita-img{
                width:100px;
                height:70px;
            }

        }

        body.dark-mode{

    background:#0f172a;
}

body.dark-mode .topbar,
body.dark-mode .dashboard-card,
body.dark-mode .table-wrapper,
body.dark-mode .page-header{

    background:#1e293b;
}

body.dark-mode table{

    color:white;
}

body.dark-mode h1,
body.dark-mode h2,
body.dark-mode h3,
body.dark-mode h4,
body.dark-mode h5,
body.dark-mode p,
body.dark-mode span,
body.dark-mode td,
body.dark-mode th{

    color:white !important;
}

    </style>

</head>
<body>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php if(isset($_SESSION['success'])) : ?>

<script>

Swal.fire({

    icon:'success',

    title:'Berhasil!',

    text:'<?php echo $_SESSION['success']; ?>',

    confirmButtonColor:'#004AAD',

    confirmButtonText:'OK',

    borderRadius:'20px'

});

</script>

<?php unset($_SESSION['success']); endif; ?>

<div class="container-custom">

    <!-- =========================
    HEADER
    ========================= -->

    <div class="page-header">

        <h1>
            Kelola Berita
        </h1>

        <p>
            Kelola seluruh berita dan informasi terbaru GENBI UIN SSC
        </p>

        <div class="header-buttons">

            <!-- DASHBOARD -->
            <a
                href="../dashboard.php"
                class="btn-custom btn-dashboard"
            >

                <i class="fa-solid fa-arrow-left"></i>

                Dashboard

            </a>

            <!-- TAMBAH -->
            <a
                href="tambah.php"
                class="btn-custom btn-add"
            >

                <i class="fa-solid fa-plus"></i>

                Tambah Berita

            </a>

        </div>

    </div>

    <!-- =========================
    TABLE
    ========================= -->

    <div class="table-card">

        <table class="table">

            <thead>

                <tr>

                    <th width="5%">
                        No
                    </th>

                    <th width="20%">
                        Gambar
                    </th>

                    <th>
                        Judul Berita
                    </th>

                    <th width="15%">
                        Tanggal
                    </th>

                    <th width="20%">
                        Aksi
                    </th>

                </tr>

            </thead>

            <tbody>

                <?php

                $no = 1;

                $query = mysqli_query(
                    $conn,
                    "SELECT * FROM berita
                     ORDER BY id DESC"
                );

                if(mysqli_num_rows($query) > 0){

                    while($data = mysqli_fetch_array($query)){

                ?>

                <tr>

                    <!-- NO -->
                    <td>
                        <?php echo $no++; ?>
                    </td>

                    <!-- IMAGE -->
                    <td>

                        <img
                            src="../../assets/upload/<?php echo $data['gambar']; ?>"
                            class="berita-img"
                        >

                    </td>

                    <!-- TITLE -->
                    <td>

                        <div class="judul-berita">

                            <?php echo $data['judul']; ?>

                        </div>

                    </td>

                    <!-- DATE -->
                    <td>

                        <div class="tanggal">

                            <i class="fa-solid fa-calendar-days"></i>

                            <?php echo $data['tanggal']; ?>

                        </div>

                    </td>

                    <!-- ACTION -->
                    <td>

                        <!-- EDIT -->
<a
    href="edit.php?id=<?php echo $data['id']; ?>"
    class="btn btn-action btn-edit btn-edit-popup"
>

    <i class="fa-solid fa-pen"></i>

    Edit

</a>

                        <!-- HAPUS -->
<a
href="hapus.php?id=<?php echo $data['id']; ?>"
class="btn btn-action btn-delete btn-hapus">

    <i class="fa-solid fa-trash"></i>

    Hapus

</a>

                    </td>

                </tr>

                <?php

                    }

                } else {

                ?>

                <tr>

                    <td colspan="5">

                        <div class="empty-data">

                            <i class="fa-solid fa-newspaper"></i>

                            <h4>
                                Belum Ada Berita
                            </h4>

                            <p>
                                Silakan tambahkan berita terbaru terlebih dahulu
                            </p>

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

document.querySelectorAll('.btn-edit-popup').forEach(button => {

    button.addEventListener('click', function(e){

        e.preventDefault();

        const link = this.getAttribute('href');

        Swal.fire({

            title: 'Edit Berita',

            text: 'Masuk ke halaman edit berita?',

            icon: 'question',

            showCancelButton: true,

            confirmButtonColor: '#2563eb',

            cancelButtonColor: '#6b7280',

            confirmButtonText: 'Ya, Edit',

            cancelButtonText: 'Batal',

            borderRadius:'20px',

            background:'#ffffff'

        }).then((result) => {

            if(result.isConfirmed){

                window.location.href = link;

            }

        });

    });

});

</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

            cancelButtonColor: '#6b7280',

            confirmButtonText: 'Ya, Hapus!',

            cancelButtonText: 'Batal',

            borderRadius:'20px',

            background:'#ffffff'

        }).then((result) => {

            if(result.isConfirmed){

                window.location.href = link;

            }

        });

    });

});

</script>

<script>

document.querySelectorAll('.btn-edit-popup').forEach(button => {

    button.addEventListener('click', function(e){

        e.preventDefault();

        const link = this.getAttribute('href');

        Swal.fire({

            title: 'Edit Kegiatan',

            text: 'Masuk ke halaman edit kegiatan?',

            icon: 'question',

            showCancelButton: true,

            confirmButtonColor: '#2563eb',

            cancelButtonColor: '#6b7280',

            confirmButtonText: 'Ya, Edit',

            cancelButtonText: 'Batal',

            borderRadius:'20px',

            background:'#ffffff'

        }).then((result) => {

            if(result.isConfirmed){

                Swal.fire({

                    title:'Membuka Editor...',

                    text:'Mohon tunggu sebentar',

                    timer:1000,

                    showConfirmButton:false,

                    icon:'success',

                    borderRadius:'20px'

                });

                setTimeout(() => {

                    window.location.href = link;

                },1000);

            }

        });

    });

});

</script>

<script src="../assets/js/darkmode.js"></script>

</body>
</html>