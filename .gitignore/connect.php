<?php

$id=mysqli_connect(
    "localhost",
    "root",
    "Indahamiati135",
    "beautyskincare"
);

if(!$id)
{
    die("Koneksi gagal : ".mysqli_connect_error());
}

?>