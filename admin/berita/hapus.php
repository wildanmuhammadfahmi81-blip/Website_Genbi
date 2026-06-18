<?php

session_start();

include '../../config/koneksi.php';

/* CEK LOGIN */
if(!isset($_SESSION['login'])){
    header("Location: ../login.php");
    exit();
}

/* AMBIL ID */
$id = $_GET['id'];

/* AMBIL DATA GAMBAR */
$query = mysqli_query($conn,
    "SELECT * FROM berita WHERE id='$id'"
);

$data = mysqli_fetch_array($query);

/* HAPUS FILE GAMBAR */
if(file_exists("../../assets/upload/".$data['gambar'])){

    unlink("../../assets/upload/".$data['gambar']);

}

/* HAPUS DATABASE */
mysqli_query($conn,
    "DELETE FROM berita WHERE id='$id'"
);

/* KEMBALI */
header("Location: index.php");

exit();

?>