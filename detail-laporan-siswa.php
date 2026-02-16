<?php
session_start();

if (!isset($_SESSION['id']) || $_SESSION['role'] != 'siswa') {
    header("Location: index.php");
    exit;
}

include 'koneksi.php';

$id_user = $_SESSION['id'];
$id_laporan = $_GET['id'];

// Ambil data laporan sesuai id dan pastikan milik siswa yg login
$query = mysqli_query($koneksi, "
SELECT `input-aspirasi`.*, kategori.ket_kategori 
FROM `input-aspirasi`
LEFT JOIN kategori 
ON `input-aspirasi`.id_kategori = kategori.id_kategori
WHERE `input-aspirasi`.id_pelaporan = '$id_laporan'
AND `input-aspirasi`.iduser = '$id_user'
");

$data = mysqli_fetch_assoc($query);

// Jika tidak ditemukan, kembali
if (!$data) {
    echo "Data tidak ditemukan!";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Detail Laporan</title>
</head>
<body>
    <div class="wrap wrap-detsis">
        <h2 style="font-size: 30px;">Detail Laporan</h2>
        <hr>

        <p><strong>Kategori:</strong> <?= $data['ket_kategori']; ?></p>

        <p><strong>Lokasi:</strong> <?= $data['lokasi']; ?></p>

        <p><strong>Keterangan:</strong><br>
        <?= $data['keterangan']; ?></p>
        <hr>

        <p><strong>Status:</strong> <?= $data['status']; ?></p>

        <p style="border: 1px solid rgb(214, 214, 214); padding:15px; border-radius: 5px; box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);"><strong>Feedback Admin:</strong><br>
        <?php
        if (empty($data['feedback'])) {
            echo "admin belum memberikan feedback";
        } else {
            echo $data['feedback'];
        }
        ?>
        </p><br>
        <a href="data-pengaduan-siswa.php" class="btn btn-kembali">Kembali</a>
    </div>
    
</body>
</html>
