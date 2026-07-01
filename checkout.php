<?php

include 'connect.php';

/* HITUNG TOTAL BELANJA */
$total = 0;

$cart_total = mysqli_query(
    $id,
    "SELECT
        cart.qty,
        product.price
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
        $id,
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

    $order_id = mysqli_insert_id($id);

    $cart = mysqli_query(
        $id,
        "SELECT * FROM cart"
    );

    while ($item = mysqli_fetch_assoc($cart)) {

        mysqli_query(
            $id,
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
            $id,
            "UPDATE product
             SET stock = stock - " . $item['qty'] . "
             WHERE code = '" . $item['product_code'] . "'"
        );
    }

    mysqli_query($id, "DELETE FROM cart");

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
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="card-form">

    <h2>Total Belanja Rp <?php echo number_format($total); ?></h2>

    <h2>Checkout Pesanan</h2>

    <form method="POST">

        <input
            type="text"
            name="customer_name"
            placeholder="Nama Pembeli"
            required>

        <br><br>

        <input
            type="text"
            name="customer_phone"
            placeholder="Nomor HP"
            required>

        <br><br>

        <textarea
            name="customer_address"
            placeholder="Alamat Lengkap"
            required></textarea>

        <br><br>

        <button
            type="submit"
            name="checkout"
            class="btn-save">
            Checkout
        </button>

    </form>

</div>

</body>
</html>