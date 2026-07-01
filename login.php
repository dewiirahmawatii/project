<?php
session_start();
include "connect.php";

if(isset($_POST['login']))
{
    $username=$_POST['username'];
    $password=$_POST['password'];

    $sql="SELECT * FROM admin
          WHERE username='$username'
          AND password='$password'";

    $result=mysqli_query($id,$sql);

    if(mysqli_num_rows($result)>0)
    {
        $_SESSION['login']=true;
        $_SESSION['username']=$username;

        header("Location:admin/dashboard.php");
    }
    else
    {
        $error="Username atau Password Salah!";
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

<h1>🌸 Beauty Skincare</h1>

<p>

Kelola produk, kategori, dan pesanan
dalam satu dashboard modern.

</p>

<img src="images/serum.jpg">

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