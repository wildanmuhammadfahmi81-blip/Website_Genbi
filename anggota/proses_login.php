<?php
session_start();

include "../config/koneksi.php";

$username = mysqli_real_escape_string($conn,$_POST['username']);
$password = md5($_POST['password']);

$query = mysqli_query($conn,"
SELECT *
FROM users
WHERE username='$username'
AND password='$password'
AND role='anggota'
");

if(mysqli_num_rows($query)>0){

    $user = mysqli_fetch_assoc($query);

    $_SESSION['login_anggota']=true;
    $_SESSION['user_id']=$user['id'];
    $_SESSION['anggota_id']=$user['anggota_id'];

    header("Location: dashboard.php");

}else{

    echo "<script>
    alert('Username atau Password Salah');
    window.location='login.php';
    </script>";

}