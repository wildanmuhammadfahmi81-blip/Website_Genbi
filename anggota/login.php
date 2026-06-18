<?php

session_start();

include '../config/koneksi.php';

if(isset($_POST['login'])){

    $username = mysqli_real_escape_string(
        $conn,
        $_POST['username']
    );

    $password = md5($_POST['password']);

    $query = mysqli_query(

        $conn,

        "SELECT * FROM anggota
        WHERE username='$username'
        AND password='$password'"

    );

    if(mysqli_num_rows($query)>0){

        $data = mysqli_fetch_assoc($query);

        $_SESSION['anggota'] = true;

        $_SESSION['id_anggota'] = $data['id'];

        $_SESSION['nama'] = $data['nama'];

        $_SESSION['divisi'] = $data['divisi'];

        if($data['first_login']==1){

            header("Location:ganti-password.php");

        }else{

            header("Location:dashboard.php");

        }

        exit();

    }else{

        $error = "Username atau Password salah!";

    }

}

?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Login Anggota GENBI</title>

<link
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">

<link
rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<style>

*{
    font-family:'Poppins',sans-serif;
}

body{

    background:
    linear-gradient(
    135deg,
    #001F54,
    #004AAD,
    #007BFF);

    min-height:100vh;

    display:flex;

    justify-content:center;

    align-items:center;

    padding:20px;

    margin:0;

}

.login-card{

    width:100%;

    max-width:420px;

    background:rgba(255,255,255,.15);

    backdrop-filter:blur(20px);

    border:1px solid rgba(255,255,255,.2);

    border-radius:25px;

    padding:35px 30px;

    color:white;

    box-shadow:
    0 15px 40px rgba(0,0,0,.25);

}

.logo{

    text-align:center;

    margin-bottom:30px;

}

.logo img{

    width:100px;

    height:100px;

    object-fit:cover;

    border-radius:50%;

    border:4px solid white;

}

.logo h3{

    font-weight:700;

    margin-top:15px;

}

.form-label{

    color:white;

    font-weight:500;

}

.input-group-text{

    background:white;

    border:none;

}

.form-control{

    border:none;

    padding:12px;

}

.form-control:focus{

    box-shadow:none;

}

.btn-login{

    background:white;

    color:#004AAD;

    border:none;

    padding:12px;

    font-weight:700;

    border-radius:12px;

    transition:.3s;

}

.btn-login:hover{

    transform:translateY(-3px);

    background:#f1f5f9;

}

.alert{

    border-radius:12px;

}

@keyframes fadeIn{

    from{
        opacity:0;
        transform:translateY(30px);
    }

    to{
        opacity:1;
        transform:translateY(0);
    }

}

/* ======================
   RESPONSIVE MOBILE
====================== */

@media (max-width:768px){

    body{
        padding:15px;
    }

    .login-card{

        width:100%;

        max-width:100%;

        padding:30px 20px;

        border-radius:20px;

    }

    .logo img{

        width:80px;
        height:80px;

    }

    .logo h3{

        font-size:22px;

    }

    .form-label{

        font-size:15px;

    }

    .form-control{

        font-size:15px;

        padding:12px;

    }

    .btn-login{

        font-size:15px;

        padding:12px;

    }

}

@media (max-width:480px){

    .login-card{

        padding:25px 15px;

    }

    .logo img{

        width:70px;
        height:70px;

    }

    .logo h3{

        font-size:20px;

    }

}

</style>

</head>

<body>

<div class="login-card">

    <div class="logo">

        <img src="../assets/image/logo.jpg">

        <h3 class="mt-3">
            Login Anggota GENBI
        </h3>

    </div>

    <?php if(isset($error)){ ?>

        <div class="alert alert-danger">

            <?php echo $error; ?>

        </div>

    <?php } ?>

    <form method="POST">

<div class="mb-3">

<label class="form-label">
Username
</label>

<div class="input-group">

<span class="input-group-text">
<i class="fas fa-user"></i>
</span>

<input
type="text"
name="username"
class="form-control"
placeholder="Masukkan username"
required>

</div>

</div>

<div class="mb-4">

<label class="form-label">
Password
</label>

<div class="input-group">

<span class="input-group-text">
<i class="fas fa-lock"></i>
</span>

<input
type="password"
name="password"
id="password"
class="form-control"
placeholder="Masukkan password"
required>

<button
type="button"
class="input-group-text"
onclick="togglePassword()">

<i class="fas fa-eye" id="eyeIcon"></i>

</button>

</div>

</div>

<button
type="submit"
name="login"
class="btn btn-login w-100">

<i class="fas fa-sign-in-alt"></i>
Login

</button>

<div class="text-center mt-3">

<small>
© GENBI Komisariat UIN SSC
</small>

</div>

</form>

</div>

<script>

function togglePassword(){

    let password =
    document.getElementById("password");

    let icon =
    document.getElementById("eyeIcon");

    if(password.type==="password"){

        password.type="text";

        icon.classList.remove("fa-eye");

        icon.classList.add("fa-eye-slash");

    }else{

        password.type="password";

        icon.classList.remove("fa-eye-slash");

        icon.classList.add("fa-eye");

    }

}

</script>

</body>
</html>