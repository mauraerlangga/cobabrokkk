<?php
include "koneksi.php"; //ambil koneksi

$id = $_GET['id'];

$query = mysqli_query($koneksi, "SELECT * FROM `input_aspirasi` 
JOIN `siswa` ON `input_aspirasi`.nis = `siswa`.nis 
JOIN `kategori` ON `input_aspirasi`.id_kategori = `kategori`.id_kategori WHERE id_pelaporan = $id");
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