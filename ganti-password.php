<?php
session_start();

if (!isset($_SESSION['id']) || $_SESSION['role'] != 'siswa') {
    header("Location: data-laporan-siswa.php");
    exit;
}

include 'koneksi.php';

$message = "";

if (isset($_POST['submit'])) {

    $id = $_SESSION['id'];
    $password_lama = $_POST['password_lama'];
    $password_baru = $_POST['password_baru'];
    $konfirmasi_password = $_POST['konfirmasi_password'];

    // Ambil password lama dari database
    $query = mysqli_query($koneksi, "SELECT password FROM user WHERE id = '$id'");
    $data = mysqli_fetch_assoc($query);

    if ($password_lama != $data['password']) {
        $message = "Password lama salah!";
    } elseif ($password_baru != $konfirmasi_password) {
        $message = "Konfirmasi password tidak cocok!";
    } else {

        mysqli_query($koneksi, "UPDATE user SET password='$password_baru' WHERE id='$id'");

        $message = "Password berhasil diganti!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Ganti Password</title>

    <style>
        body{
            background-color: rgb(142, 177, 138);
            margin: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
    </style>
    
</head>
<body>
<div class="wrap-gapass">
    <h2 style="font-size: 30px;">Ganti Password</h2>
    <?php if($message != "") echo "<p>$message</p>"; ?>
    <form method="POST">
        <label>Password Lama:</label><br>
        <input type="password" name="password_lama" required><br><br>

        <label>Password Baru:</label><br>
        <input type="password" name="password_baru" required><br><br>

        <label>Konfirmasi Password Baru:</label><br>
        <input type="password" name="konfirmasi_password" required><br><br>

        <button type="submit" name="submit" class="btn btn-kirim">Ganti Password</button><br>
        <a href="data-pengaduan-siswa.php" class="btn btn-kembali">Kembali</a>
    </form>
</div>

</body>
</html>
