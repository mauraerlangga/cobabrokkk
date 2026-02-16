<?php
session_start();
include '../koneksi.php';

// Cek jika bukan admin
if (!isset($_SESSION['id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../index.php");
    exit;
}

// Proses simpan
if(isset($_POST['simpan'])){

    $username = $_POST['username'];
    $password = $_POST['password'];
    $nama     = $_POST['nama'];
    $kelas    = $_POST['kelas'];

    // Query insert
    mysqli_query($koneksi,"
        INSERT INTO user 
        (id, username, password, nama, kelas, role)
        VALUES 
        ('','$username','$password','$nama','$kelas','siswa')
    ");

    // Kembali ke halaman siswa
    header("Location: siswa.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Siswa</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <div class="wrap wrap-tamsis">
        <h2 class="h2">Tambah Siswa</h2><hr>

        <form method="POST">

        <input type="text" name="username" required class="input" placeholder="Username"><br><br>

        <input type="text" name="password" required class="input" placeholder="Password"><br><br>

        <input type="text" name="nama" required class="input" placeholder="Nama"><br><br>

        <label for="kelas"></label>
        <select name="kelas" id="kelas" required>
            <option value="">-- Pilih Kelas --</option>
            <option value="X-RPL">X-RPL</option>
            <option value="XI-RPL">XI-RPL</option>
            <option value="XII-RPL">XII-RPL</option>
            <option value="X-TKJ">X-TKJ</option>
            <option value="XI-TKJ">XI-TKJ</option>
            <option value="XII-TKJ">XII-TKJ</option>
        </select>

        <br><br>

        <button type="submit" name="simpan" class="btn btn-kirim">Simpan</button><br>

        <!-- Tombol kembali tidak submit form -->
        <a href="siswa.php" class="btn btn-kembali">Kembali</a>

        </form>

    </div>
    
</body>
</html>
