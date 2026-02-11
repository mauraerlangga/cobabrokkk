<?php
include '../koneksi.php';

if(isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query Delete
    $query = "DELETE FROM user WHERE id='$id'";
    $hapus = mysqli_query($koneksi, $query);

    if($hapus) {
        echo "<script>alert('Data Berhasil Dihapus'); window.location.href = 'data-siswa.php';</script>";
    } else {
        echo "<script>alert('Data Gagal Dihapus'); window.location.href = 'data-siswa.php';</script>";
    }
}
?>