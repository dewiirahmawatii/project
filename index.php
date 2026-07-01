<?php
include "connect.php";

/* ===========================
   FILTER PRODUK
=========================== */

if(isset($_GET['category']))
{
    $category=$_GET['category'];

    $sql="
    SELECT *
    FROM product
    WHERE category_code='$category'
    ";
}
elseif(isset($_GET['keyword']))
{
    $keyword=$_GET['keyword'];

    $sql="
    SELECT *
    FROM product
    WHERE
    name LIKE '%$keyword%'
    OR description LIKE '%$keyword%'
    ";
}
else
{
    $sql="
    SELECT *
    FROM product
    ORDER BY code DESC
    ";
}

$result=mysqli_query($id,$sql);

/* ===========================
   JUMLAH KERANJANG
=========================== */

$jml=0;

$cek=mysqli_query($id,"SHOW TABLES LIKE 'cart'");

if(mysqli_num_rows($cek)>0)
{
    $jml=mysqli_num_rows(mysqli_query($id,"SELECT * FROM cart"));
}
?>

<!DOCTYPE html>

<html>

<head>

<meta charset="UTF-8">

<title>Beauty Skincare</title>

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<link
rel="stylesheet"
href="style.css">

<link
rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>

<body>

<!-- ===========================
        NAVBAR
=========================== -->

<nav class="navbar">

<div class="logo">

🌸 BEAUTY

</div>

<form
action="index.php"
method="GET"
class="search-form">

<input

type="text"

name="keyword"

id="search"

placeholder="Cari skincare favoritmu..."

autocomplete="off">

<button>

<i class="fa fa-search"></i>

</button>

</form>

<div class="menu">

<a href="index.php">

Home

</a>

<a href="#kategori">

Kategori

</a>

<a href="#produk">

Produk

</a>

<a href="wishlist.php">

❤️ Wishlist

</a>

<a href="cart.php">

🛒 Keranjang

(<?php echo $jml;?>)

</a>

<a href="login.php">

Admin

</a>

</div>

</nav>

<!-- ===========================
        HERO
=========================== -->

<section class="hero">

<div class="hero-text">

<h1>

Glow With Confidence ✨

</h1>

<p>

Temukan berbagai skincare terbaik
untuk wajah sehat, glowing,
dan percaya diri setiap hari.

</p>

<a
href="#produk"
class="btn-shop">

Belanja Sekarang

</a>

</div>

<div class="hero-image">

<img
src="images/banner.png"
alt="Beauty">

</div>

</section>

<!-- ===========================
        FLASH SALE
=========================== -->

<section class="flash">

<h2>

🔥 FLASH SALE

</h2>

<div id="countdown">

02:00:00

</div>

<div class="flash-grid">

<div class="flash-card">

💖

<h3>

Diskon 50%

</h3>

</div>

<div class="flash-card">

✨

<h3>

Buy 1 Get 1

</h3>

</div>

<div class="flash-card">

🚚

<h3>

Gratis Ongkir

</h3>

</div>

<div class="flash-card">

⭐

<h3>

Best Seller

</h3>

</div>

</div>

</section>

<!-- ===========================
        BANNER PROMO
=========================== -->

<section class="banner-section">

<div class="banner-card pink">

<h2>✨ Brightening Series</h2>

<p>Dapatkan diskon hingga 50%</p>

<a href="#produk">Belanja Sekarang</a>

</div>

<div class="banner-card purple">

<h2>💖 Best Seller</h2>

<p>Produk favorit pelanggan</p>

<a href="#produk">Lihat Produk</a>

</div>

<div class="banner-card orange">

<h2>🚚 Gratis Ongkir</h2>

<p>Minimal belanja Rp100.000</p>

<a href="#produk">Belanja</a>

</div>

</section>

<!-- ===========================
        KATEGORI
=========================== -->

<section id="kategori">

<div class="title">

<h2>

🏷️ Kategori Produk

</h2>

<p>

Pilih kategori skincare favoritmu

</p>

</div>

<div class="kategori-grid">

<?php

$kategori=mysqli_query($id,"SELECT * FROM category");

while($k=mysqli_fetch_assoc($kategori))
{

?>

<a
href="index.php?category=<?php echo $k['code'];?>"
class="kategori-card">

<div class="icon">

🧴

</div>

<h3>

<?php

echo $k['category'];

?>

</h3>

</a>

<?php

}

?>

</div>

</section>

<!-- ===========================
        PRODUK
