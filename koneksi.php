<?php
session_start();

$host = "localhost";
$user = "root";  
$pass = "";
$db   = "toko_roti";
$port = 8111;

$koneksi = mysqli_connect($host, $user, $pass, $db, $port);

if (!$koneksi) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}
?>

