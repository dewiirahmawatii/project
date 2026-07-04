<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit;
}

include "../connect.php";

$sql = "SELECT * FROM orders ORDER BY order_date DESC";
$result = mysqli_query($connect, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Kelola Pesanan</title>
    <link rel="stylesheet" href="../assets/style.css">
    <link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>

<body>

<div class="admin">

 <!-- Sidebar -->

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
    <h1>Kelola Pesanan</h1>
</div>

<table class="produk-table">

<tr>
    <th>No</th>
    <th>Nama</th>
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
    <td>Rp <?= number_format($row['total']); ?></td>
    <td><?= $row['order_date']; ?></td>

    <td>
        <?php
        if ($row['status'] == "Diproses") {
            echo "<b style='color:blue'>Diproses</b>";
        } elseif ($row['status'] == "Selesai") {
            echo "<b style='color:green'>Selesai</b>";
        } elseif ($row['status'] == "Dikirim") {
            echo "<b style='color:purple'>Dikirim</b>";
        } elseif ($row['status'] == "Dibatalkan") {
            echo "<b style='color:red'>Dibatalkan</b>";
        } else {
            echo "<b style='color:orange'>Menunggu</b>";
        }
        ?>
    </td>

    <td>
        <a href="detail_pesanan.php?id=<?= $row['id']; ?>" class="btn-detail">Detail</a>
    </td>
</tr>

<?php } ?>

</table>

</div>
</div>

</body>
</html>