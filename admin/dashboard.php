<?php

session_start();

include '../config/koneksi.php';

if(!isset($_SESSION['login'])){
    header("Location: login.php");
    exit();
}

/* =========================
TOTAL BERITA
========================= */

$berita = mysqli_query(
    $conn,
    "SELECT * FROM berita"
);

$totalBerita = mysqli_num_rows($berita);

/* =========================
TOTAL PESAN
========================= */

$totalPesan = mysqli_num_rows(
    mysqli_query($conn, "SELECT * FROM pesan_kesan")
);

/* =========================
TOTAL KEGIATAN
========================= */

$kegiatan = mysqli_query(
    $conn,
    "SELECT * FROM kegiatan"
);

$totalKegiatan = mysqli_num_rows($kegiatan);

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
        Dashboard Admin GENBI
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
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'Poppins',sans-serif;
        }

        body{
            background:#f4f7fe;
            overflow-x:hidden;
        }

        /* =========================
        SIDEBAR
        ========================= */

        .sidebar{

    width:270px;

    background:linear-gradient(
        180deg,
        #001F54,
        #003b8e
    );

    position:fixed;

    top:0;
    left:0;
    bottom:0;

    padding:35px 20px;

    color:white;

    overflow-y:auto;

    z-index:1000;

}



        .sidebar-logo{

            text-align:center;

            margin-bottom:40px;
        }

        .sidebar-logo img{

            width:90px;
            height:90px;

            object-fit:cover;

            border-radius:50%;

            border:4px solid white;

            margin-bottom:15px;
        }

        .sidebar-logo h2{

            font-size:28px;

            font-weight:700;
        }

        .sidebar-menu a{

            display:flex;

            align-items:center;

            gap:15px;

            text-decoration:none;

            color:white;

            padding:15px 20px;

            border-radius:18px;

            margin-bottom:15px;

            transition:0.3s;

            font-size:16px;

            font-weight:500;
        }

        .sidebar-menu a:hover{

            background:
            rgba(255,255,255,0.15);

            transform:translateX(5px);
        }

        .sidebar-menu i{

            width:25px;

            font-size:18px;
        }

        /* =========================
MAIN CONTENT
========================= */

.main-content{

    margin-left:270px;

    padding:35px;

    min-height:100vh;

    background:#f4f7fe;

}

/* =========================
TOPBAR
========================= */

.topbar{

    background:white;

    padding:20px 25px;

    border-radius:25px;

    margin-bottom:30px;

    display:flex;

    justify-content:space-between;

    align-items:center;

    box-shadow:
    0 10px 30px rgba(0,0,0,.06);

}

.topbar h3{

    margin:0;

    font-size:28px;

    font-weight:700;

    color:#001F54;

}

.topbar-right{

    display:flex;

    align-items:center;

    gap:15px;

}

.admin-profile{

    display:flex;

    align-items:center;

    gap:10px;

    background:#f8fafc;

    padding:10px 15px;

    border-radius:50px;

}

.admin-profile img{

    width:45px;

    height:45px;

    border-radius:50%;

    object-fit:cover;

}

.dark-toggle{

    border:none;

    width:45px;

    height:45px;

    border-radius:50%;

    background:#001F54;

    color:white;

}

/* =========================
CARD DASHBOARD
========================= */

.dashboard-card{

    background:white;

    border-radius:25px;

    padding:30px;

    text-align:center;

    box-shadow:
    0 10px 25px rgba(0,0,0,.05);

    transition:.3s;

    height:100%;

}

.dashboard-card:hover{

    transform:translateY(-5px);

}

.dashboard-card h4{

    font-size:42px;

    font-weight:700;

    color:#001F54;

    margin:15px 0 10px;

}

.dashboard-card p{

    margin:0;

    color:#64748b;

}

.card-icon{

    width:70px;

    height:70px;

    border-radius:50%;

    display:flex;

    align-items:center;

    justify-content:center;

    margin:auto;

    font-size:28px;

    color:white;

}

.icon-berita{

    background:#2563eb;

}

.icon-kegiatan{

    background:#10b981;

}

.icon-pesan{

    background:#f59e0b;

}

/* =========================
WELCOME BOX
========================= */

.welcome-box{

    background:
    linear-gradient(
        135deg,
        #001F54,
        #004AAD
    );

    color:white;

    padding:40px;

    border-radius:30px;

    margin-top:25px;

    box-shadow:
    0 15px 35px rgba(0,74,173,.2);

}

.welcome-box h2{

    font-weight:700;

    margin-bottom:15px;

}

.btn-custom{

    display:inline-block;

    margin-top:15px;

    padding:12px 25px;

    border-radius:15px;

    text-decoration:none;

    background:white;

    color:#001F54;

    font-weight:600;

}

