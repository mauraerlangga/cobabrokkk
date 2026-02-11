<?php
session_start();
include '../koneksi.php';

// Proses Update Data
if (isset($_POST['update'])) {
    // Ambil id_pelaporan dari form hidden
    $id_pelaporan = $_POST['id_pelaporan']; 
    $status = $_POST['status'];
    $feedback = $_POST['feedback'];

    // Query Update menggunakan WHERE id_pelaporan
    $query_update = mysqli_query($koneksi, "UPDATE `input-aspirasi` SET status='$status', feedback='$feedback' WHERE id_pelaporan='$id_pelaporan'");

    if ($query_update) {
        echo "<script>alert('Data berhasil diperbarui!'); window.location.href='data-pengaduan-admin.php';</script>";
    } else {
        echo "Gagal: " . mysqli_error($koneksi);
    }
}

// Ambil ID dari URL
 $id_laporan = $_GET['id'];

// Query Ambil Detail menggunakan WHERE id_pelaporan
 $query = mysqli_query($koneksi, "
    SELECT a.*, u.nama, u.username, k.ket_kategori 
    FROM `input-aspirasi` a 
    JOIN `user` u ON a.iduser = u.id 
    JOIN `kategori` k ON a.id_kategori = k.id_kategori 
    WHERE a.id_pelaporan = '$id_laporan'
");

 $data = mysqli_fetch_assoc($query);

if (!$data) {
    // Tampilkan error dengan style yang sama jika data tidak ditemukan
    echo "<body style='background-color: #AABFAC; font-family: sans-serif; display:flex; justify-content:center; align-items:center; height:100vh;'>";
    echo "<div style='background:white; padding:40px; border-radius:20px; text-align:center; box-shadow:0 10px 30px rgba(0,0,0,0.1);'>";
    echo "<h3 style='color:#C26A6A;'>Data laporan tidak ditemukan.</h3>";
    echo "<a href='data-pengaduan-admin.php' style='display:inline-block; margin-top:20px; padding:10px 20px; background:#4F6356; color:white; text-decoration:none; border-radius:6px;'>Kembali</a>";
    echo "</div></body>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pengaduan</title>
    <style>
        /* 1. Global Styles & Background */
        body { 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #AABFAC; /* Hijau Sage Muted */
            margin: 0;
            padding: 40px 20px;
            color: #333;
        }

        /* 2. Container Putih Utama */
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 40px;
            background-color: #ffffff;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        /* 3. Tipografi */
        h2 {
            color: #4F6356; /* Sage Dark */
            margin-top: 0;
            border-bottom: 2px solid #E8F0EB;
            padding-bottom: 15px;
            margin-bottom: 30px;
        }

        h3 {
            color: #4F6356;
            margin-bottom: 20px;
        }

        /* 4. Group Informasi (Read Only) */
        .info-group { 
            margin-bottom: 20px; 
        }

        label { 
            display: block; 
            margin-bottom: 8px; 
            font-weight: bold; 
            color: #4F6356; /* Sage untuk label */
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Style khusus untuk input yang Read Only */
        .input-readonly {
            width: 100%; 
            padding: 12px; 
            box-sizing: border-box;
            border: 1px solid #E0E8E3; /* Border sangat halus */
            background-color: #F4F7F5; /* Sage Sangat Muda */
            border-radius: 8px; 
            color: #555;
            font-size: 15px;
            cursor: not-allowed;
        }

        textarea.input-readonly {
            resize: vertical;
            min-height: 80px;
        }

        /* 5. Section Form Edit (Proses Laporan) */
        .process-section {
            background-color: #fafafa; /* Sedikit beda background untuk area kerja admin */
            padding: 25px;
            border-radius: 15px;
            border: 1px solid #E8F0EB;
            margin-top: 30px;
        }

        hr {
            border: 0;
            border-top: 1px solid #eee;
            margin: 40px 0;
        }

        /* Style Input Edit */
        select, textarea.editable { 
            width: 100%; 
            padding: 12px; 
            box-sizing: border-box;
            border: 1px solid #D1D9D6; 
            border-radius: 8px; 
            font-family: inherit;
            font-size: 14px;
            background-color: #fff;
            transition: border-color 0.3s;
        }

        select:focus, textarea.editable:focus {
            outline: none;
            border-color: #78887C;
        }

        /* 6. Tombol */
        .btn { 
            padding: 12px 24px; 
            color: white; 
            border: none; 
            border-radius: 8px; 
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            transition: opacity 0.3s;
        }

        .btn:hover { opacity: 0.9; }

        .btn-save { 
            background-color: #4F6356; /* Sage Dark (Simpan) */
            width: 100%; /* Full width di dalam form */
        }

        .btn-back { 
            background-color: #8C8C8C;
            display: block;
            text-align: center;
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Detail Laporan #<?= $data['id_pelaporan'] ?></h2>
        
        <div class="info-group">
            <label>Nama Pelapor</label>
            <div class="input-readonly" style="background: transparent; border: none; padding-left: 0; font-weight: bold; color: #333;">
                <?= $data['nama'] ?> <span style="font-weight:normal; color:#888;">(<?= $data['username'] ?>)</span>
            </div>
        </div>

        <div class="info-group">
            <label>Kategori</label>
            <input type="text" value="<?= $data['ket_kategori'] ?>" class="input-readonly" readonly>
        </div>

        <div class="info-group">
            <label>Lokasi</label>
            <input type="text" value="<?= $data['lokasi'] ?>" class="input-readonly" readonly>
        </div>

        <div class="info-group">
            <label>Isi Laporan</label>
            <textarea rows="4" class="input-readonly" readonly><?= $data['keterangan'] ?></textarea>
        </div>

        <hr>

        <div class="process-section">
            <h3>Proses Laporan</h3>
            <form action="" method="POST">
                <input type="hidden" name="id_pelaporan" value="<?= $data['id_pelaporan'] ?>">

                <div class="info-group">
                    <label for="status">Update Status</label>   
                    <select name="status" id="status">
                        <option value="0" <?= $data['status'] == '0' || $data['status'] == '' ? 'selected' : '' ?>>Menunggu</option>
                        <option value="proses" <?= $data['status'] == 'proses' ? 'selected' : '' ?>>Proses</option>
                        <option value="selesai" <?= $data['status'] == 'selesai' ? 'selected' : '' ?>>Selesai</option>
                        <option value="batal" <?= $data['status'] == 'batal' ? 'selected' : '' ?>>Batal</option>
                    </select>
                </div>

                <div class="info-group">
                    <label for="feedback">Tanggapan / Feedback Admin</label>
                    <textarea name="feedback" id="feedback" rows="5" class="editable" placeholder="Tulis tanggapan atau instruksi tindak lanjut..."><?= $data['feedback'] ?></textarea>
                </div>

                <button type="submit" name="update" class="btn btn-save">Simpan Perubahan</button>
            </form>
        </div>

        <!-- Tombol Kembali -->
        <a href="data-pengaduan-admin.php" class="btn btn-back">&larr; Kembali ke Dashboard</a>
    </div>
</body>
</html>