<?php
$conn = mysqli_connect(
    "localhost",
    "root",
    "",
    "genbi_db"
);

if(!$conn){
    die(mysqli_connect_error());
}
?>