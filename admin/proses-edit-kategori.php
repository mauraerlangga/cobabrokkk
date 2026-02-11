<?php
include '../koneksi.php';

if(isset($_POST['update'])) {
    // Ambil data dari form
    $id = $_POST['id_kategori'];
    $kategori = $_POST['kategori'];

    // Query UPDATE
    $query = "UPDATE kategori SET ket_kategori = '$kategori' WHERE id_kategori = '$id'";
    
    $update = mysqli_query($koneksi, $query);
    
    if($update) {
        echo "<script>alert('Data Berhasil Diupdate'); window.location.href = 'data-kategori.php';</script>";
    } else {
        echo "<script>alert('Data Gagal Diupdate'); window.location.href = 'edit-kategori.php?id=$id';</script>";
    }
}
?>