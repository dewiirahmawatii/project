<?php

session_start();

if(!isset($_SESSION['login']))
{
    header("Location:../login.php");
    exit;
}

include "../connect.php";

$code=$_GET['id'];

$sql="SELECT * FROM product WHERE code='$code'";

$result=mysqli_query($connect,$sql);

$data=mysqli_fetch_assoc($result);

$kategori=mysqli_query($connect,"SELECT * FROM category");

?>

<!DOCTYPE html>

<html>

<head>

<meta charset="UTF-8">

<title>Edit Produk</title>

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

<a href="produk.php" class="active">
🧴 Produk
</a>

<a href="kategori.php">
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

<h1>Edit Produk</h1>

<a href="produk.php" class="btn">

← Kembali

</a>

</div>

<form

action="../process_product.php"

method="POST"

enctype="multipart/form-data"

class="form-produk">

<input
type="hidden"
name="code"
value="<?php echo $data['code'];?>">

<label>

Nama Produk

</label>

<input
type="text"
name="name"
value="<?php echo $data['name'];?>"
required>

<label>

Deskripsi

</label>

<textarea
name="description"
rows="5"><?php echo $data['description'];?></textarea>

<label>

Harga

</label>

<input
type="number"
name="price"
value="<?php echo $data['price'];?>">

<label>

Stok

</label>

<input
type="number"
name="stock"
value="<?php echo $data['stock'];?>">

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

value="<?php echo $row['code'];?>"

<?php

if($row['code']==$data['category_code'])

echo"selected";

?>

>

<?php echo $row['category'];?>

</option>

<?php

}

?>

</select>

<label>

Gambar Produk

</label>

<input

type="file"

name="image"

id="image"

accept="image/*">

<div class="preview">

<img

id="preview"

src="../images/<?php echo $data['image'];?>">

</div>

<button

type="submit"

name="update_product"

class="btn-save">

💾 Update Produk

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