<?php

include 'connect.php';

/* CREATE PRODUCT */

if(isset($_POST['save_product']))
{

$StrSQL="

INSERT INTO product
(
name,
description,
price,
stock,
category_code,
image
)

VALUES
(
'".$_POST['name']."',
'".$_POST['description']."',
'".$_POST['price']."',
'".$_POST['stock']."',
'".$_POST['category_code']."',
'".$_POST['image']."'
)

";

mysqli_query($id,$StrSQL);

}

/* UPDATE PRODUCT */

if(isset($_POST['update_product']))
{

$StrSQL="

UPDATE product SET

name='".$_POST['name']."',
description='".$_POST['description']."',
price='".$_POST['price']."',
stock='".$_POST['stock']."',
category_code='".$_POST['category_code']."',
image='".$_POST['image']."'

WHERE code='".$_POST['code']."'

";

mysqli_query($id,$StrSQL);

}

/* DELETE PRODUCT */

if(isset($_POST['delete_product']))
{

$StrSQL="

DELETE FROM product

WHERE code='".$_POST['code']."'

";

mysqli_query($id,$StrSQL);

}

header("Location:produk.php");

?>