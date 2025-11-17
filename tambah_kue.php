<?php
require "koneksi.php";
if (!isset($_SESSION["user"])) { header("Location: login.php"); exit; }

if (isset($_POST["submit"])) {
    $nama = $_POST["nama"];
    $harga = $_POST["harga"];
    $stok = $_POST["stok"];

    $foto = $_FILES["foto"]["name"];
    $tmp = $_FILES["foto"]["tmp_name"];
    $ext = pathinfo($foto, PATHINFO_EXTENSION);
    $newName = uniqid() . "." . $ext;

    move_uploaded_file($tmp, "uploads/" . $newName);

    mysqli_query($koneksi, "INSERT INTO kue (nama,harga,stok,foto) VALUES ('$nama','$harga','$stok','$newName')");
    header("Location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Kue</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="form-wrapper">
    <div class="form-card">
        <h4 class="mb-4">Tambah Kue</h4>

        <form method="POST" enctype="multipart/form-data">

            <label>Foto</label>
            <input type="file" name="foto" class="form-control mb-3" required>

            <label>Nama Kue</label>
            <input type="text" name="nama" class="form-control mb-3" required>

            <label>Harga</label>
            <input type="number" name="harga" class="form-control mb-3" required>

            <label>Stok</label>
            <input type="number" name="stok" class="form-control mb-3" required>

            <button class="btn btn-primary" name="submit">Tambah</button>
            <a href="dashboard.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>

</body>
</html>
