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

        header("Location: admin/dashboard.php");
        exit;
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

<link rel="stylesheet" href="style.css">

</head>

<body class="login-body">

<div class="login-box">

<h1>BEAUTY</h1>

<p>Admin Login</p>

<?php
if(isset($error))
{
    echo "<div class='error'>$error</div>";
}
?>

<form method="POST">

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

</form>

<br>

<a href="index.php">
← Kembali ke Halaman User
</a>

</div>

</body>
</html>