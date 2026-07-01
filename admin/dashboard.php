<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location:../login.php");
    exit;
}

include "../connect.php";

// ======================
// TOTAL PRODUK
// ======================
$queryProduct = mysqli_query($id, "SELECT COUNT(*) AS total FROM product");
$product = mysqli_fetch_assoc($queryProduct);

// ======================
// TOTAL KATEGORI
// ======================
$queryCategory = mysqli_query($id, "SELECT COUNT(*) AS total FROM category");
$category = mysqli_fetch_assoc($queryCategory);

// ======================
// TOTAL PESANAN
// ======================
$queryOrder = mysqli_query($id, "SELECT COUNT(*) AS total FROM orders");
$order = mysqli_fetch_assoc($queryOrder);
?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

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

<div>

Halo,
<b><?php echo $_SESSION['username']; ?></b>

</div>

</div>

<div class="cards">

<div class="box">

<h3>Total Produk</h3>

<h1><?php echo $product['total']; ?></h1>

</div>

<div class="box">

<h3>Total Kategori</h3>

<h1><?php echo $category['total']; ?></h1>

</div>

<div class="box">

<h3>Total Pesanan</h3>

<h1><?php echo $order['total']; ?></h1>

</div>

</div>

<h2 style="margin-bottom:20px;">Menu Cepat</h2>

<div class="menu">

<a href="produk.php">

<h1>🧴</h1>

<h3>Kelola Produk</h3>

<p>Tambah, Edit dan Hapus Produk</p>

</a>

<a href="kategori.php">

<h1>🏷</h1>

<h3>Kelola Kategori</h3>

<p>Tambah, Edit dan Hapus Kategori</p>

</a>

<a href="pesanan.php">

<h1>📦</h1>

<h3>Kelola Pesanan</h3>

<p>Lihat seluruh transaksi</p>

</a>

</div>

</div>

</body>

</html>