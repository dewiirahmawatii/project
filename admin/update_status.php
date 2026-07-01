<?php

include 'connect.php';

$id_order=$_GET['id'];

$status=$_GET['status'];

mysqli_query(

$id,

"UPDATE orders
SET status='$status'
WHERE id='$id_order'"

);

header(
"Location:pesanan.php"
);

?>
