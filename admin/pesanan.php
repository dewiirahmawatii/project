<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit;
}

include "../connect.php";

$sql = "SELECT * FROM orders ORDER BY order_date DESC";
$result = mysqli_query($connect, $sql);

if (!$result) {
    die("Query Error : " . mysqli_error($connect));
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Kelola Pesanan</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>

<div class="admin">

    <div class="sidebar">
        <h2>🌸 BEAUTY</h2>

        <a href="dashboard.php">Dashboard</a>
        <a href="produk.php">Produk</a>
        <a href="kategori.php">Kategori</a>
        <a href="pesanan.php" class="active">Pesanan</a>
        <a href="../logout.php">Logout</a>
    </div>

    <div class="content">

        <div class="topbar">
            <h1>Kelola Pesanan</h1>
        </div>

        <table class="produk-table">

            <tr>
                <th>No</th>
                <th>Nama Customer</th>
                <th>No HP</th>
                <th>Total</th>
                <th>Tanggal</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>

            <?php
            $no = 1;

            while ($row = mysqli_fetch_assoc($result)) {
            ?>

            <tr>

                <td><?= $no++; ?></td>

                <td><?= $row['customer_name']; ?></td>

                <td><?= $row['customer_phone']; ?></td>

                <td>Rp <?= number_format($row['total'], 0, ',', '.'); ?></td>

                <td><?= $row['order_date']; ?></td>

                <td>
                    <span class="badge">
                        <?= $row['status']; ?>
                    </span>
                </td>

                <td>
                    <a href="detail_pesanan.php?id=<?= $row['id']; ?>" class="btn-detail">
                        👁 Detail
                    </a>
                </td>

            </tr>

            <?php } ?>

        </table>

    </div>

</div>

</body>
</html>