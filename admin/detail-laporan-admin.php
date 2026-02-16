<?php
session_start();

if (!isset($_SESSION['id']) || $_SESSION['role'] != 'admin') {
    header("Location: index.php");
    exit;
}

include '../koneksi.php';

$id_laporan = $_GET['id'];
$alert = "";

// Jika tombol update ditekan
if (isset($_POST['update'])) {

    $status = $_POST['status'];
    $feedback = $_POST['feedback'];

    $update = mysqli_query($koneksi, "
        UPDATE `input-aspirasi`
        SET status='$status', feedback='$feedback'
        WHERE id_pelaporan='$id_laporan'
    ");

    if ($update) {
        $alert = "<script>alert('Data berhasil diperbarui!');</script>";
    } else {
        $alert = "<script>alert('Gagal memperbarui data!');</script>";
    }
}

// Ambil data laporan
$query = mysqli_query($koneksi, "
SELECT `input-aspirasi`.*, kategori.ket_kategori, user.nama
FROM `input-aspirasi`
LEFT JOIN kategori 
ON `input-aspirasi`.id_kategori = kategori.id_kategori
LEFT JOIN user
ON `input-aspirasi`.iduser = user.id
WHERE `input-aspirasi`.id_pelaporan = '$id_laporan'
");

$data = mysqli_fetch_assoc($query);

if (!$data) {
    echo "Data tidak ditemukan!";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Detail Laporan Admin</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <div class="wrap wrap-detmi">
            <?= $alert ?>

            <h2 style="font-size: 30px;">Detail Laporan</h2>
            <hr>

            <p><strong>Nama Siswa:</strong> <?= $data['nama']; ?></p>

            <p><strong>Kategori:</strong> <?= $data['ket_kategori']; ?></p>

            <p><strong>Lokasi:</strong> <?= $data['lokasi']; ?></p>

            <p><strong>Keterangan:</strong><br>
            <?= $data['keterangan']; ?></p>

            <hr>

            <h3>Update Status & Feedback</h3>

            <form method="POST">

            <label>Status:</label><br>
            <select name="status" required>
                <option value="menunggu" <?= ($data['status'] == 'menunggu') ? 'selected' : '' ?>>Menunggu</option>
                <option value="proses" <?= ($data['status'] == 'proses') ? 'selected' : '' ?>>Proses</option>
                <option value="selesai" <?= ($data['status'] == 'selesai') ? 'selected' : '' ?>>Selesai</option>
            </select>

            <br><br>

            <label>Feedback:</label><br>
            <textarea name="feedback" rows="4" cols="50"><?= $data['feedback']; ?></textarea>

            <br><br>

            <button type="submit" name="update" class="btn btn-kirim">Simpan Perubahan</button><br>
            <a href="admin.php" class="btn btn-kembali">Kembali</a>

        </form>

    </div>
    
</body>
</html>
