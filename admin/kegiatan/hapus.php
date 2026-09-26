<?php
session_start();

// Proteksi agar hanya user yang login yang bisa menghapus
if(!isset($_SESSION['login'])){
    header("Location: ../login.php");
    exit();
}

include '../../config/koneksi.php';

// Menangkap ID dan mencegah SQL Injection
$id = mysqli_real_escape_string($conn, $_GET['id']);

/* AMBIL DATA DARI DATABASE */
$query = mysqli_query($conn, "SELECT * FROM kegiatan WHERE id='$id'");
$data = mysqli_fetch_array($query);

if($data) {
    /* CEK & HAPUS FILE GAMBAR FUSIK */
    // Pastikan field gambar tidak kosong sebelum mencoba menghapus file
    if(!empty($data['gambar'])) {
        $file = "../../assets/upload/kegiatan/".$data['gambar'];
        if(file_exists($file)){
            unlink($file);
        }
    }

    /* HAPUS DATA DARI DATABASE */
    $delete = mysqli_query($conn, "DELETE FROM kegiatan WHERE id='$id'");

    // Jika berhasil dihapus, kirim notifikasi SweetAlert ke halaman index
    if($delete) {
        $_SESSION['success'] = "Data kegiatan beserta foto berhasil dihapus!";
    }
}

/* KEMBALI KE HALAMAN INDEX */
header("Location: index.php");
exit();
?>