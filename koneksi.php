<?php
$koneksi = mysqli_connect("localhost", "root", "", "db_mahasiswa");

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
