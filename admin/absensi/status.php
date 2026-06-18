<?php
session_start();
include '../../config/koneksi.php';

if(!isset($_SESSION['login'])){
    header("Location:../login.php");
    exit();
}

$id = isset($_GET['id']) ? $_GET['id'] : '';
$status_baru = isset($_GET['set']) ? $_GET['set'] : '';

if($id != '' && ($status_baru == 'Buka' || $status_baru == 'Tutup')){
    
    // Update status absensi kegiatan di database
    $query = mysqli_query($conn, "UPDATE kegiatan_absensi SET status='$status_baru' WHERE id='$id'");
    
    if($query){
        $_SESSION['success'] = "Status absensi berhasil diubah menjadi <b>$status_baru</b>!";
    } else {
        $_SESSION['error'] = "Gagal mengubah status.";
    }
}

header("Location: index.php");
exit();
?>
