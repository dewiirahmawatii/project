<?php
session_start();
include "connect.php";

if (isset($_POST['login'])) {

    $username = mysqli_real_escape_string($connect, $_POST['username']);
    $password = mysqli_real_escape_string($connect, $_POST['password']);

    $query = mysqli_query(
        $connect,
        "SELECT * FROM admin WHERE username='$username' AND password='$password'"
    );

    if (mysqli_num_rows($query) > 0) {

        $admin = mysqli_fetch_assoc($query);

        $_SESSION['login'] = true;
        $_SESSION['username'] = $admin['username'];

        header("Location: admin/dashboard.php");
        exit;

    } else {

        $error = "Username atau Password salah!";

    }
}
?>

<!DOCTYPE html>
<html>

<head>

<title>Login Admin</title>

<link rel="stylesheet" href="assets/style.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>

<body class="login-body">

<div class="login-container">

<div class="login-left">

<h1>Beauty Skincare</h1>

<p>

Kelola produk, kategori, dan pesanan
dalam satu dashboard modern.

</p>

<img src="images/logo2.png">

</div>

<div class="login-right">

<form method="POST">

<h2>Admin Login</h2>

<?php

if(isset($error))
{
    echo "<div class='alert'>$error</div>";
}

?>

<input
type="text"
name="username"
placeholder="Username"
required>

<input
type="password"
name="password"
placeholder="Password"
required>

<button
type="submit"
name="login">

Login

</button>

<a href="index.php">

← Kembali ke Toko

</a>

</form>

</div>

</div>

</body>

</html>