<?php
session_start();
include '../../config/koneksi.php';

// Proteksi agar hanya user yang login yang bisa menghapus
if(!isset($_SESSION['login'])){
    header("Location: ../login.php");
    exit();
}

// Menangkap ID dan mencegah SQL Injection
$id = mysqli_real_escape_string($conn, $_GET['id']);

/* AMBIL DATA DARI DATABASE */
$query = mysqli_query($conn, "SELECT * FROM berita WHERE id='$id'");
$data = mysqli_fetch_array($query);

if($data) {
    /* 1. CEK & HAPUS FILE GAMBAR UTAMA (COVER) */
    if(!empty($data['gambar'])) {
        $file_gambar = "../../assets/upload/".$data['gambar'];
        if(file_exists($file_gambar)){
            unlink($file_gambar);
        }
    }

    /* 2. CEK & HAPUS FILE GAMBAR ISI (Jika Ada) */
    if(!empty($data['gambar_isi'])) {
        $file_gambar_isi = "../../assets/upload/".$data['gambar_isi'];
        if(file_exists($file_gambar_isi)){
            unlink($file_gambar_isi);
        }
    }

    /* 3. HAPUS DATA DARI DATABASE */
    $delete = mysqli_query($conn, "DELETE FROM berita WHERE id='$id'");

    // Jika berhasil dihapus, kirim notifikasi SweetAlert ke halaman index
    if($delete) {
        $_SESSION['success'] = "Data berita beserta foto berhasil dihapus permanen!";
    }
}

/* KEMBALI KE HALAMAN INDEX */
header("Location: index.php");
exit();
?>