<?php

session_start();

include '../../config/koneksi.php';

$id = $_GET['id'];

mysqli_query(

    $conn,

    "DELETE FROM kegiatan_absensi
    WHERE id='$id'"

);

header("Location:index.php");

?>