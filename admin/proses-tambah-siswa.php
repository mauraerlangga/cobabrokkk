<?php
include '../koneksi.php';

if(isset($_POST['simpan'])) {
    //1. ambil data dari form
    $username = $_POST['username'];
    $nama = $_POST['nama'];
    $kelas = $_POST['kelas'];
    $password = $_POST['password'];

    // 2. Tambahkan baris ini: Set role otomatis sebagai 'siswa'
    $role = 'siswa';

    // 3. Ubah Query: Tambahkan kolom 'role' di bagian kiri, dan '$role' di bagian kanan
    $query = "INSERT INTO user (username, nama, kelas, password, role) VALUES ('$username', '$nama', '$kelas', '$password', '$role')";

    $simpan = mysqli_query($koneksi, $query);
    
    if($simpan) {
        echo "<script>alert('Data Berhasil Disimpan'); window.location.href = 'form-siswa.php';</script>";
    } else {
        echo "<script>alert('Data Gagal Disimpan'); window.location.href = 'form-siswa.php';</script>";
    }
} 
?>