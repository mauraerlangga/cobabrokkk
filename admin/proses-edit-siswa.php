<?php
include '../koneksi.php';

if(isset($_POST['update'])) {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $nama = $_POST['nama'];
    $kelas = $_POST['kelas'];
    $password = $_POST['password'];

    // Query Update
    $query = "UPDATE user SET username='$username', nama='$nama', kelas='$kelas', password='$password' WHERE id='$id'";
    
    $update = mysqli_query($koneksi, $query);
    
    if($update) {
        echo "<script>alert('Data Berhasil Diupdate'); window.location.href = 'data-siswa.php';</script>";
    } else {
        echo "<script>alert('Data Gagal Diupdate'); window.location.href = 'edit-siswa.php?id=$id';</script>";
    }
}
?>