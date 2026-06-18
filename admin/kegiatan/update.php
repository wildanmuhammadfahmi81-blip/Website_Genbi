<?php

session_start();

include '../../config/koneksi.php';

$id         = $_POST['id'];
$judul      = $_POST['judul'];
$tanggal    = $_POST['tanggal'];
$deskripsi  = $_POST['deskripsi'];

$gambar = $_FILES['gambar']['name'];

if($gambar != ""){

    $tmp = $_FILES['gambar']['tmp_name'];

    move_uploaded_file(
        $tmp,
        "../../assets/upload/kegiatan/".$gambar
    );

    mysqli_query(
        $conn,
        "UPDATE kegiatan SET

        judul      = '$judul',
        tanggal    = '$tanggal',
        deskripsi  = '$deskripsi',
        gambar     = '$gambar'

        WHERE id='$id'"
    );

}else{

    mysqli_query(
        $conn,
        "UPDATE kegiatan SET

        judul      = '$judul',
        tanggal    = '$tanggal',
        deskripsi  = '$deskripsi'

        WHERE id='$id'"
    );

}

/* SWEET ALERT */
$_SESSION['success'] = "Kegiatan berhasil diupdate!";

header("Location:index.php");
exit();

?>