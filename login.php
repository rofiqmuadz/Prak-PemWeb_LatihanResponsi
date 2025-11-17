<?php
require "koneksi.php";

if (isset($_SESSION["user"])) {
    header("Location: dashboard.php");
    exit;
}

$alert = "";

if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username'");

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row["password"])) {
            $_SESSION["user"] = $row["id"];
            header("Location: dashboard.php");
            exit;
        } else {
            $alert = '<div class="alert alert-danger">Password salah!</div>';
        }
    } else {
        $alert = '<div class="alert alert-danger">Username tidak ditemukan!</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="auth-wrapper">

<div class="auth-card">
    <h3 class="text-center mb-4">Login</h3>

    <?= !empty($alert) ? $alert : "" ?>

    <form method="POST">

        <label>Username</label>
        <input type="text" name="username" class="form-control mb-3" required>

        <label>Password</label>
        <input type="password" name="password" class="form-control mb-3" required>

        <button class="btn btn-primary btn-login mb-3" name="login">Login</button>

        <p class="text-center">
            Belum punya akun? <a href="register.php">Register</a>
        </p>
    </form>
</div>

</body>
</html>
