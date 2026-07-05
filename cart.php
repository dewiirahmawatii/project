<?php

include 'connect.php';

// hapus produk dari keranjang
if(isset($_GET['hapus']))
{
    $kode = $_GET['hapus'];

    mysqli_query(
        $connect,
        "DELETE FROM cart
        WHERE product_code='$kode'"
    );

    header("Location: cart.php");
    exit;
}

// tambah produk ke keranjang
if(isset($_GET['add']))
{
    $kode = $_GET['add'];

    $cek = mysqli_query(
        $connect,
        "SELECT * FROM cart
        WHERE product_code='$kode'"
    );

    if(mysqli_num_rows($cek) > 0)
    {
        mysqli_query(
            $connect,
            "UPDATE cart
            SET qty = qty + 1
            WHERE product_code='$kode'"
        );
    }
    else
    {
        mysqli_query(
            $connect,
            "INSERT INTO cart(product_code, qty)
            VALUES('$kode', 1)"
        );
    }

    header("Location: cart.php");
    exit;
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Keranjang Belanja</title>
    <link rel="stylesheet" href="assets/style.css">
</head>

<body>
<div class="container-keranjang">
    <div class="hero-keranjang">

    <div class="hero-keranjang-content">

        <span class="badge-keranjang">
            BEAUTY SKINCARE OFFICIAL STORE
        </span>

        <h1 class="judul-keranjang">
             🌸 Beauty Shopping Cart🌸
        </h1>

        <p class="subjudul-keranjang">
            Periksa kembali produk pilihan Anda sebelum melanjutkan ke proses checkout.
            Pastikan jumlah dan produk yang dipilih sudah sesuai kebutuhan skincare Anda.
        </p>

    </div>

</div>

   <table class="tabel-keranjang">

    <tr>
        <th>No</th>
        <th>Gambar</th>
        <th>Produk</th>
        <th>Harga</th>
        <th>Jumlah</th>
        <th>Subtotal</th>
        <th>Aksi</th>
    </tr>

    <?php

    $total = 0;

    $sql = "
    SELECT
    product.name,
    product.price,
    product.image,
    cart.qty,
    cart.product_code

    FROM cart

    INNER JOIN product
    ON cart.product_code = product.code
    ";

    $result = mysqli_query($connect, $sql);

    $no = 1;

    while($row = mysqli_fetch_assoc($result))
    {
        $subtotal = $row['price'] * $row['qty'];

        $total += $subtotal;
    ?>

    <tr>

        <td>
            <?php echo $no++; ?>
        </td>

        <td>
           <img
src="images/<?php echo $row['image']; ?>"
alt="<?php echo $row['name']; ?>"
class="gambar-produk-keranjang">
        </td>

        <td class="nama-produk-keranjang">
            <?php echo $row['name']; ?>
        </td>

        <td>
            Rp <?php echo number_format($row['price']); ?>
        </td>

        <td>
            <?php echo $row['qty']; ?>
        </td>

        <td>
            Rp <?php echo number_format($subtotal); ?>
        </td>

        <td>
            <a
            href="cart.php?hapus=<?php echo $row['product_code']; ?>"
            class="btn-hapus-keranjang"
            onclick="return confirm('Hapus produk dari keranjang?')">
                Hapus
            </a>
        </td>

    </tr>

    <?php
    }
    ?>

    <tr class="baris-total-keranjang">

        <td colspan="5">
            <b>Total Belanja</b>
        </td>

        <td colspan="2">
            <b class="total-harga-keranjang">
                Rp <?php echo number_format($total); ?>
            </b>
        </td>

    </tr>

</table>

 <div class="aksi-keranjang">

    <div>
        <a href="index.php" class="btn-kembali-keranjang">
            ← Kembali Belanja
        </a>
    </div>

    <div>
        <a href="checkout.php" class="btn-checkout-keranjang">
            Checkout →
        </a>
    </div>

</div>
</div>
</body>

</html>