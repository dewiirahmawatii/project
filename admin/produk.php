<div class="search-box">

<input
type="text"
placeholder="🔍 Cari Skincare">

</div>
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
<title>Data Produk</title>
<link rel="stylesheet" href="style.css">
</head>

<body>

<div class="sidebar">

<h2>🌸 BEAUTY</h2>

<a href="dashboard.php">📊 Dashboard</a>
<a href="kategori.php">🏷️ Kategori</a>
<a href="produk.php">🧴 Produk</a>
<a href="logout.php">🚪 Logout</a>
<a href="pesanan.php">🛒 Pesanan</a>

</div>

<div class="main">

<h1>🧴 Data Produk</h1>

<div class="produk-grid">

<?php

$sql="
SELECT
product.code,
product.name,
product.description,
product.price,
product.stock,
product.image,
category.category
FROM product
INNER JOIN category
ON product.category_code=category.code
";

$result=mysqli_query($id,$sql);

while($row=mysqli_fetch_assoc($result))
{
?>

<div class="produk-card">

<img
src="images/<?php echo $row['image']; ?>"
class="produk-img">

<div class="produk-content">

<h3>

<?php echo $row['name']; ?>

</h3>

<p>

<?php echo $row['description']; ?>

</p>

<div class="harga">

Rp <?php echo number_format($row['price']); ?>

</div>

<div class="stok">

Stock :
<?php echo $row['stock']; ?>

</div>

<div class="kategori">

<?php echo $row['category']; ?>

</div>

<br>

<form
method="POST"
action="process_product.php">

<input
type="hidden"
name="code"
value="<?php echo $row['code']; ?>">

<button
name="delete_product"
class="btn-delete">

🗑 Hapus

</button>

</form>

</div>

</div>

</div>

<?php
}
?>

</div>

<div class="card-form">

<h2>✨ Tambah Produk Baru</h2>

<form method="POST"
action="process_product.php">

<input
type="text"
name="name"
placeholder="Nama Produk"
required>

<br><br>

<input
type="text"
name="description"
placeholder="Deskripsi Produk"
required>

<br><br>

<input
type="number"
name="price"
placeholder="Harga"
required>

<br><br>

<input
type="number"
name="stock"
placeholder="Stok"
required>

<br><br>

<input
type="text"
name="image"
placeholder="Contoh : serum.jpg"
required>

<br><br>

<select name="category_code" required>

<?php

$sql="SELECT * FROM category";
$result=mysqli_query($id,$sql);

while($row=mysqli_fetch_assoc($result))
{
?>

<option value="<?php echo $row['code']; ?>">

<?php echo $row['category']; ?>

</option>

<?php
}
?>

</select>

<br><br>

<button
name="save_product"
class="btn-save">

💖 SIMPAN PRODUK

</button>

</form>

</div>