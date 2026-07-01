<?php

session_start();

if(!isset($_SESSION['admin']))
{
    header("Location:login.php");
}

include 'connect.php';

$totalKategori=mysqli_num_rows(
mysqli_query($id,"SELECT * FROM category")
);

$totalProduk=mysqli_num_rows(
mysqli_query($id,"SELECT * FROM product")
);

$totalPesanan=mysqli_num_rows(
mysqli_query($id,"SELECT * FROM orders")
);

?>

<!DOCTYPE html>

<html>

<head>

<title>Beauty Skincare Dashboard</title>

<link rel="stylesheet" href="style.css">

</head>

<body>

<div class="sidebar">

<h2>🌸 BEAUTY</h2>

<a href="dashboard.php">📊 Dashboard</a>

<a href="produk.php">🧴 Produk</a>

<a href="kategori.php">🏷️ Kategori</a>

<a href="pesanan.php">📦 Pesanan</a>

<a href="logout.php">🚪 Logout</a>

</div>

<div class="main">

<div class="dashboard-hero">

<h1>🌸 BEAUTY SKINCARE ADMIN</h1>

<p>
Kelola produk, kategori, dan pesanan pelanggan
</p>

</div>

<div class="dashboard-grid">

<div class="dash-card">

<div class="icon">🧴</div>

<h2>
<?php echo $totalProduk; ?>
</h2>

<p>Total Produk</p>

</div>

<div class="dash-card">

<div class="icon">🏷️</div>

<h2>
<?php echo $totalKategori; ?>
</h2>

<p>Total Kategori</p>

</div>

<div class="dash-card">

<div class="icon">📦</div>

<h2>
<?php echo $totalPesanan; ?>
</h2>

<p>Total Pesanan</p>

</div>

</div>

<div class="quick-menu">

<a href="produk.php" class="menu-card">

🧴

<h3>Kelola Produk</h3>

</a>

<a href="kategori.php" class="menu-card">

🏷️

<h3>Kelola Kategori</h3>

</a>

<a href="pesanan.php" class="menu-card">

📦

<h3>Lihat Pesanan</h3>

</a>

</div>

</div>

</body>

</html>
