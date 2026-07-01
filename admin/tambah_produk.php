<?php

session_start();

if(!isset($_SESSION['login']))
{
    header("Location:../login.php");
    exit;
}

include "../connect.php";

$kategori=mysqli_query($id,"SELECT * FROM category");

?>

<!DOCTYPE html>

<html>

<head>

<meta charset="UTF-8">

<title>Tambah Produk</title>

<link rel="stylesheet" href="../assets/style.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

</head>

<body>

<div class="admin">

<!-- SIDEBAR -->

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
<i class="fa fa-cart-shopping"></i>
Pesanan
</a>

<a href="../logout.php">
Logout
</a>

</div>

<!-- CONTENT -->

<div class="content">

<div class="topbar">

<h1>

Tambah Produk

</h1>

<a href="produk.php" class="btn">

← Kembali

</a>

</div>

<form
action="../procces/process_product.php"
method="POST"
enctype="multipart/form-data"
class="form-produk">

<label>

Nama Produk

</label>

<input
type="text"
name="name"
required>

<label>

Deskripsi

</label>

<textarea
name="description"
rows="5"
required></textarea>

<label>

Harga

</label>

<input
type="number"
name="price"
required>

<label>

Stok

</label>

<input
type="number"
name="stock"
required>

<label>

Kategori

</label>

<select
name="category_code">

<?php

while($row=mysqli_fetch_assoc($kategori))
{

?>

<option
value="<?php echo $row['code'];?>">

<?php echo $row['category'];?>

</option>

<?php

}

?>

</select>

<label>

Upload Gambar

</label>

<input
type="file"
name="image"
id="image"
accept="image/*">

<div class="preview">

<img
id="preview"
src="../images/no-image.png">

</div>

<button
type="submit"
name="save_product"
class="btn-save">

<i class="fa fa-floppy-disk"></i>

Simpan Produk

</button>

</form>

</div>

</div>

<script>

image.onchange=evt=>{

const[file]=image.files;

if(file){

preview.src=URL.createObjectURL(file);

}

}

</script>

</body>

</html>