/* =========================
RESPONSIVE HP
========================= */

@media(max-width:768px){

    .main-content{

        margin-left:80px;

        padding:15px;

    }

    .topbar{

        flex-direction:column;

        gap:15px;

        text-align:center;

    }

    .topbar h3{

        font-size:20px;

    }

    .topbar-right{

        width:100%;

        justify-content:center;

        flex-wrap:wrap;

    }

    .admin-profile{

        width:100%;

        justify-content:center;

    }

    .dashboard-card{

        padding:20px;

    }

    .dashboard-card h4{

        font-size:32px;

    }

    .welcome-box{

        padding:25px;

        text-align:center;

    }

    .welcome-box h2{

        font-size:24px;

    }

}

        /* =========================
        WELCOME BOX
        ========================= */

        .welcome-box{

            margin-top:10px;

            background:
            linear-gradient(
                135deg,
                #001F54,
                #004AAD
            );

            border-radius:35px;

            padding:60px;

            color:white;

            position:relative;


            min-height:auto;

            box-shadow:
            0 10px 30px rgba(0,0,0,0.08);
        }

        .welcome-box::before{

            content:"";

            position:absolute;

            width:350px;
            height:350px;

            background:
            rgba(255,255,255,0.08);

            border-radius:50%;

            right:-100px;
            top:-100px;
        }

        .welcome-box h2{

            font-size:45px;

            font-weight:700;

            margin-bottom:20px;

            position:relative;
            z-index:2;
        }

        .welcome-box p{

            width:60%;

            line-height:1.9;

            color:#dbeafe;

            position:relative;
            z-index:2;
        }

        .btn-custom{

            display:inline-block;

            margin-top:25px;

            background:white;

            color:#001F54;

            text-decoration:none;

            padding:14px 28px;

            border-radius:50px;

            font-weight:600;

            transition:0.3s;

            position:relative;
            z-index:2;
        }

        .btn-custom:hover{

            background:#dbeafe;

            transform:translateY(-3px);
        }

        .welcome-img{

            position:absolute;

            right:40px;
            bottom:0;

            width:320px;
        }

        /* =========================
        RESPONSIVE
        ========================= */

    @media(max-width:768px){

    .sidebar{

        width:80px;

        padding:20px 10px;

    }

    .sidebar-logo h2{

        display:none;

    }

    .sidebar-logo img{

        width:55px;
        height:55px;

    }

    .sidebar-menu a{

        justify-content:center;

        padding:15px;

    }

    .sidebar-menu a span{

        display:none;

    }

    .main-content{

        margin-left:80px;

        padding:20px;

    }

}

        @media(max-width:768px){

            .topbar{

                flex-direction:column;

                gap:20px;

                text-align:center;
            }

            .welcome-box{

                padding:40px 30px;
            }

            .welcome-box h2{
                font-size:32px;
            }

            .dashboard-card{
                min-height:auto;
            }

        }

        .dark-toggle{

    border:none;

    width:50px;
    height:50px;

    border-radius:50%;

    background:#001F54;

    color:white;

    cursor:pointer;

    font-size:20px;

    transition:.3s;
}

.dark-toggle:hover{

    transform:scale(1.08);
}


/* DARK MODE */

body.dark-mode{

    background:#0f172a;
}

body.dark-mode .topbar{

    background:#1e293b;
}

body.dark-mode .dashboard-card{

    background:#1e293b;
}

body.dark-mode .welcome-box{

    background:
    linear-gradient(
        135deg,
        #111827,
        #1e293b
    );
}

body.dark-mode h3,
body.dark-mode h4,
body.dark-mode p,
body.dark-mode span{

    color:white !important;
}

.topbar-right{

    display:flex;

    align-items:center;

    gap:15px;

}

    body.dark-mode .sidebar{

    background:
    linear-gradient(
        180deg,
        #020617,
        #0f172a
    );
}

body.dark-mode .dashboard-card p{

    color:#cbd5e1 !important;
}

body.dark-mode .topbar{

    border:1px solid rgba(255,255,255,0.05);
}

body.dark-mode .dashboard-card{

    border:1px solid rgba(255,255,255,0.05);
}

/* --- PERBAIKAN MODE MALAM TOPBAR --- */

/* 1. Kunci warna teks Welcome Admin agar tetap abu-abu gelap/kontras */
.admin-profile span {
    color: #2b3674 !important; /* Warna navy gelap bawaan dashboard */
    font-weight: 600;
}

/* 2. Opsional: Jika di mode malam kotak profil ingin ikut menyesuaikan, 
   pastikan teks di dalamnya menyesuaikan jadi putih lembut */
