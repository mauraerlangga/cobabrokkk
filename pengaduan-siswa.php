<?php
session_start();

if (!isset($_SESSION['id']) || $_SESSION['role'] != 'siswa') {
    die("Akses ditolak.");
}

include 'koneksi.php';

$id_user   = $_SESSION['id'];
$kategori  = $_POST['kategori'];
$lokasi    = $_POST['lokasi'];
$keterangan = $_POST['keterangan'];

$query = "INSERT INTO `input-aspirasi`
(`id_kategori`, `iduser`, `lokasi`, `keterangan`, `status`)
VALUES
('$kategori', '$id_user', '$lokasi', '$keterangan', 'menunggu')";

if(mysqli_query($koneksi, $query)){
    header("Location: data-pengaduan-siswa.php");
    exit;
}else{
    echo "Gagal menyimpan data.";
}
?>
