<?php
include '../koneksi.php';

if(isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query DELETE
    $query = "DELETE FROM kategori WHERE id_kategori = '$id'";
    $hapus = mysqli_query($koneksi, $query);

    if($hapus) {
        echo "<script>alert('Data Berhasil Dihapus'); window.location.href = 'data-kategori.php';</script>";
    } else {
        echo "<script>alert('Data Gagal Dihapus'); window.location.href = 'data-kategori.php';</script>";
    }
}
?>