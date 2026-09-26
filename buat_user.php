<?php
include "config/koneksi.php";

$password = md5("123456");

$data = mysqli_query($conn, "SELECT * FROM anggota");

$berhasil = 0;
$gagal = 0;

while($row = mysqli_fetch_assoc($data)){

    $id = $row['id'];
    $username = trim($row['username']);

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
                '$id'
            )
        ");

        $berhasil++;

    }else{

        $gagal++;

    }

}

echo "<h2>Selesai</h2>";
echo "Berhasil dibuat : <b>$berhasil</b> akun<br>";
echo "Sudah ada : <b>$gagal</b> akun";
?>