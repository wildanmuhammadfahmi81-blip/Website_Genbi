<?php

session_start();

session_destroy();

/* KEMBALI KE HALAMAN UTAMA */
header("Location: ../index.php");

exit();

?>