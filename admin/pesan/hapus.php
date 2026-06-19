<?php

session_start();

include '../../config/koneksi.php';

if(!isset($_SESSION['login'])){

    header("Location:../login.php");
    exit();

}

$id = $_GET['id'];

mysqli_query(

    $conn,

    "DELETE FROM pesan_kesan
    WHERE id='$id'"

);

header("Location:index.php?hapus=success");
exit();

?>