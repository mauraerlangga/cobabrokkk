<?php
include '../koneksi.php';

if(isset($_POST['simpan'])) {
    //1. amnil data dari form
    $kategori = $_POST['kategori'];

    $query = "INSERT INTO kategori (ket_kategori) VALUES ('$kategori')";

    $simpan =mysqli_query($koneksi, $query);
    
    if($simpan) {
        echo "<script>alert('Data Berhasil Disimpan'); window.location.href = 'form-siswa.php';</script>";
    } else {
        echo "<script>alert('Data Gagal Disimpan'); window.location.href = 'form-siswa.php';</script>";
    }
} 
?>