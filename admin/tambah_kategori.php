<?php
session_start();
include "../connect.php";

if(isset($_POST['simpan']))
{
    $kategori=$_POST['kategori'];

    mysqli_query($connect,
    "INSERT INTO category(category)
    VALUES('$kategori')");

    header("Location:kategori.php");
}
?>

<!DOCTYPE html>
<html>

<head>
<div class="card-form">

    <h2>Tambah Kategori</h2>

    <form action="process_category.php" method="POST">

        <input type="text" name="category" placeholder="Nama Kategori" required>

        <div class="btn-group">
            <button type="submit" class="btn-save">
                Simpan
            </button>

            <a href="kategori.php" class="btn-back">
                Kembali
            </a>
        </div>

    </form>

</div>
<title>Tambah Kategori</title>

<link rel="stylesheet" href="../assets/style.css">

</head>

<body>

<div class="card-form">

<h2>Tambah Kategori</h2>

<form method="POST">

<input
type="text"
name="kategori"
placeholder="Nama Kategori"
required>

<br><br>

<button
type="submit"
name="simpan"
class="btn-save">

Simpan

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