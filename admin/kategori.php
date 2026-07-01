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
<title>Data Kategori</title>
<link rel="stylesheet" href="style.css">
</head>

<body>

<div class="sidebar">

<h2>🌸 ARUNIKA</h2>

<a href="dashboard.php">📊 Dashboard</a>
<a href="kategori.php">🏷️ Kategori</a>
<a href="produk.php">🧴 Produk</a>
<a href="logout.php">🚪 Logout</a>
<a href="pesanan.php">🛒 Pesanan</a>

</div>

<div class="main">

<h1>🏷️ Data Kategori</h1>

<div class="kategori-grid">

<?php

$sql="SELECT * FROM category";
$result=mysqli_query($id,$sql);

while($row=mysqli_fetch_assoc($result))
{
?>

<div class="kategori-card">

<h3><?php echo $row['category']; ?></h3>

<form method="POST"
action="process_category.php">

<input
type="hidden"
name="code"
value="<?php echo $row['code']; ?>">

<input
type="text"
name="category"
value="<?php echo $row['category']; ?>">

<br><br>

<button
name="update_category"
class="btn-update">
UPDATE
</button>

<button
name="delete_category"
class="btn-delete">
DELETE
</button>

</form>

</div>

<?php
}
?>

</div>

<div class="card-form">

<h2>➕ Tambah Kategori</h2>

<form method="POST"
action="process_category.php">

<input
type="text"
name="category"
placeholder="Nama Kategori">

<br><br>

<button
name="save_category"
class="btn-save">
SIMPAN
</button>

</form>

</div>

</div>

</body>
</html>