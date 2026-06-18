<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Login GENBI</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<style>

body{

    min-height:100vh;

    display:flex;

    justify-content:center;

    align-items:center;

    background:
    linear-gradient(
    135deg,
    #001F54,
    #004AAD
    );

    font-family:'Poppins',sans-serif;

}

.login-box{

    background:white;

    padding:50px;

    border-radius:30px;

    width:100%;

    max-width:800px;

    box-shadow:
    0 15px 40px rgba(0,0,0,.15);

}

.title{

    text-align:center;

    margin-bottom:40px;

}

.title h2{

    color:#001F54;

    font-weight:700;

}

.login-card{

    border:1px solid #eee;

    border-radius:25px;

    padding:35px;

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

    font-size:60px;

    margin-bottom:20px;

}

.admin{

    color:#2563eb;

}

.anggota{

    color:#10b981;

}

.btn-login{

    border-radius:50px;

    padding:12px 25px;

    font-weight:600;

}

</style>

</head>
<body>

<div class="login-box">

    <div class="title">

        <h2>Login GENBI UIN SSC</h2>

        <p>
            Pilih jenis akun yang akan digunakan
        </p>

    </div>

    <div class="row">

        <div class="col-md-6 mb-3">

            <div class="login-card">

                <i class="fa-solid fa-user-shield admin"></i>

                <h4>Admin</h4>

                <p>
                    Kelola berita, kegiatan,
                    anggota, dan absensi.
                </p>

                <a href="admin/login.php"
                class="btn btn-primary btn-login">

                    Login Admin

                </a>

            </div>

        </div>

        <div class="col-md-6 mb-3">

            <div class="login-card">

                <i class="fa-solid fa-user-graduate anggota"></i>

                <h4>Anggota GENBI</h4>

                <p>
                    Absensi kegiatan dan
                    melihat profil anggota.
                </p>

                <a href="anggota/login.php"
                class="btn btn-success btn-login">

                    Login Anggota

                </a>

            </div>

        </div>

    </div>

</div>

</body>
</html>