<?php
session_start();
if (!isset($_SESSION['id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../index.php");
    exit;
}
include '../koneksi.php';

$query = mysqli_query($koneksi, "SELECT * FROM kategori");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Kategori</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
<div class="wrap wrap-kategori">
    <h2 style="font-size: 35px;">Data Kategori</h2>
    <hr>
    <a href="tambah-kategori.php" class="btn-action">+ Tambah Kategori</a><br><br>

    <table border="1" cellpadding="10" cellspacing="0px">
    <tr>
        <th>ID</th>
        <th>Nama Kategori</th>
        <th>Aksi</th>
    </tr>

    <?php while($data = mysqli_fetch_assoc($query)) { ?>
    <tr>
        <td><?= $data['id_kategori']; ?></td>
        <td><?= $data['ket_kategori']; ?></td>
        <td>
            <a href="edit-kategori.php?id=<?= $data['id_kategori']; ?>" class="btn-edit">Edit</a> |
            <a href="hapus-kategori.php?id=<?= $data['id_kategori']; ?>" onclick="return confirm('Yakin?')" class="btn-hapus">Hapus</a>
        </td>
    </tr>
    <?php } ?>

    </table><br>
    <a href="admin.php" class="btn btn-kembali">Kembali</a>
</div>


</body>
</html>
