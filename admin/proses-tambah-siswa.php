<?php
include '../koneksi.php';

if(isset($_POST['simpan'])) {
    //1. amnil data dari form
    $nis = $_POST['nis'];
    $nama = $_POST['nama'];
    $kelas = $_POST['kelas'];
    $password = $_POST['password'];

    $query = "INSERT INTO siswa (nis, nama, kelas, password) VALUES ('$nis', '$nama', '$kelas', '$password')";

    $simpan =mysqli_query($koneksi, $query);
    
    if($simpan) {
        echo "<script>alert('Data Berhasil Disimpan'); window.location.href = 'form-siswa.php';</script>";
    } else {
        echo "<script>alert('Data Gagal Disimpan'); window.location.href = 'form-siswa.php';</script>";
    }
} 
?>