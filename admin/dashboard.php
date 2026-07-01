<?php
session_start();

if(!isset($_SESSION['login'])){
    header("Location: ../login.php");
    exit;
}

include "../connect.php";

$produk=mysqli_fetch_row(mysqli_query($id,"SELECT COUNT(*) FROM product"));
$kategori=mysqli_fetch_row(mysqli_query($id,"SELECT COUNT(*) FROM category"));
?>

<!DOCTYPE html>
<html>
<head>

<title>Dashboard Admin</title>

<link rel="stylesheet" href="../assets/style.css">

</head>

<body>

<div class="sidebar">

<h2>🌸 BEAUTY</h2>

<a href="dashboard.php">🏠 Dashboard</a>

<a href="produk.php">🧴 Produk</a>

<a href="kategori.php">🏷 Kategori</a>

<a href="pesanan.php">📦 Pesanan</a>

<a href="../logout.php">🚪 Logout</a>

</div>

<div class="main">

<div class="top">

<h1>Dashboard Admin</h1>

<div class="admin">

Halo,

<b><?php echo $_SESSION['username']; ?></b>

</div>

</div>

<div class="cards">

<div class="box">

<h3>Total Produk</h3>

<h1><?php echo $produk[0]; ?></h1>

</div>

<div class="box">

<h3>Total Kategori</h3>

<h1><?php echo $kategori[0]; ?></h1>

</div>

<div class="box">

<h3>Status</h3>

<h1>Aktif</h1>

</div>

</div>

<h2>Menu Cepat</h2>

<div class="menu">

<a href="produk.php">

🧴

<h3>Kelola Produk</h3>

<p>Tambah, Edit dan Hapus Produk</p>

</a>

<a href="kategori.php">

🏷

<h3>Kelola Kategori</h3>

<p>Kelola seluruh kategori</p>

</a>

<a href="pesanan.php">

📦

<h3>Kelola Pesanan</h3>

<p>Lihat seluruh transaksi</p>

</a>

</div>

</div>

</body>
</html>