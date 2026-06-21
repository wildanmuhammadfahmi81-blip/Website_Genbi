<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Login GENBI UIN SSC</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

<style>

*{
    font-family:'Poppins',sans-serif;
}

body{

    background:
    linear-gradient(
    135deg,
    #001F54,
    #004AAD
    );

    min-height:100vh;
    padding:30px 15px;

    overflow-x:hidden;
}

.login-wrapper{

    max-width:1000px;
    margin:auto;

}

.login-box{

    background:white;

    border-radius:35px;

    overflow:hidden;

    box-shadow:
    0 20px 50px rgba(0,0,0,.18);

}

.left-side{

    background:
    linear-gradient(
    135deg,
    #001F54,
    #004AAD
    );

    color:white;

    padding:60px 40px;

    height:100%;

    position:relative;

    overflow:hidden;

}

.left-side::before{

    content:"";

    width:300px;
    height:300px;

    background:
    rgba(255,255,255,.08);

    border-radius:50%;

    position:absolute;

    top:-100px;
    right:-100px;

}

.left-side::after{

    content:"";

    width:180px;
    height:180px;

    background:
    rgba(255,255,255,.06);

    border-radius:50%;

    position:absolute;

    bottom:-60px;
    left:-60px;

}

.logo-icon{

    width:90px;
    height:90px;

    background:white;

    color:#004AAD;

    border-radius:25px;

    display:flex;

    align-items:center;
    justify-content:center;

    font-size:40px;

    margin-bottom:25px;

    position:relative;
    z-index:2;

}

.left-side h1{

    font-weight:800;
    position:relative;
    z-index:2;

}

.left-side p{

    position:relative;
    z-index:2;

    opacity:.9;
    line-height:1.8;

}

.right-side{

    padding:50px 40px;

}

.title{

    text-align:center;
    margin-bottom:35px;

}

.title h2{

    font-weight:700;
    color:#001F54;

}

.login-card{

    background:#f8fbff;

    border:2px solid #eef3ff;

    border-radius:25px;

    padding:30px;

    text-align:center;

    transition:.3s;

    height:100%;
}

.login-card:hover{

    transform:translateY(-8px);

    box-shadow:
    0 15px 30px rgba(0,0,0,.08);

}

.login-card i{

    font-size:55px;

    margin-bottom:20px;
}

.admin{

    color:#2563eb;
}

.anggota{

    color:#10b981;
}

.login-card h4{

    font-weight:700;
}

.btn-login{

    border-radius:50px;

    padding:12px 25px;

    font-weight:600;

    margin-top:10px;
}

.footer-text{

    text-align:center;

    margin-top:25px;

    color:#64748b;

    font-size:14px;
}

@media(max-width:768px){

    body{

        padding:15px;
    }

    .left-side{

        text-align:center;
        padding:40px 25px;
    }

    .logo-icon{

        margin:auto auto 20px;
    }

    .right-side{

        padding:30px 20px;
    }

    .title h2{

        font-size:24px;
    }

}

</style>

</head>

<body>

<div class="login-wrapper">

<div class="login-box">

<div class="row g-0">

<div class="col-lg-5">

<div class="left-side">

<div class="logo-icon">

<i class="fa-solid fa-graduation-cap"></i>

</div>

<h1>GENBI UIN SSC</h1>

<p>

Sistem Informasi Organisasi untuk pengelolaan
anggota, kegiatan, berita dan absensi
Generasi Baru Indonesia UIN Siber Syekh Nurjati Cirebon.

</p>

</div>

</div>

<div class="col-lg-7">

<div class="right-side">

<div class="title">

<h2>Login Sistem</h2>

<p>Pilih jenis akun yang akan digunakan</p>

</div>

<div class="row">

<div class="col-md-6 mb-3">

<div class="login-card">

<i class="fa-solid fa-user-shield admin"></i>

<h4>Admin</h4>

<p>

Kelola anggota, kegiatan,
berita dan absensi GENBI.

</p>

<a
href="admin/login.php"
class="btn btn-primary btn-login">

Login Admin

</a>

</div>

</div>

<div class="col-md-6 mb-3">

<div class="login-card">

<i class="fa-solid fa-user-graduate anggota"></i>

<h4>Anggota</h4>

<p>

Melakukan absensi,
melihat riwayat dan profil.

</p>

<a
href="anggota/login.php"
class="btn btn-success btn-login">

Login Anggota

</a>

</div>

</div>

</div>

<div class="footer-text">

© <?php echo date('Y'); ?> GENBI UIN SSC

</div>

</div>

</div>

</div>

</div>

</div>

</body>
</html>