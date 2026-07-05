<?php

include 'connect.php';

/* HITUNG TOTAL BELANJA */
$total = 0;

$cart_total = mysqli_query(
    $connect,
    "SELECT cart.qty, product.price
     FROM cart
     INNER JOIN product
     ON cart.product_code = product.code"
);

while ($c = mysqli_fetch_assoc($cart_total)) {
    $total += $c['qty'] * $c['price'];
}

/* PROSES CHECKOUT */
if (isset($_POST['checkout'])) {

    mysqli_query(
        $connect,
        "INSERT INTO orders
        (
            customer_name,
            customer_phone,
            customer_address,
            order_date
        )
        VALUES
        (
            '" . $_POST['customer_name'] . "',
            '" . $_POST['customer_phone'] . "',
            '" . $_POST['customer_address'] . "',
            NOW()
        )"
    );

    $order_id = mysqli_insert_id($connect);

    $cart = mysqli_query($connect, "SELECT * FROM cart");

    while ($item = mysqli_fetch_assoc($cart)) {

        mysqli_query(
            $connect,
            "INSERT INTO order_detail
            (
                order_id,
                product_code,
                qty
            )
            VALUES
            (
                '$order_id',
                '" . $item['product_code'] . "',
                '" . $item['qty'] . "'
            )"
        );

        mysqli_query(
            $connect,
            "UPDATE product
             SET stock = stock - " . $item['qty'] . "
             WHERE code = '" . $item['product_code'] . "'"
        );
    }

    mysqli_query($connect, "DELETE FROM cart");

    echo "
    <script>
        alert('Pesanan Berhasil');
        window.location='index.php';
    </script>
    ";
    exit;
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Checkout</title>
    <link rel="stylesheet" href="assets/style.css">
</head>

<body>

<div class="container-keranjang">

   <!-- HERO -->
<div class="hero-keranjang">
    <div class="hero-keranjang-content">

        <span class="badge-keranjang">
            BEAUTY SKINCARE OFFICIAL STORE
        </span>

        <h1 class="judul-keranjang">
            🌸 Checkout Pesanan 🌸
        </h1>

        <p class="subjudul-keranjang">
            Silakan isi data dengan benar agar pesanan bisa diproses dengan lancar.
        </p>

    </div>
</div>

<!-- INFO -->
<div class="checkout-info-box">
    <h2>Isi Data Diri</h2>
    <p>
        Pastikan nama, nomor HP, dan alamat sudah benar.
        Data ini digunakan untuk pengiriman pesanan.
    </p>
</div>

<form method="POST">

    <!-- FORM -->
    <div class="checkout-card">
        <h4>Masukkan Nama Anda :</h4>
        <input
            type="text"
            name="customer_name"
            required>

        <h4>Masukkan Nomor HP :</h4>
        <input
            type="text"
            name="customer_phone"
            required>

        <h4>Masukkan Alamat Lengkap :</h4>
        <textarea
            name="customer_address"
            required></textarea>

    </div>

    <!-- TOTAL -->
    <div class="checkout-total-box">

        <h2>Total yang Harus Dibayar</h2>

        <h1 class="checkout-total">
            Rp <?php echo number_format($total); ?>
        </h1>

    </div>

    <!-- BUTTON -->
    <button
        type="submit"
        name="checkout"
        class="btn-checkout-keranjang">
        Checkout Sekarang →
    </button>

</form>

<!-- BACK -->
<div class="aksi-keranjang" style="margin-top:20px;">
    <a href="cart.php" class="btn-kembali-keranjang">
        ← Kembali ke Keranjang
    </a>
</div>