<?php
session_start();
if (!isset($_SESSION['id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../index.php");
    exit;
}
include '../koneksi.php';

$query = mysqli_query($koneksi,"SELECT * FROM user WHERE role='siswa'");
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
    <div class="wrap wrap-siswa">
        <h2 class="h2">Data Siswa</h2><hr>
        <a href="tambah-siswa.php" class="btn-action">+ Tambah Siswa</a><br>
        <br>

        <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Nama</th>
            <th>Kelas</th>
            <th>Aksi</th>
        </tr>

        <?php while($data = mysqli_fetch_assoc($query)){ ?>
        <tr>
            <td><?= $data['id']; ?></td>
            <td><?= $data['username']; ?></td>
            <td><?= $data['nama']; ?></td>
            <td><?= $data['kelas']; ?></td>
            <td>
                <a href="edit-siswa.php?id=<?= $data['id']; ?>" class="btn-edit">Edit</a> |
                <a href="hapus-siswa.php?id=<?= $data['id']; ?>" onclick="return confirm('Yakin?')" class="btn-hapus">Hapus</a>
            </td>
        </tr>
        <?php } ?>
        </table><br>
        <a href="admin.php" class="btn btn-kembali">Kembali</a>
    </div>
    
</body>
</html>