=========================== -->

<section id="produk">

<div class="title">

<h2>

🔥 Produk Terlaris

</h2>

<p>

Skincare pilihan dengan kualitas terbaik

</p>

</div>

<div
class="produk-grid"
id="result">

<?php

while($row=mysqli_fetch_assoc($result))
{

?>

<div class="produk-card">

<div class="produk-image">

<img
src="images/<?php echo $row['image'];?>"
alt="<?php echo $row['name'];?>">

<span class="badge">

BEST

</span>

</div>

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

Rp <?php echo number_format($row['price']);?>

</div>

<div class="stok">

Stok :

<b>

<?php echo $row['stock'];?>

</b>

</div>

<div class="rating">

⭐⭐⭐⭐⭐

<span>

4.9

</span>

</div>

<div class="produk-button">

<a
href="cart.php?add=<?php echo $row['code'];?>"
class="btn-cart">

🛒 Keranjang

</a>

<a
href="wishlist.php?add=<?php echo $row['code'];?>"
class="btn-love">

❤

</a>

</div>

</div>

</div>

<?php

}

?>

</div>

</section>

<!-- ===========================
        BAGIAN 3 LANJUT...
=========================== -->
<!-- ===========================
        KEUNGGULAN TOKO
=========================== -->

<section class="why-us">

<div class="title">

<h2>Mengapa Memilih Beauty Skincare?</h2>

<p>Kami menyediakan produk skincare original dengan kualitas terbaik.</p>

</div>

<div class="why-grid">

<div class="why-card">

<i class="fa-solid fa-truck-fast"></i>

<h3>Gratis Ongkir</h3>

<p>Gratis ongkir untuk pembelian minimal Rp100.000.</p>

</div>

<div class="why-card">

<i class="fa-solid fa-shield-heart"></i>

<h3>100% Original</h3>

<p>Semua produk dijamin asli dan bergaransi.</p>

</div>

<div class="why-card">

<i class="fa-solid fa-headset"></i>

<h3>Customer Service</h3>

<p>Siap membantu selama 24 jam.</p>

</div>

<div class="why-card">

<i class="fa-solid fa-credit-card"></i>

<h3>Pembayaran Aman</h3>

<p>Mendukung berbagai metode pembayaran.</p>

</div>

</div>

</section>

<!-- ===========================
        FOOTER
=========================== -->

<footer class="footer">

<div class="footer-grid">

<div>

<h2>🌸 BEAUTY SKINCARE</h2>

<p>

Glow With Confidence.

Produk skincare terbaik untuk semua jenis kulit.

</p>

</div>

<div>

<h3>Menu</h3>

<a href="index.php">Home</a>

<a href="#kategori">Kategori</a>

<a href="#produk">Produk</a>

</div>

<div>

<h3>Kontak</h3>

<p>📍 Indonesia</p>

<p>📞 0812-3456-7890</p>

<p>✉ beauty@gmail.com</p>

</div>

<div>

<h3>Follow Us</h3>

<i class="fa-brands fa-instagram fa-2x"></i>

<i class="fa-brands fa-facebook fa-2x"></i>

<i class="fa-brands fa-tiktok fa-2x"></i>

</div>

</div>

<hr>

<p class="copyright">

© 2026 Beauty Skincare. All Rights Reserved.

</p>

</footer>

<script>

/* ===========================
SEARCH AJAX
=========================== */

const search=document.getElementById("search");

if(search){

search.addEventListener("keyup",function(){

let keyword=this.value;

fetch("search.php?keyword="+keyword)

.then(res=>res.text())

.then(data=>{

document.getElementById("result").innerHTML=data;

});

});

}

/* ===========================
COUNTDOWN
=========================== */

let waktu=7200;

setInterval(function(){

let jam=Math.floor(waktu/3600);

let menit=Math.floor((waktu%3600)/60);

let detik=waktu%60;

document.getElementById("countdown").innerHTML=

String(jam).padStart(2,'0')+":"

+String(menit).padStart(2,'0')+":"

+String(detik).padStart(2,'0');

if(waktu>0){

waktu--;

}

},1000);

/* ===========================
ANIMASI CARD
=========================== */

const cards=document.querySelectorAll(".produk-card");

cards.forEach(function(card){

card.addEventListener("mouseenter",function(){

card.style.transform="translateY(-10px)";

});

card.addEventListener("mouseleave",function(){

card.style.transform="translateY(0px)";

});

});

</script>

</body>

</html>