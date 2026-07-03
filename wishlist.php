<?php

include 'connect.php';

if(isset($_GET['add']))
{

$product=$_GET['add'];

mysqli_query(

$connect,

"INSERT INTO wishlist
(product_code)

VALUES

('$product')"

);

}

header(
"Location:index.php"
);

?>
