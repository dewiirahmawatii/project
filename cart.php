<?php

include 'connect.php';

if(isset($_GET['add']))
{
    $kode=$_GET['add'];

    $cek=mysqli_query($id,
    "SELECT * FROM cart
    WHERE product_code='$kode'");

    if(mysqli_num_rows($cek)>0)
    {
        mysqli_query($id,
        "UPDATE cart
        SET qty=qty+1
        WHERE product_code='$kode'");
    }
    else
    {
        mysqli_query($id,
        "INSERT INTO cart(product_code,qty)
        VALUES('$kode',1)");
    }

    header("Location:cart.php");
}

?>

<!DOCTYPE html>
<html>
<head>
<title>Keranjang</title>
<link rel="stylesheet" href="assets/style.css">
</head>

<body>

<h1 style="padding:20px">
🛒 Keranjang Belanja
</h1>

<table>

<tr>
<th>Produk</th>
<th>Harga</th>
<th>Qty</th>
<th>Total</th>
</tr>

<?php

$total=0;

$sql="
SELECT
product.name,
product.price,
cart.qty

FROM cart

INNER JOIN product
ON cart.product_code=product.code
";

$result=mysqli_query($connect,$sql);

while($row=mysqli_fetch_assoc($result))
{
    $subtotal=
    $row['price']*$row['qty'];

    $total+=$subtotal;
?>

<tr>

<td><?php echo $row['name']; ?></td>

<td>
Rp <?php echo number_format($row['price']); ?>
</td>

<td>
<?php echo $row['qty']; ?>
</td>

<td>
Rp <?php echo number_format($subtotal); ?>
</td>

</tr>

<?php
}
?>

<tr>

<td colspan="3">
<b>Total Belanja</b>
</td>

<td>
<b>
Rp <?php echo number_format($total); ?>
</b>
</td>

</tr>

</table>

<center>

<br>

<a href="checkout.php"
class="btn-cart">
Checkout
</a>

</center>

</body>
</html>