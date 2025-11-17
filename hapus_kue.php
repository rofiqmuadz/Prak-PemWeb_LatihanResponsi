<?php
require "koneksi.php";
if (!isset($_SESSION["user"])) { header("Location: login.php"); exit; }

$id = $_GET["id"];
$row = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT foto FROM kue WHERE id=$id"));

unlink("uploads/" . $row["foto"]);
mysqli_query($koneksi, "DELETE FROM kue WHERE id=$id");

header("Location: dashboard.php");
exit;
?>

it;
?>