<?php
include "../koneksi.php"; //ambil koneksi

$username = $_GET['username'];

$query = mysqli_query($koneksi, "SELECT * FROM `input_aspirasi` 
JOIN `admin` ON `input_aspirasi`.username = `admin`.username 
JOIN `kategori` ON `input_aspirasi`.id_kategori = `kategori`.id_kategori WHERE id_pelaporan = $username
");
$data = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pengaduan</title>
</head>
<body>
    <h2>Detail Kategori</h2>
    <div>NIS : <?= $data['nis'] ?></div>
    <div>Kategori : <?= $data['ket_kategori'] ?></div>
    <div>Lokasi : <?= $data['lokasi'] ?></div>
    <div>Status : <?= $data['status'] ?></div>
    <div>Keterangan : <?= $data['keterangan'] ?></div>

    <h1>Feedback</h1>
    <textarea name="" id="">
        <?= $data['feedback'] ?>
    </textarea>
</body>
</html>