body.dark-mode .admin-profile {
    background: rgba(255, 255, 255, 0.1) !important;
    border: 1px solid rgba(255, 255, 255, 0.15) !important;
}

body.dark-mode .admin-profile span {
    color: #ffffff !important; /* Otomatis jadi putih jika kotaknya menggelap */
}

/* 3. Perbaikan Tombol Toggle agar berganti ikon atau warna saat aktif */
body.dark-mode .dark-toggle {
    background: #f4f7fe !important;
    color: #0b192c !important;
}

    </style>

</head>

<body>

<!-- =========================
SIDEBAR
========================= -->

<div class="sidebar">

    <div class="sidebar-logo">

        <img src="../assets/image/logo.jpg">

        <h2>
            GENBI Admin
        </h2>

    </div>

    <div class="sidebar-menu">

    <a href="dashboard.php">
        <i class="fa-solid fa-house"></i>
        <span>Dashboard</span>
    </a>

    <a href="berita/index.php">
        <i class="fa-solid fa-newspaper"></i>
        <span>Kelola Berita</span>
    </a>

    <a href="kegiatan/index.php">
        <i class="fa-solid fa-calendar-days"></i>
        <span>Kelola Kegiatan</span>
    </a>

    <a href="absensi/index.php">
        <i class="fa-solid fa-clipboard-check"></i>
        <span>Kelola Absensi</span>
    </a>

    <a href="pesan/index.php">
        <i class="fa-solid fa-envelope"></i>
        <span>Pesan Masuk</span>
    </a>

    <a href="logout.php">
        <i class="fa-solid fa-right-from-bracket"></i>
        <span>Logout</span>
    </a>

</div>

</div>

<!-- =========================
MAIN CONTENT
========================= -->

<div class="main-content">

    <!-- TOPBAR -->
    <div class="topbar">

    <h3>
        Dashboard Admin GENBI UIN SSC
    </h3>

    <div class="topbar-right">

        <button id="darkToggle" class="dark-toggle">

            <i class="fa-solid fa-moon"></i>

        </button>

        <div class="admin-profile">

            <img
                src="../assets/image/logo.jpg"
            >

            <span>
                Welcome Admin 👋
            </span>

        </div>

    </div>

</div>

    <!-- CARD -->
    <div class="row">

        <!-- BERITA -->
        <div class="col-lg-4 col-md-6 mb-4">

            <div class="dashboard-card">

                <div class="card-icon icon-berita">

                    <i class="fa-solid fa-newspaper"></i>

                </div>

                <h4>
                    <?php echo $totalBerita; ?>
                </h4>

                <p>
                    Total Berita
                </p>

            </div>

        </div>

        <!-- KEGIATAN -->
        <div class="col-lg-4 col-md-6 mb-4">

            <div class="dashboard-card">

                <div class="card-icon icon-kegiatan">

                    <i class="fa-solid fa-calendar-days"></i>

                </div>

                <h4>
                    <?php echo $totalKegiatan; ?>
                </h4>

                <p>
                    Total Kegiatan
                </p>

            </div>

        </div>

        <!-- PESAN MASUK -->
        <div class="col-lg-4 col-md-6 mb-4">

            <div class="dashboard-card">

                <div class="card-icon icon-pesan">

                    <i class="fa-solid fa-envelope"></i>

                </div>

                <h4>
                    <?php echo $totalPesan; ?>
                </h4>

                <p>
                    Pesan Masuk
                </p>

            </div>

        </div>

    </div>

    <!-- WELCOME -->
    <div class="welcome-box">

        <h2>
            Selamat Datang di Dashboard GENBI
        </h2>

        <p>
            Kelola berita, kegiatan, galeri, dan seluruh
            informasi organisasi GENBI UIN SSC
            dengan mudah melalui dashboard admin modern.
        </p>

        <a
            href="../index.php"
            class="btn-custom"
        >

            <i class="fa-solid fa-globe"></i>

            Lihat Website

        </a>

    </div>

</div>

<script>

const toggle =
document.getElementById('darkToggle');

if(
localStorage.getItem('darkMode')
=== 'enabled'
){

    document.body.classList.add(
        'dark-mode'
    );

}

toggle.addEventListener('click',()=>{

    document.body.classList.toggle(
        'dark-mode'
    );

    if(

        document.body.classList.contains(
            'dark-mode'
        )

    ){

        localStorage.setItem(
            'darkMode',
            'enabled'
        );

    }else{

        localStorage.setItem(
            'darkMode',
            'disabled'
        );

    }

});

</script>

<script src="../assets/js/darkmode.js"></script>

</body>
</html>