<?php

session_start();

if(!isset($_SESSION['login']))
{
    header("Location:../login.php");
    exit;
}

include "../connect.php";

$sql="SELECT * FROM orders ORDER BY order_date DESC";

$result=mysqli_query($id,$sql);

?>

<!DOCTYPE html>

<html>

<head>

<meta charset="UTF-8">

<title>Kelola Pesanan</title>

<link rel="stylesheet" href="../assets/style.css">

</head>

<body>

<div class="admin">

<div class="sidebar">

<h2>🌸 BEAUTY</h2>

<a href="dashboard.php">
Dashboard
</a>

<a href="produk.php">
Produk
</a>

<a href="kategori.php">
Kategori
</a>

<a class="active">
Pesanan
</a>

<a href="../logout.php">
Logout
</a>

</div>

<div class="content">

<div class="topbar">

<h1>

Kelola Pesanan

</h1>

</div>

<table class="produk-table">

<tr>

<th>No</th>

<th>Nama</th>

<th>Total</th>

<th>Tanggal</th>

<th>Status</th>

</tr>

<?php

$no=1;

while($row=mysqli_fetch_assoc($result))
{

?>

<tr>

<td>

<?php echo $no++;?>

</td>

<td>

<?php echo $row['customer'];?>

</td>

<td>

Rp <?php echo number_format($row['total']);?>

</td>

<td>

<?php echo $row['order_date'];?>

</td>

<td>

<span class="badge">

<?php echo $row['status'];?>

</span>

</td>

</tr>

<?php

}

?>

</table>

</div>

</div>

</body>

</html>