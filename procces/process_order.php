<?php

include "../connect.php";

if(isset($_POST['update_status']))
{

    $order_id = $_POST['id'];

    $status = $_POST['status'];

    $query = mysqli_query(
        $connect,
        "UPDATE orders
        SET status='$status'
        WHERE id='$order_id'"
    );

    if($query)
    {
        header("Location:../admin/detail_pesanan.php?id=".$order_id."&success=1");
        exit;
    }
    else
    {
        echo "Gagal mengubah status pesanan!";
    }

}
else
{
    header("Location:../admin/pesanan.php");
    exit;
}

?>