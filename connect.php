<?php

$connect = mysqli_connect(
    "localhost",
    "root",
    "nurcahya13",
    "beautyskincare"
);

if (!$connect) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

?>