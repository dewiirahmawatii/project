<?php
session_start();
include 'connect.php';

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
        $_SESSION['admin']=$username;
        header("Location:dashboard.php");
    }
    else
    {
        echo "Login Gagal";
    }
}
?>

<html>
<head>
<title>Login Admin</title>
<link rel="stylesheet" href="style.css">
</head>

<body>

<div class="login-box">

<h1>🌸 BEAUTY ADMIN</h1>

<form method="POST">

<input
type="text"
name="username"
placeholder="Username">

<input
type="password"
name="password"
placeholder="Password">

<button
type="submit"
name="login">
LOGIN
</button>

</form>

</div>

</body>
</html>