<?php
include '../koneksi.php';
$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($koneksi,"SELECT * FROM user WHERE id='$id'"));

if(isset($_POST['update'])){
    $username = $_POST['username'];
    $nama = $_POST['nama'];
    $kelas = $_POST['kelas'];

    mysqli_query($koneksi,"UPDATE user SET username='$username', nama='$nama', kelas='$kelas' WHERE id='$id'");
    header("Location: siswa.php");
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
    <div class="wrap wrap-edsis">
        <h2 class="h2">Edit Siswa</h2><hr>

        <form method="POST">
            
            Username <br>
            <input type="text" name="username" value="<?= $data['username']; ?>" class="input"><br>
            Nama <br>
            <input type="text" name="nama" value="<?= $data['nama']; ?>" class="input"><br>
            Kelas <br>
            <input type="text" name="kelas" value="<?= $data['kelas']; ?>" class="input"><br><br>

            <button name="update" class="btn btn-kirim">Update</button><br>
            <a href="siswa.php" class="btn btn-kembali">Kembali</a>
        </form>
    </div>
</body>
</html>
