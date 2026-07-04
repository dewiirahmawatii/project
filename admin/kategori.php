<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit;
}

include "../connect.php";

$sql = "SELECT
category.code,
category.category,
COUNT(product.code) AS total
FROM category
LEFT JOIN product
ON category.code = product.category_code
GROUP BY category.code
ORDER BY category.category ASC";

$result = mysqli_query($connect, $sql);
?>

<!DOCTYPE html>
<html lang="id">

<head>
<meta charset="UTF-8">
<title>Kelola Kategori</title>

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

<a href="kategori.php"class="active">
<i class="fa fa-tags"></i>
Kategori
</a>

<a href="pesanan.php">
<i class="fa fa-shopping-cart"></i>
Pesanan
</a>

<a href="../logout.php">
<i class="fa fa-sign-out-alt"></i>
Logout
</a>

</div>

    <!-- CONTENT -->
    <div class="content">

        <div class="topbar">

            <h1>Kelola Kategori</h1>

            <a href="tambah_kategori.php" class="btn-add">
                <i class="fa-solid fa-plus"></i>
                Tambah Kategori
            </a>

        </div>

        <div class="kategori-grid">

        <?php while($row = mysqli_fetch_assoc($result)){ ?>

            <div class="kategori-card">

                <div class="icon">
                    🏷
                </div>

                <h2>
                    <?php echo $row['category']; ?>
                </h2>

                <p>
                    <?php echo $row['total']; ?> Produk
                </p>

                <div class="aksi">

                    <a href="edit_kategori.php?code=<?php echo $row['code']; ?>" class="btn-edit">
                        ✏ Edit
                    </a>

                    <a href="../process_category.php?delete=<?php echo $row['code']; ?>" class="hapus"
                    onclick="return confirm('Yakin ingin menghapus kategori ini?')">
                        🗑 Hapus
                    </a>

                </div>

            </div>

        <?php } ?>

        </div>

    </div>

</div>

</body>
</html>