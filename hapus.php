<?php
include 'koneksi.php';
$id = $_GET['id'];

$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT foto FROM mahasiswa WHERE id=$id"));
unlink("uploads/" . $data['foto']); // hapus file foto

mysqli_query($koneksi, "DELETE FROM mahasiswa WHERE id=$id");
header("Location: index.php");
?>
