<?php
session_start();

if(!isset($_SESSION['login'])){
    header("Location: ../login.php");
    exit;
}

include "../connect.php";
?>

<!DOCTYPE html>
<html>

<head>

<title>Kelola Produk</title>

<link rel="stylesheet" href="../assets/style.css">

</head>

<body>

<div class="sidebar">

<h2>🌸 BEAUTY</h2>

<a href="dashboard.php">🏠 Dashboard</a>

<a href="produk.php" class="active">🧴 Produk</a>

<a href="kategori.php">🏷 Kategori</a>

<a href="pesanan.php">📦 Pesanan</a>

<a href="../logout.php">🚪 Logout</a>

</div>

<div class="main">

<div class="top">

<h1>Kelola Produk</h1>

<a href="#" class="btnTambah">
+ Tambah Produk
</a>

</div>

<div class="product-grid">

<?php

$sql="

SELECT

product.*,

category.category

FROM product

JOIN category

ON product.category_code=category.code

";

$result=mysqli_query($id,$sql);

while($row=mysqli_fetch_assoc($result))
{

?>

<div class="product-card">

<img src="../images/<?php echo $row['image']; ?>">

<h3>

<?php

echo $row['name'];

?>

</h3>

<p>

<?php

echo $row['description'];

?>

</p>

<h2>

Rp <?php echo number_format($row['price']); ?>

</h2>

<span>

Stok :

<?php

echo $row['stock'];

?>

</span>

<br><br>

<span class="badge">

<?php

echo $row['category'];

?>

</span>

<div class="aksi">

<a href="#">✏ Edit</a>

<a href="#">🗑 Hapus</a>

</div>

</div>

<?php

}

?>

</div>

</div>

</body>

</html>