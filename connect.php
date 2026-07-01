<?php

$id=mysqli_connect(
    "localhost",
    "root",
    "nurcahya13",
    "BeautySkincare"
);

if(!$id)
{
    die("Koneksi gagal : ".mysqli_connect_error());
}

?>