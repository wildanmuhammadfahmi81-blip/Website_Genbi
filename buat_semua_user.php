<?php
include "config/koneksi.php";

$password = md5("123456");

// =========================
// SUPER ADMIN
// =========================
$cek = mysqli_query($conn,"SELECT * FROM users WHERE username='superadmin'");

if(mysqli_num_rows($cek)==0){

    mysqli_query($conn,"
        INSERT INTO users(username,password,role)
        VALUES(
            'superadmin',
            '$password',
            'superadmin'
        )
    ");

}

// =========================
// ADMIN
// =========================
$cek = mysqli_query($conn,"SELECT * FROM users WHERE username='admin'");

if(mysqli_num_rows($cek)==0){

    mysqli_query($conn,"
        INSERT INTO users(username,password,role)
        VALUES(
            'admin',
            '$password',
            'admin'
        )
    ");

}

// =========================
// SEMUA ANGGOTA
// =========================

$data = mysqli_query($conn,"SELECT * FROM anggota");

$berhasil = 0;
$gagal = 0;

while($row=mysqli_fetch_assoc($data)){

    $username = trim($row['username']);
    $anggota_id = $row['id'];

    if($username==""){
        continue;
    }

    $cek = mysqli_query($conn,"SELECT * FROM users WHERE username='$username'");

    if(mysqli_num_rows($cek)==0){

        mysqli_query($conn,"
            INSERT INTO users
            (username,password,role,anggota_id)
            VALUES
            (
                '$username',
                '$password',
                'anggota',
                '$anggota_id'
            )
        ");

        $berhasil++;

    }else{

        $gagal++;

    }

}

echo "<h2>SELESAI</h2>";

echo "Akun anggota dibuat : <b>$berhasil</b><br>";
echo "Sudah ada : <b>$gagal</b><br><br>";

echo "Username Superadmin : superadmin<br>";
echo "Username Admin : admin<br>";
echo "Password semua akun : 123456";
?>