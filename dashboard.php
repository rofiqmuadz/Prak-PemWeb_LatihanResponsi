<?php
require "koneksi.php";
if (!isset($_SESSION["user"])) { header("Location: login.php"); exit; }

$kue = mysqli_query($koneksi, "SELECT * FROM kue ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<!-- NAVBAR -->
<div class="navbar-dashboard">
    <a href="logout.php" class="logout-btn">Logout</a>
</div>

<div class="dashboard-container">

    <div class="kue-title">Katalog Kue</div>

    <div class="row">
        <?php while ($row = mysqli_fetch_assoc($kue)) : ?>
        <div class="col-md-3 mb-4">
            <div class="card kue-card">
                <img src="uploads/<?= $row['foto']; ?>" class="card-img-top">

                <div class="card-body">
                    <h6 class="card-title text-capitalize"><?= $row['nama']; ?></h6>
                    <p>Harga: Rp <?= number_format($row['harga']); ?></p>
                    <p>Stok: <?= $row['stok']; ?></p>

                    <a href="edit_kue.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="hapus_kue.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm"
                       onclick="return confirm('Yakin hapus?')">
                        Hapus
                    </a>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
    </div>

    <a href="tambah_kue.php" class="btn btn-primary">Tambah Kue</a>
</div>

</body>
</html>
