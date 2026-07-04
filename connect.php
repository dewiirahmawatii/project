<?php

$connect=mysqli_connect(
    "localhost",
    "root",
    "",
    "beautyskincare"
);

if(!$connect)
{
    die("Koneksi gagal : ".mysqli_connect_error());
}

?>