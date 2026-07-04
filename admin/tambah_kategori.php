```php
<?php

session_start();

if(!isset($_SESSION['login']))
{
    header("Location:../login.php");
    exit;
}

include "../connect.php";

if(isset($_POST['simpan']))
{
    $kategori = $_POST['kategori'];

    mysqli_query(
        $connect,
        "INSERT INTO category(category)
        VALUES('$kategori')"
    );

    header("Location:kategori.php");
    exit;
}

?>

<!DOCTYPE html>

<html>

<head>

<meta charset="UTF-8">

<title>Tambah Kategori</title>

<link rel="stylesheet" href="../assets/style.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

</head>

<body>

<div class="admin">

<!-- SIDEBAR -->

<div class="sidebar">

<h2>🌸 BEAUTY</h2>

<a href="dashboard.php">
<i class="fa fa-home"></i>
Dashboard
</a>

<a href="produk.php">
<i class="fa fa-box"></i>
Produk
</a>

<a href="kategori.php" class="active">
<i class="fa fa-tags"></i>
Kategori
</a>

<a href="pesanan.php">
<i class="fa fa-cart-shopping"></i>
Pesanan
</a>

<a href="../logout.php">
Logout
</a>

</div>

<!-- CONTENT -->

<div class="content">

<div class="topbar">

<h1>

Tambah Kategori

</h1>

<a href="kategori.php" class="btn-add">

← Kembali

</a>

</div>

<form method="POST" class="form-produk">

<label>

Nama Kategori

</label>

<input
type="text"
name="kategori"
placeholder="Masukkan Nama Kategori"
required>

<button
type="submit"
name="simpan"
class="btn-save">

<i class="fa fa-floppy-disk"></i>

Simpan Kategori

</button>

</form>

</div>

</div>

</body>

</html>
```
