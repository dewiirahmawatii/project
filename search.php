<?php

include 'connect.php';

$keyword=$_GET['keyword'];

$sql="
SELECT *
FROM product

WHERE name LIKE '%$keyword%'
OR description LIKE '%$keyword%'
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

<a
href="cart.php?add=<?php echo $row['code']; ?>"
class="btn-cart">

🛒 Tambah Keranjang

</a>

</div>

</div>

<?php
}
?>
