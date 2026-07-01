<?php
session_start();

if(!isset($_SESSION['login']))
{
    header("Location:../login.php");
    exit;
}

include "../connect.php";

$sql="SELECT
product.code,
product.name,
product.description,
product.price,
product.stock,
product.image,
category.category
FROM product
LEFT JOIN category
ON product.category_code=category.code
ORDER BY product.code DESC";

$result=mysqli_query($id,$sql);

?>
<!DOCTYPE html>

<html>

<head>

<title>Kelola Produk</title>

<link rel="stylesheet" href="../assets/style.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

</head>

<body>

<div class="admin">

<div class="sidebar">

<h2>🌸 BEAUTY</h2>

<a href="dashboard.php">
<i class="fa fa-home"></i>
Dashboard
</a>

<a class="active">
<i class="fa fa-box"></i>
Produk
</a>

<a href="kategori.php">
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

<div class="content">
    <div class="topbar">

<h1>

Kelola Produk

</h1>

<div>

<input
type="text"
placeholder="Cari produk..."
class="search">

<a
href="tambah_produk.php"
class="btn">

+ Tambah Produk

</a>

</div>

</div>
<table class="produk-table">

<tr>

<th>Gambar</th>

<th>Nama</th>

<th>Harga</th>

<th>Stok</th>

<th>Kategori</th>

<th>Aksi</th>

</tr>

<?php

while($row=mysqli_fetch_assoc($result))
{

?>

<tr>

<td>

<img
src="../images/<?php echo $row['image'];?>"
class="thumb">

</td>

<td>

<?php echo $row['name'];?>

</td>

<td>

Rp <?php echo number_format($row['price']);?>

</td>

<td>

<?php echo $row['stock'];?>

</td>

<td>

<?php echo $row['category'];?>

</td>

<td>

<a
class="edit"
href="edit_produk.php?id=<?php echo $row['code'];?>">

Edit

</a>

<a
class="hapus"
href="../procces/process_product.php?delete=<?php echo $row['code'];?>">

Hapus

</a>

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