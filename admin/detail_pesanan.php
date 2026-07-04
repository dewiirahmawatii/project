<?php

session_start();

if(!isset($_SESSION['login']))
{
    header("Location:../login.php");
    exit;
}

include "../connect.php";

if(!isset($_GET['id']))
{
    header("Location:pesanan.php");
    exit;
}

$id_order = $_GET['id'];

$order = mysqli_query(
$connect,
"SELECT *
FROM orders
WHERE id='$id_order'"
);

$data = mysqli_fetch_assoc($order);

if(!$data)
{
    echo "Pesanan tidak ditemukan!";
    exit;
}

$detail = mysqli_query(
$connect,
"SELECT
order_detail.*,
product.name,
product.price
FROM order_detail
JOIN product
ON order_detail.product_code = product.code
WHERE order_detail.order_id='$id_order'"
);

?>

<!DOCTYPE html>

<html lang="id">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Detail Pesanan</title>

<link rel="stylesheet"
href="../assets/style.css">

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

<a href="kategori.php">
<i class="fa fa-tags"></i>
Kategori
</a>

<a href="pesanan.php" class="active">
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

<h1>

📦 Detail Pesanan

</h1>

</div>

<div class="detail-card">

<h2>

👤 Informasi Pelanggan

</h2>

<div class="detail-item">

<label>Nama</label>

<span>

<?php echo $data['customer_name']; ?>

</span>

</div>

<div class="detail-item">

<label>No HP</label>

<span>

<?php echo $data['customer_phone']; ?>

</span>

</div>

<div class="detail-item">

<label>Alamat</label>

<span>

<?php echo $data['customer_address']; ?>

</span>

</div>

<div class="detail-item">

<label>Tanggal</label>

<span>

<?php echo $data['order_date']; ?>

</span>

</div>

<div class="detail-item">

<label>Status</label>

<span>

<?php

$status=$data['status'];

if($status=="Menunggu")
{
echo "<span class='badge warning'>🟡 Menunggu</span>";
}
elseif($status=="Diproses")
{
echo "<span class='badge primary'>🔵 Diproses</span>";
}
elseif($status=="Dikirim")
{
echo "<span class='badge info'>🟣 Dikirim</span>";
}
elseif($status=="Selesai")
{
echo "<span class='badge success'>🟢 Selesai</span>";
}
else
{
echo "<span class='badge danger'>🔴 Dibatalkan</span>";
}

?>

</span>

</div>

<hr>

<h2>

🛒 Detail Produk

</h2>

<table class="produk-table">

<tr>

<th>Produk</th>

<th>Harga</th>

<th>Qty</th>

<th>Subtotal</th>

</tr>
<?php

$total=0;

while($item=mysqli_fetch_assoc($detail))
{

$subtotal=$item['price']*$item['qty'];

$total+=$subtotal;

?>

<tr>

<td>

<?php echo $item['name']; ?>

</td>

<td>

Rp <?php echo number_format($item['price']); ?>

</td>

<td>

<?php echo $item['qty']; ?>

</td>

<td>

Rp <?php echo number_format($subtotal); ?>

</td>

</tr>

<?php

}

?>

<tr>

<td colspan="3" align="right">

<b>Total Belanja</b>

</td>

<td>

<b>

Rp <?php echo number_format($total); ?>

</b>

</td>

</tr>

</table>

<br>

<form
action="../procces/process_order.php"
method="POST"
class="status-form">

<input
type="hidden"
name="id"
value="<?php echo $data['id']; ?>">

<h2>

🔄 Update Status Pesanan

</h2>

<select
name="status"
class="status-select">

<option value="Menunggu"
<?php if($data['status']=="Menunggu") echo "selected"; ?>>

🟡 Menunggu

</option>

<option value="Diproses"
<?php if($data['status']=="Diproses") echo "selected"; ?>>

🔵 Diproses

</option>

<option value="Dikirim"
<?php if($data['status']=="Dikirim") echo "selected"; ?>>

🟣 Dikirim

</option>

<option value="Selesai"
<?php if($data['status']=="Selesai") echo "selected"; ?>>

🟢 Selesai

</option>

<option value="Dibatalkan"
<?php if($data['status']=="Dibatalkan") echo "selected"; ?>>

🔴 Dibatalkan

</option>

</select>

<div class="button-group">

<button
type="submit"
name="update_status"
class="btn-save">

💾 Simpan Perubahan

</button>

<a
href="pesanan.php"
class="btn-back">

← Kembali

</a>

</div>

</form>

</div>

</div>

</div>

</body>

</html>