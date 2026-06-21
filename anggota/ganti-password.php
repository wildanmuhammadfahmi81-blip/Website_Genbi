<?php

session_start();

include '../config/koneksi.php';

if(!isset($_SESSION['anggota'])){
    header("Location:login.php");
    exit();
}

$id = $_SESSION['id_anggota'];

if(isset($_POST['simpan'])){

    $password_baru = $_POST['password'];

    /* VALIDASI PASSWORD */
    if(
        !preg_match(
            '/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[\W]).{8,}$/',
            $password_baru
        )
    ){

        echo "
        <script>
        alert('Password harus minimal 8 karakter serta mengandung huruf besar, huruf kecil, angka, dan simbol!');
        window.location='ganti-password.php';
        </script>
        ";

        exit();
    }

    $password = md5($password_baru);

    mysqli_query(

        $conn,

        "UPDATE anggota SET

        password='$password',

        first_login='0'

        WHERE id='$id'"

    );

    echo "
    <script>
    alert('Password berhasil diperbarui!');
    window.location='dashboard.php';
    </script>
    ";

}

?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<meta
name="viewport"
content="width=device-width, initial-scale=1.0">

<title>
Ganti Password GENBI
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

    padding:20px;
}

.password-card{

    background:white;

    width:100%;
    max-width:500px;

    border-radius:30px;

    padding:40px;

    box-shadow:
    0 20px 50px rgba(0,0,0,.20);

    text-align:center;
}

.icon-box{

    width:90px;
    height:90px;

    margin:auto;

    border-radius:50%;

    background:
    linear-gradient(
    135deg,
    #001F54,
    #004AAD
    );

    display:flex;

    align-items:center;
    justify-content:center;

    color:white;

    font-size:38px;

    margin-bottom:20px;
}

h2{

    font-weight:700;

    color:#001F54;

    margin-bottom:10px;
}

.subtitle{

    color:#64748b;

    margin-bottom:30px;
}

.form-control{

    border-radius:15px;

    padding:14px;

    border:1px solid #dbeafe;
}

.form-control:focus{

    border-color:#004AAD;

    box-shadow:
    0 0 0 .15rem rgba(0,74,173,.15);
}

.password-group{

    position:relative;
}

.password-group i{

    position:absolute;

    right:15px;

    top:50%;

    transform:translateY(-50%);

    cursor:pointer;

    color:#64748b;
}

.btn-save{

    width:100%;

    padding:14px;

    border:none;

    border-radius:15px;

    background:
    linear-gradient(
    135deg,
    #001F54,
    #004AAD
    );

    color:white;

    font-weight:600;

    transition:.3s;
}

.btn-save:hover{

    transform:translateY(-3px);

    box-shadow:
    0 10px 25px rgba(0,74,173,.25);
}

.alert-info{

    border-radius:15px;

    text-align:left;
}

@media(max-width:768px){

    .password-card{

        padding:25px;

    }

    h2{

        font-size:24px;

    }

}

.btn-back{

    display:block;

    width:100%;

    padding:14px;

    border-radius:15px;

    text-decoration:none;

    font-weight:600;

    color:#334155;

    background:#f1f5f9;

    transition:.3s;

}

.btn-back:hover{

    background:#e2e8f0;

    color:#0f172a;

    transform:translateY(-3px);

}

.alert-danger{

    display:flex;

    align-items:flex-start;

    gap:12px;

    border:none;

    border-radius:15px;

    background:#fee2e2;

    color:#991b1b;

    padding:15px 18px;

    font-size:14px;

    line-height:1.6;

    text-align:left;

}

.alert-danger i{

    font-size:22px;

    margin-top:2px;

    flex-shrink:0;

}

.alert-danger{

    background:#fef2f2;

    border-left:5px solid #ef4444;

    color:#991b1b;

    border-radius:12px;

    padding:15px;

    font-weight:500;

}

</style>

</head>

<body>

<div class="password-card">

<div class="icon-box">

<i class="fa-solid fa-key"></i>

</div>

<h2>

Ganti Password

</h2>

<p class="subtitle">

Demi keamanan akun GENBI anda, silakan buat ulang password baru Anda.

</p>

<div class="alert alert-info">

<i class="fa-solid fa-circle-info"></i>

Password minimal harus 8 karakter dan yang mudah di ingat oleh Anda. 

</div>

<form method="POST" onsubmit="return cekPassword()">

<div class="password-group mb-3">

<input
type="password"
id="password"
name="password"
class="form-control"
placeholder="Password Baru"
required
minlength="8">

<i
class="fa-solid fa-eye"
onclick="togglePassword('password',this)">
</i>

</div>

<div class="password-group mb-4">

<input
type="password"
id="konfirmasi"
class="form-control"
placeholder="Konfirmasi Password"
required>

<i
class="fa-solid fa-eye"
onclick="togglePassword('konfirmasi',this)">
</i>

</div>

<div
id="errorPassword"
class="alert alert-danger d-none mt-3">

</div>

<div class="d-grid gap-2 mt-3">

    <button
    type="submit"
    name="simpan"
    class="btn-save">

        <i class="fa-solid fa-floppy-disk"></i>

        Simpan Password

    </button>

    <a
    href="profil.php"
    class="btn-back">

        <i class="fa-solid fa-arrow-left"></i>

        Kembali ke Profil

    </a>

</div>

<script>

function togglePassword(id,icon){

let input =
document.getElementById(id);

if(input.type==="password"){

    input.type="text";

    icon.classList.remove("fa-eye");

    icon.classList.add("fa-eye-slash");

}else{

    input.type="password";

    icon.classList.remove("fa-eye-slash");

    icon.classList.add("fa-eye");

}

}

</script>

<script>

function cekPassword(){

let p1 =
document.getElementById("password").value;

let p2 =
document.getElementById("konfirmasi").value;

let errorBox =
document.getElementById("errorPassword");

errorBox.classList.add("d-none");

if(p1 !== p2){

    errorBox.innerHTML =
    "<i class='fa-solid fa-circle-exclamation'></i> Konfirmasi password tidak sama!";

    errorBox.classList.remove("d-none");

    return false;

}

let regex =
/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/;

if(!regex.test(p1)){

    errorBox.innerHTML = `
    <i class="fa-solid fa-shield-halved"></i>
    <div>
    Password harus minimal 8 karakter serta mengandung huruf besar, huruf kecil, angka, dan simbol.
    </div>
    `;

    errorBox.classList.remove("d-none");

    return false;

}

return true;

}

</script>

</body>
</html>