<?php

include 'connect.php';

/* CREATE CATEGORY */
if(isset($_POST['save_category']))
{
    $StrSQL="insert into category(category)
             values('".$_POST['category']."')";

    mysqli_query($id,$StrSQL);
}

/* UPDATE CATEGORY */
if(isset($_POST['update_category']))
{
    $StrSQL="update category
             set category='".$_POST['category']."'
             where code='".$_POST['code']."'";

    mysqli_query($id,$StrSQL);
}

/* DELETE CATEGORY */
if(isset($_POST['delete_category']))
{
    $StrSQL="delete from category
             where code='".$_POST['code']."'";

    mysqli_query($id,$StrSQL);
}

header("Location:index.php");

?>