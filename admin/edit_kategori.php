<?php

session_start();

include "../connect.php";

$code=$_GET['code'];

$data=mysqli_fetch_assoc(

mysqli_query(
$connect,
"SELECT *
FROM category
WHERE code='$code'"

)

);

if(isset($_POST['update']))
{

$kategori=$_POST['kategori'];

mysqli_query(

$connect,

"UPDATE category
SET category='$kategori'
WHERE code='$code'"

);

header("Location:kategori.php");

}

?>

<!DOCTYPE html>

<html>

<head>

<title>Edit Kategori</title>

<link rel="stylesheet" href="../assets/style.css">

</head>

<body>

<div class="card-form">

<h2>Edit Kategori</h2>

<form method="POST">

<input

type="text"

name="kategori"

value="<?php echo $data['category'];?>"

required>

<br><br>

<button

type="submit"

name="update"

class="btn-save">

Update

</button>

<a

href="kategori.php"

class="btn-back">

Kembali

</a>

</form>

</div>

</body>

</html>