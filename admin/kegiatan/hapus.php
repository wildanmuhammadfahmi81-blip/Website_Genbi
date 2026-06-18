<?php

include '../../config/koneksi.php';

$id = $_GET['id'];

/* AMBIL DATA */
$query = mysqli_query(
    $conn,
    "SELECT * FROM kegiatan WHERE id='$id'"
);

$data = mysqli_fetch_array($query);

/* CEK FILE ADA */
$file = "../../assets/upload/kegiatan/".$data['gambar'];

if(file_exists($file)){

    unlink($file);

}

/* HAPUS DATABASE */
mysqli_query(
    $conn,
    "DELETE FROM kegiatan WHERE id='$id'"
);

/* KEMBALI */
header("Location:index.php");
exit;

?>