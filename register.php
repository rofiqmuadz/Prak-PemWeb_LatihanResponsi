<?php
require "koneksi.php";

if (isset($_POST["register"])) {
    $username = $_POST["username"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $query = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
    if (mysqli_query($koneksi, $query)) {
        header("Location: login.php");
        exit;
    } else {
        echo "<script>alert('Username sudah digunakan!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="auth-wrapper">

<div class="auth-card">
    <h3 class="text-center mb-4">Register</h3>

    <form action="" method="POST">
        <label>Username</label>
        <input type="text" name="username" class="form-control mb-3" required>

        <label>Password</label>
        <input type="password" name="password" class="form-control mb-3" required>

        <button class="btn btn-register mb-3" name="register">Register</button>

        <p class="text-center">
            Sudah punya akun? <a href="login.php">Login</a>
        </p>
    </form>
</div>

</body>
</html>
