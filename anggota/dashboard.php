<?php

session_start();

include '../config/koneksi.php';

$id_anggota = $_SESSION['id_anggota'];

$data = mysqli_fetch_assoc(

    mysqli_query(

        $conn,

        "SELECT *
        FROM anggota
        WHERE id='$id_anggota'"

    )

);

if(!isset($_SESSION['anggota'])){

    header("Location:login.php");
    exit();

}

?>

<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>
Dashboard Anggota GENBI
</title>

<link
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">

<link
rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<link
href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
rel="stylesheet">

<style>

*{
    font-family:'Poppins',sans-serif;
}

body{

    background:#f4f7fe;

}

.topbar{

    background:white;

    border-radius:25px;

    padding:25px 35px;

    margin-bottom:30px;

    box-shadow:
    0 10px 25px rgba(0,0,0,.05);

}

.topbar h2{

    margin:0;

    font-weight:700;

    color:#001F54;

}

.profile-card{

    background:
    linear-gradient(
    135deg,
    #001F54,
    #004AAD
    );

    color:white;

    border-radius:30px;

    padding:40px;

    margin-bottom:30px;

    position:relative;

    overflow:hidden;

}

.profile-card::before{

    content:"";

    width:250px;
    height:250px;

    background:
    rgba(255,255,255,.08);

    border-radius:50%;

    position:absolute;

    right:-80px;
    top:-80px;

}

.profile-card h3{

    font-weight:700;

}

.profile-card p{

    margin-bottom:8px;

}

.menu-card{

    background:white;

    border-radius:25px;

    padding:35px;

    text-align:center;

    transition:.3s;

    box-shadow:
    0 10px 25px rgba(0,0,0,.05);

    height:100%;

}

.menu-card:hover{

    transform:translateY(-8px);

}

.menu-icon{

    width:80px;
    height:80px;

    margin:auto;

    border-radius:20px;

    display:flex;

    align-items:center;

    justify-content:center;

    color:white;

    font-size:30px;

    margin-bottom:20px;

}

.icon-kegiatan{

    background:#2563eb;

}

.icon-absensi{

    background:#22c55e;

}

.icon-riwayat{

    background:#f59e0b;

}

.icon-profil{

    background:#8b5cf6;

}

.menu-card h5{

    font-weight:600;

    margin-bottom:15px;

}

.welcome-box{

    margin-top:40px;

    background:white;

    border-radius:25px;

    padding:35px;

    box-shadow:
    0 10px 25px rgba(0,0,0,.05);

}

.profile-header{

    display:flex;

    align-items:center;

    gap:25px;

    position:relative;

    z-index:2;

}

.profile-photo{

    width:110px;

    height:110px;

    border-radius:50%;

    object-fit:cover;

    border:4px solid rgba(255,255,255,.4);

    box-shadow:
    0 10px 25px rgba(0,0,0,.2);

}

.profile-info h3{

    margin-bottom:10px;

    font-weight:700;

}

.profile-info p{

    margin-bottom:5px;

}

@media(max-width:768px){

    .profile-header{

        flex-direction:column;

        text-align:center;

    }

    .profile-photo{

        width:90px;

        height:90px;

    }

}

</style>

</head>

<body>

<div class="container py-5">

    <!-- TOPBAR -->

    <div class="topbar">

        <h2>
            Dashboard Anggota GENBI
        </h2>

    </div>

    <div class="profile-card">

    <div class="profile-header">

        <?php

        if(!empty($data['foto'])){

        ?>

        <img
        src="../assets/foto_anggota/<?php echo $data['foto']; ?>"
        class="profile-photo">

        <?php

        }else{

        ?>

        <img
        src="../assets/image/default-user.png"
        class="profile-photo">

        <?php } ?>

        <div class="profile-info">

            <h3>

                Halo,

                <?php echo $data['nama']; ?>

                👋

            </h3>

            <p>

                <b>Divisi :</b>

                <?php echo $data['divisi']; ?>

            </p>

            <p>

                <b>Jabatan :</b>

                <?php

                echo isset($data['jabatan'])
                ? $data['jabatan']
                : 'Anggota';

                ?>

            </p>

            <p>

                <b>Status :</b>

                <span class="badge bg-success">

                    Anggota Aktif

                </span>

            </p>

        </div>

    </div>

</div>

    <!-- MENU -->

    <div class="row">
        <div class="col-md-3 mb-4">

            <div class="menu-card">

                <div class="menu-icon icon-absensi">

                    <i class="fa-solid fa-check"></i>

                </div>

                <h5>
                    Absensi
                </h5>

                <a
                href="absensi.php"
                class="btn btn-success">

                    Absen

                </a>

            </div>

        </div>

        <div class="col-md-3 mb-4">

            <div class="menu-card">

                <div class="menu-icon icon-riwayat">

                    <i class="fa-solid fa-clock-rotate-left"></i>

                </div>

                <h5>
                    Riwayat
                </h5>

                <a
                href="riwayat.php"
                class="btn btn-warning">

                    Lihat

                </a>

            </div>

        </div>

        <div class="col-md-3 mb-4">

            <div class="menu-card">

                <div class="menu-icon icon-profil">

                    <i class="fa-solid fa-user"></i>

                </div>

                <h5>
                    Profil
                </h5>

                <a
                href="profil.php"
                class="btn btn-secondary">

                    Kelola

                </a>

            </div>

        </div>

    </div>


    <!-- WELCOME BOX -->

    <div class="welcome-box">

        <h4>

            Selamat Datang di Sistem Informasi GENBI UIN SSC

        </h4>

        <p class="mt-3 text-muted">

            Melalui dashboard ini anggota dapat melihat
            informasi kegiatan, melakukan absensi,
            melihat riwayat kehadiran serta mengelola
            akun secara mandiri.

        </p>

        <a
        href="ganti-password.php"
        class="btn btn-warning">

            <i class="fa-solid fa-key"></i>

            Ganti Password

        </a>

        <a
        href="../index.php"
        class="btn btn-danger">

            <i class="fa-solid fa-right-from-bracket"></i>

            Logout

        </a>

    </div>

</div>

</body>
</html>