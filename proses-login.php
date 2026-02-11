<?php
session_start();
include 'koneksi.php';

 $username = $_POST['username'];
 $password = $_POST['password'];

// Query ke tabel user
 $query = mysqli_query($koneksi, "SELECT * FROM user WHERE username = '$username' AND password = '$password'");
 $data = mysqli_fetch_assoc($query);

if($data) {
    // Simpan data ke session
    $_SESSION['id'] = $data['id']; 
    $_SESSION['username'] = $data['username'];
    $_SESSION['nama'] = $data['nama'];
    $_SESSION['role'] = $data['role']; // Pastikan kolom 'role' ada di tabel user

    if($data['role'] == 'admin') {
        // Arahkan ke halaman admin
        header("Location: admin/data-pengaduan-admin.php");
    } elseif($data['role'] == 'siswa') {
        // Arahkan ke halaman siswa
        header("Location: siswa.php");
    }
} else {
    echo "Login gagal! Username atau password salah.";
    echo "<br><a href='index.php'>Kembali</a>";
}
?>