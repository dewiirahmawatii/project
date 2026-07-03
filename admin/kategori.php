<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit;
}

include "../connect.php";

$sql="SELECT
category.code,
category.category,
COUNT(product.code) AS total
FROM category
LEFT JOIN product
ON category.code=product.category_code
GROUP BY category.code
ORDER BY category.category ASC";

$result=mysqli_query($connect,$sql);

?>

<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">

<title>Kelola Kategori</title>

<link rel="stylesheet" href="../assets/style.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

</head>

<body>

<div class="admin">

<div class="sidebar">

<h2>🌸 BEAUTY</h2>

<a href="dashboard.php">
🏠 Dashboard
</a>

<a href="produk.php">
🧴 Produk
</a>

<a class="active">
🏷 Kategori
</a>

<a href="pesanan.php">
📦 Pesanan
</a>

<a href="../logout.php">
🚪 Logout
</a>

</div>

<div class="content">

<div class="topbar">

<h1>Kelola Kategori</h1>

<a
href="tambah_kategori.php"
class="btn">

+ Tambah

</a>

</div>

<div class="kategori-grid">

<?php

while($row=mysqli_fetch_assoc($result))
{

?>

<div class="kategori-card">

<div class="icon">

🏷

</div>

<h2>

<?php echo $row['category'];?>

</h2>

<p>

<?php echo $row['total'];?>

Produk

</p>

<div class="aksi">

<a

href="edit_kategori.php?id=<?php echo $row['code'];?>"

class="edit">

✏ Edit

</a>

<a

href="../process_category.php?delete=<?php echo $row['code'];?>"

class="hapus">

🗑 Hapus

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