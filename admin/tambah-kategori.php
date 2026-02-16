<?php
session_start();
include '../koneksi.php';

if(isset($_POST['simpan'])){
    $kategori = $_POST['kategori'];
    mysqli_query($koneksi, "INSERT INTO kategori VALUES ('','$kategori')");
    header("Location: kategori.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <div class="wrap wrap-tamkat">
        <h2 class="h2">Tambah Kategori</h2><hr>

        <form method="POST"><br>
            <input type="text" name="kategori" required class="input" placeholder="Nama Kategori Baru"><br><br>
            <button type="submit" name="simpan" class="btn btn-kirim">Simpan</button><br>
            <a href="kategori.php" class="btn btn-kembali">Kembali</a>
        </form>
    </div>
</body>
</html>

