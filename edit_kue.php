<?php
require "koneksi.php";
if (!isset($_SESSION["user"])) { header("Location: login.php"); exit; }

$id = $_GET["id"];
$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM kue WHERE id=$id"));

if (isset($_POST["submit"])) {
    $nama = $_POST["nama"];
    $harga = $_POST["harga"];
    $stok = $_POST["stok"];
    $fotoLama = $data["foto"];

    if ($_FILES["foto"]["name"] !== "") {
        $ext = pathinfo($_FILES["foto"]["name"], PATHINFO_EXTENSION);
        $newName = uniqid() . "." . $ext;

        move_uploaded_file($_FILES["foto"]["tmp_name"], "uploads/" . $newName);
        unlink("uploads/" . $fotoLama);
    } else {
        $newName = $fotoLama;
    }

    mysqli_query($koneksi, "UPDATE kue SET 
                            nama='$nama', 
                            harga='$harga',
                            stok='$stok',
                            foto='$newName'
                            WHERE id=$id");

    header("Location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Kue</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="edit-wrapper">
    <div class="edit-card">
        <h4 class="mb-4">Edit Kue</h4>

        <label class="fw-bold">Foto Lama:</label><br>
        <img src="uploads/<?= $data['foto']; ?>" class="old-photo"><br><br>

        <form method="POST" enctype="multipart/form-data">

            <label class="fw-bold">Ganti Foto (Opsional)</label>
            <input type="file" name="foto" class="form-control mb-3">

            <label>Nama Kue</label>
            <input type="text" name="nama" value="<?= $data['nama']; ?>" class="form-control mb-3" required>

            <label>Harga</label>
            <input type="number" name="harga" value="<?= $data['harga']; ?>" class="form-control mb-3" required>

            <label>Stok</label>
            <input type="number" name="stok" value="<?= $data['stok']; ?>" class="form-control mb-3" required>

            <button class="btn btn-warning" name="submit">Simpan Perubahan</button>
            <a href="dashboard.php" class="btn btn-secondary">Kembali</a>

        </form>
    </div>
</div>

</body>
</html>
