<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location:../login.php");
    exit;
}

include "../connect.php";

$sql = "SELECT
            product.code,
            product.name,
            product.description,
            product.price,
            product.stock,
            product.image,
            category.category
        FROM product
        LEFT JOIN category
        ON product.category_code = category.code";

$result = mysqli_query($id, $sql);
?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<title>Kelola Produk</title>

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<link rel="stylesheet" href="../assets/style.css">

</head>

<body>

<div class="admin-container">

<!-- Sidebar -->

<div class="sidebar">

<h2>🌸 BEAUTY</h2>

<a href="dashboard.php">
<i class="fa fa-home"></i>
Dashboard
</a>

<a href="produk.php" class="active">
<i class="fa fa-box"></i>
Produk
</a>

<a href="kategori.php">
<i class="fa fa-tags"></i>
Kategori
</a>

<a href="pesanan.php">
<i class="fa fa-shopping-cart"></i>
Pesanan
</a>

<a href="../logout.php">
<i class="fa fa-sign-out-alt"></i>
Logout
</a>

</div>

<!-- Content -->

<div class="content">

<div class="topbar">

<h1>Kelola Produk</h1>

<a href="tambah_produk.php" class="btn-add">

<i class="fa fa-plus"></i>

Tambah Produk

</a>

</div>

<input
type="text"
id="search"
placeholder="🔍 Cari produk..."
class="search">

<div class="produk-admin-grid">

<?php

while($row=mysqli_fetch_assoc($result))
{

?>

<div class="produk-admin-card">

<img
src="../images/<?php echo $row['image'];?>">

<h3>

<?php echo $row['name'];?>

</h3>

<p>

<?php echo $row['category'];?>

</p>

<h2>

Rp <?php echo number_format($row['price']);?>

</h2>

<div class="stok">

Stok :
<?php echo $row['stock'];?>

</div>

<div class="aksi">

<a
href="edit_produk.php?id=<?php echo $row['code'];?>"
class="edit">

<i class="fa fa-edit"></i>

</a>

<a
href="../procces/process_product.php?delete=<?php echo $row['code'];?>"
class="hapus">

<i class="fa fa-trash"></i>

</a>

</div>

</div>

<?php

}

?>  

</div>

</div>

</div>

</body>

</html>