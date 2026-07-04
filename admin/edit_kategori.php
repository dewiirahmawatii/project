```php
<?php

session_start();

if(!isset($_SESSION['login']))
{
    header("Location:../login.php");
    exit;
}

include "../connect.php";

$code = $_GET['code'];

$sql = "SELECT * FROM category WHERE code='$code'";

$result = mysqli_query($connect,$sql);

$data = mysqli_fetch_assoc($result);

if(isset($_POST['update']))
{
    $kategori = $_POST['kategori'];

    mysqli_query(
        $connect,
        "UPDATE category
        SET category='$kategori'
        WHERE code='$code'"
    );

    header("Location:kategori.php");
    exit;
}

?>

<!DOCTYPE html>

<html>

<head>

<meta charset="UTF-8">

<title>Edit Kategori</title>

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

<a href="produk.php">
<i class="fa fa-box"></i>
Produk
</a>

<a href="kategori.php" class="active">
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

<div class="content">

<div class="topbar">

<h1>Edit Kategori</h1>

<a href="kategori.php" class="btn-add">

← Kembali

</a>

</div>

<form method="POST" class="form-produk">

<label>

Nama Kategori

</label>

<input
type="text"
name="kategori"
value="<?php echo $data['category'];?>"
required>

<button
type="submit"
name="update"
class="btn-save">

<i class="fa fa-floppy-disk"></i>

Update Kategori

</button>

</form>

</div>

</div>

</body>

</html>
```
