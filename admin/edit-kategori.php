<?php
session_start();
include '../koneksi.php';

$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($koneksi,"SELECT * FROM kategori WHERE id_kategori='$id'"));

if(isset($_POST['update'])){
    $kategori = $_POST['kategori'];
    mysqli_query($koneksi,"UPDATE kategori SET ket_kategori='$kategori' WHERE id_kategori='$id'");
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
    <div class="wrap wrap-fomkat">
        <h2 class="h2">Edit Kategori</h2><hr>
        <form method="POST">
            <input class="input" type="text" name="kategori" value="<?= $data['ket_kategori']; ?>" required><br><br>
            <button class="btn btn-kirim" type="submit" name="update">Update</button><br>
            <a class="btn btn-kembali" href="kategori.php">Kembali</a>
        </form>
    </div>
</body>
</html>

