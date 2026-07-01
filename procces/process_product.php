<?php

include "connect.php";

/* ===========================
   TAMBAH PRODUK
=========================== */

if(isset($_POST['save_product']))
{

    $name=$_POST['name'];

    $description=$_POST['description'];

    $price=$_POST['price'];

    $stock=$_POST['stock'];

    $category=$_POST['category_code'];

    $image="";

    if($_FILES['image']['name']!="")
    {

        $image=time()."_".$_FILES['image']['name'];

        move_uploaded_file(

            $_FILES['image']['tmp_name'],

            "images/".$image

        );

    }

    $sql="INSERT INTO product
    (
        name,
        description,
        price,
        stock,
        image,
        category_code
    )
    VALUES
    (
        '$name',
        '$description',
        '$price',
        '$stock',
        '$image',
        '$category'
    )";

    mysqli_query($id,$sql);

    header("Location:admin/produk.php");

}

/* ===========================
   UPDATE PRODUK
=========================== */

if(isset($_POST['update_product']))
{

    $code=$_POST['code'];

    $name=$_POST['name'];

    $description=$_POST['description'];

    $price=$_POST['price'];

    $stock=$_POST['stock'];

    $category=$_POST['category_code'];

    if($_FILES['image']['name']!="")
    {

        $image=time()."_".$_FILES['image']['name'];

        move_uploaded_file(

            $_FILES['image']['tmp_name'],

            "images/".$image

        );

        $sql="UPDATE product SET

        name='$name',

        description='$description',

        price='$price',

        stock='$stock',

        image='$image',

        category_code='$category'

        WHERE code='$code'";

    }

    else

    {

        $sql="UPDATE product SET

        name='$name',

        description='$description',

        price='$price',

        stock='$stock',

        category_code='$category'

        WHERE code='$code'";

    }

    mysqli_query($id,$sql);

    header("Location:admin/produk.php");

}

/* ===========================
   HAPUS PRODUK
=========================== */

if(isset($_GET['delete']))
{

    $code=$_GET['delete'];

    mysqli_query(

        $id,

        "DELETE FROM product WHERE code='$code'"

    );

    header("Location:admin/produk.php");

}

?>