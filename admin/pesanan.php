<?php

session_start();

if(!isset($_SESSION['admin']))
{
header("Location:login.php");
}

include 'connect.php';

?>

<!DOCTYPE html>

<html>
<head>

<title>Data Pesanan</title>

<link rel="stylesheet" href="style.css">

</head>

<body>

<div class="sidebar">

<h2>🌸 BEAUTY</h2>

<a href="dashboard.php">Dashboard</a>

<a href="produk.php">Produk</a>

<a href="kategori.php">Kategori</a>

<a href="pesanan.php">Pesanan</a>

<a href="logout.php">Logout</a>

</div>

<div class="main">

<h1>📦 Data Pesanan</h1>

<table>

<tr>

<th>ID</th>

<th>Nama</th>

<th>HP</th>

<th>Alamat</th>

<th>Tanggal</th>

<th>Status</th>

</tr>

<?php

$order=mysqli_query(
$id,
"SELECT * FROM orders
ORDER BY id DESC"
);

while($row=mysqli_fetch_assoc($order))
{
?>

<tr>

<td><?php echo $row['id']; ?></td>

<td><?php echo $row['customer_name']; ?></td>

<td><?php echo $row['customer_phone']; ?></td>

<td><?php echo $row['customer_address']; ?></td>

<td><?php echo $row['order_date']; ?></td>

<td><?php echo $row['status']; ?></td>

</tr>

<?php
}
?>

</table>

</div>

</body>
</html>
