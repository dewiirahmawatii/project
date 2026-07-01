<?php

include 'connect.php';

/* FILTER KATEGORI */

if(isset($_GET['category']))
{
    $category=$_GET['category'];

    $sql="
    SELECT *
    FROM product
    WHERE category_code='$category'
    ";
}

/* SEARCH */

elseif(isset($_GET['keyword']))
{
    $keyword=$_GET['keyword'];

    $sql="
    SELECT *
    FROM product
    WHERE name LIKE '%$keyword%'
    OR description LIKE '%$keyword%'
    ";
}

/* TAMPIL SEMUA PRODUK */

else
{
    $sql="
    SELECT *
    FROM product
    ";
}

$result=mysqli_query($id,$sql);

/* JUMLAH KERANJANG */

$jml=mysqli_num_rows(
mysqli_query(
$id,
"SELECT * FROM cart"
)
);

?>

<!DOCTYPE html>
<html>
<head>
<title>BEAUTY SKINCARE</title>

<link rel="stylesheet" href="style.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>

<body>

<nav class="navbar">

<div class="logo">
🌸 BEAUTY SKINCARE
</div>

<div class="menu">

<a href="index.php">Home</a>

<a href="#kategori">Kategori</a>

<a href="#produk">Produk</a>

<a href="cart.php">
<?php

$jml=mysqli_num_rows(
mysqli_query(
$id,
"SELECT * FROM cart"
)
);

?>

<a href="cart.php">

🛒 Keranjang

(<?php echo $jml; ?>)

</a>    
</a>

<a href="login.php">
Admin
</a>

</div>

</nav>

<div class="hero">

<h1>
Glow With Confidence ✨
</h1>

<p>
Temukan skincare terbaik untuk kulit sehat dan glowing
</p>
<div class="countdown-box">

<h2>🔥 FLASH SALE BERAKHIR DALAM</h2>

<div id="countdown">
02:00:00
</div>

</div>

<form method="GET">

<div class="search-box">

<input
type="text"
id="search"
placeholder="🔍 Cari Brightening, Serum, Acne Care">

</div>
<div class="slider">

<div class="slide active">
🌸 PROMO SKINCARE 50%
</div>

<div class="slide">
✨ BUY 1 GET 1
</div>

<div class="slide">
💖 FREE ONGKIR
</div>

</div>
</form>
<div class="flash-sale">

<h2>
🔥 FLASH SALE
</h2>

<div class="flash-grid">

<div class="flash-item">
50% OFF
</div>

<div class="flash-item">
BUY 1 GET 1
</div>

<div class="flash-item">
FREE ONGKIR
</div>

<div class="flash-item">
BEST SELLER
</div>

</div>

</div>

</div>

<div class="banner-container">

<div class="banner-card">
💖 50% OFF Brightening Series
</div>

<div class="banner-card">
✨ Best Seller Skincare
</div>

<div class="banner-card">
🧴 New Arrival Serum
</div>

</div>

<h2 class="section-title" id="kategori">
🏷️ Kategori Favorit
</h2>

<div class="kategori-grid">

<?php

$kategori=mysqli_query(
$id,
"SELECT * FROM category"
);

while($k=mysqli_fetch_assoc($kategori))
{
?>

<a
href="index.php?category=<?php echo $k['code']; ?>"
class="kategori-card">

<h3>
<?php echo $k['category']; ?>
</h3>

</a>

<?php
}
?>

</div>
<h2 class="section-title">
✨ Produk Terbaru
</h2>

<h2 class="section-title" id="produk">
🔥 Produk Terlaris
</h2>

<div
class="produk-grid"
id="result">

<?php

while($row=mysqli_fetch_assoc($result))
{
?>

<div class="produk-card">

<img
src="images/<?php echo $row['image']; ?>"
class="produk-img">

<div class="produk-content">

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

<div class="harga">

Rp

<?php
echo number_format($row['price']);
?>

</div>

<div class="rating">

⭐⭐⭐⭐⭐

<?php
echo $row['rating'];
?>

</div>

<br>

<a
href="cart.php?add=<?php echo $row['code']; ?>"
class="btn-cart">

🛒 Tambah Keranjang

<a

href="wishlist.php?add=<?php echo $row['code']; ?>"

class="btn-save">

❤️ Wishlist

</a>

</a>

</div>

</div>

<?php
}
?>

</div>
<script>

document
.getElementById("search")
.addEventListener(
"keyup",

function()
{

let keyword=this.value;

fetch(
"search.php?keyword="+keyword
)

.then(
response=>response.text()
)

.then(
data=>
{
document
.getElementById("result")
.innerHTML=data;
});

});

</script>
<script>

let slides=
document.querySelectorAll(".slide");

let index=0;

setInterval(()=>{

slides[index]
.classList.remove("active");

index++;

if(index>=slides.length)
{
index=0;
}

slides[index]
.classList.add("active");

},3000);

</script>
<footer class="footer">

<h3>
🌸 BEAUTY SKINCARE
</h3>

<p>
Glow With Confidence
</p>

<p>
© 2026 Beauty Skincare
</p>

</footer>
</body>
</html>