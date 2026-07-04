<?php
$connect=mysqli_connect(
    "localhost",
    "root",
    "Indahamiati135",
    "beautyskincare"
);

if(!$connect)
{
    die("Koneksi gagal : ".mysqli_connect_error());
}

?>