<?php
session_start();

if (!isset($_SESSION['id']) || $_SESSION['role'] != 'siswa') {
    header("Location: index.php");
    exit;
}

include 'koneksi.php';

$query_kategori = mysqli_query($koneksi, "SELECT * FROM kategori");
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Laporan</title>
    <style>
        body{
            background-color: rgb(142, 177, 138);
            margin: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: rgb(48, 68, 46);
        }
    </style>
</head>
<body>

<div class="wrap-formlap">
    <h2 style="font-size: 38px;">Form Laporan</h2>
    <hr>
    <form action="pengaduan-siswa.php" method="post">
        <label>Kategori</label><br>
        <select name="kategori" required>
            <option value="">--- Pilih Kategori ---</option>
            <?php while($row = mysqli_fetch_assoc($query_kategori)) { ?>
                <option value="<?= $row['id_kategori']; ?>">
                    <?= $row['ket_kategori']; ?>
                </option>
            <?php } ?>
        </select><br><br>

        <label>Lokasi</label><br>
        <input type="text" name="lokasi" placeholder="Misal : depan ruang guru" required><br><br>

        <label>Keterangan</label><br>
        <textarea name="keterangan" rows="4" placeholder="Misal : pot pecah" required></textarea><br><br>

        <button class="btn btn-kirim" type="submit">Kirim</button><br>
        <a class="btn btn-kembali" href="data-pengaduan-siswa.php">Kembali</a>
    </form>
</div>


</body>
</html>
