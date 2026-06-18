<?php

session_start();

include 'config/koneksi.php';

$nama  = $_POST['nama'];

$pesan = $_POST['pesan'];

mysqli_query(

    $conn,

    "INSERT INTO pesan_kesan (

        nama,
        pesan

    ) VALUES (

        '$nama',
        '$pesan'

    )"

);

$_SESSION['success'] = "Pesan berhasil dikirim!";

header("Location:index.php?contact=success#contact");

exit();

?>