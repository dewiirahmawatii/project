<?php

session_start();

if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit;
}

include "../connect.php";

/* ===========================
   STATISTIK
=========================== */

$product = mysqli_fetch_row(
    mysqli_query($connect, "SELECT COUNT(*) FROM product")
);

$kategori = mysqli_fetch_row(
    mysqli_query($connect, "SELECT COUNT(*) FROM category")
);

$pesanan = mysqli_fetch_row(
    mysqli_query($connect, "SELECT COUNT(*) FROM orders")
);

/* ===========================
   TOTAL PENDAPATAN
=========================== */

$pendapatan = mysqli_fetch_row(
    mysqli_query($connect, "SELECT SUM(total) FROM orders")
);

if ($pendapatan[0] == NULL) {
    $pendapatan[0] = 0;
}

/* ===========================
   PESANAN TERBARU
=========================== */

$order = mysqli_query(
    $connect,
    "SELECT * FROM orders
    ORDER BY order_date DESC
    LIMIT 5"
);

?>

<?php
$username = $_SESSION['username'] ?? 'Admin';
?>

<!DOCTYPE html>

<html lang="id">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Dashboard Admin</title>

<link rel="stylesheet" href="../assets/style.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

</head>

<body>

<div class="admin">

<!-- ===========================
     SIDEBAR
=========================== -->

<div class="sidebar">

<h2>🌸 BEAUTY</h2>

<a href="dashboard.php" class="active">

<i class="fa-solid fa-house"></i>

Dashboard

</a>

<a href="produk.php">

<i class="fa-solid fa-box-open"></i>

Produk

</a>

<a href="kategori.php">

<i class="fa-solid fa-tags"></i>

Kategori

</a>

<a href="pesanan.php">

<i class="fa-solid fa-cart-shopping"></i>

Pesanan

</a>

<a href="../logout.php">

<i class="fa-solid fa-right-from-bracket"></i>

Logout

</a>

</div>

<!-- ===========================
     CONTENT
=========================== -->

<div class="content">

<div class="topbar">

<div>

<h1>

Dashboard Admin

</h1>

<p>
    Selamat Datang,
    <b><?= htmlspecialchars($username); ?></b> 👋
</p>

<img src="https://ui-avatars.com/api/?background=ff5fa2&color=fff&name=<?= urlencode($username); ?>">

<b>

<?= isset($_SESSION['username']) ? $_SESSION['username'] : 'Admin'; ?>

</b>

👋

</p>

</div>

<div class="profile-admin">

<img
src="https://ui-avatars.com/api/?background=ff5fa2&color=fff&name=<?= urlencode($username); ?>">

</div>

</div>

<!-- ===========================
     CARD
=========================== -->

<div class="cards">

<div class="card pink">

<div>

<h4>Total Produk</h4>

<h1>

<?php echo $product[0];?>

</h1>

</div>

<i class="fa-solid fa-box"></i>

</div>

<div class="card blue">

<div>

<h4>Total Kategori</h4>

<h1>

<?php echo $kategori[0];?>

</h1>

</div>

<i class="fa-solid fa-layer-group"></i>

</div>

<div class="card orange">

<div>

<h4>Total Pesanan</h4>

<h1>

<?php echo $pesanan[0];?>

</h1>

</div>

<i class="fa-solid fa-cart-shopping"></i>

</div>

<div class="card green">

<div>

<h4>Pendapatan</h4>

<h2>

Rp <?php echo number_format($pendapatan[0]);?>

</h2>

</div>

<i class="fa-solid fa-wallet"></i>

</div>

</div>

<!-- ===========================
     PESANAN TERBARU
=========================== -->

<div class="table-card">

<div class="table-title">

<h2>

📦 Pesanan Terbaru

</h2>

</div>

<table class="produk-table">

<tr>

<th>Nama</th>

<th>No HP</th>

<th>Status</th>

<th>Tanggal</th>

</tr>

<?php

while($row=mysqli_fetch_assoc($order))
{

?>

<tr>

<td>

<?php echo $row['customer_name'];?>

</td>

<td>

<?php echo $row['customer_phone'];?>

</td>

<td>

<span class="badge">

<?php echo $row['status'];?>

</span>

</td>

<td>

<?php echo $row['order_date'];?>

</td>

</tr>

<?php

}

?>
</table>

</div>

<!-- ===========================
     QUICK MENU
=========================== -->

<div class="quick-menu">

<div class="menu-box">

<div class="menu-icon pink">

🧴

</div>

<h3>Kelola Produk</h3>

<p>

Tambah, Edit dan Hapus Produk

</p>

<a href="produk.php">

Buka →

</a>

</div>

<div class="menu-box">

<div class="menu-icon blue">

🏷

</div>

<h3>Kelola Kategori</h3>

<p>

Atur seluruh kategori skincare

</p>

<a href="kategori.php">

Buka →

</a>

</div>

<div class="menu-box">

<div class="menu-icon orange">

📦

</div>

<h3>Pesanan</h3>

<p>

Lihat seluruh transaksi pelanggan

</p>

<a href="pesanan.php">

Buka →

</a>

</div>

</div>

<!-- ===========================
     INFORMASI
=========================== -->

<div class="info-grid">

<div class="info-card">

<h2>

📈 Statistik Hari Ini

</h2>

<div class="info-item">

<span>Produk</span>

<b>

<?php echo $product[0]; ?>

</b>

</div>

<div class="info-item">

<span>Kategori</span>

<b>

<?php echo $kategori[0]; ?>

</b>

</div>

<div class="info-item">

<span>Pesanan</span>

<b>

<?php echo $pesanan[0]; ?>

</b>

</div>

</div>

<div class="info-card">

<h2>

💡 Tips Admin

</h2>

<ul class="tips">

<li>✔ Selalu update stok produk.</li>

<li>✔ Tambahkan produk baru secara rutin.</li>

<li>✔ Cek pesanan setiap hari.</li>

<li>✔ Pastikan foto produk berkualitas.</li>

<li>✔ Perbarui kategori jika ada produk baru.</li>

</ul>

</div>

</div>

<!-- ===========================
     FOOTER
=========================== -->

<div class="dashboard-footer">

🌸 Beauty Skincare Admin Panel

<br>

<small>

© 2026 All Rights Reserved

</small>

</div>

</div>

</div>

</body>

</html>