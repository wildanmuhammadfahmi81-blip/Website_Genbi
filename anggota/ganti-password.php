<?php

session_start();

include '../config/koneksi.php';

if(!isset($_SESSION['anggota'])){

    header("Location:login.php");

    exit();

}

$id = $_SESSION['id_anggota'];

if(isset($_POST['simpan'])){

    $password = md5($_POST['password']);

    mysqli_query(

        $conn,

        "UPDATE anggota SET

        password='$password',

        first_login='0'

        WHERE id='$id'"

    );

    header("Location:dashboard.php");

}

?>

<!DOCTYPE html>
<html>
<head>

<title>Ganti Password</title>

<link
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">

</head>

<body>

<div class="container py-5">

<div class="card p-4">

<h3>

Ganti Password Pertama

</h3>

<form method="POST">

<input
type="password"
name="password"
class="form-control mb-3"
placeholder="Password Baru"
required>

<button
name="simpan"
class="btn btn-primary">

Simpan

</button>

</form>

</div>

</div>

</body>
</html>