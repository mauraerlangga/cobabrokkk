<?php
session_start();
include 'koneksi.php';

// Cek apakah user sudah login
if (!isset($_SESSION['id']) || $_SESSION['role'] != 'siswa') {
    echo "Akses Ditolak. <a href='index.php'>Login</a>";
    exit;
}

 $id_user = $_SESSION['id'];
 $id_laporan = $_GET['id'];

// Ambil data laporan
 $query = mysqli_query($koneksi, "
    SELECT a.*, k.ket_kategori 
    FROM `input-aspirasi` a 
    JOIN kategori k ON a.id_kategori = k.id_kategori 
    WHERE a.id_pelaporan = '$id_laporan' AND a.iduser = '$id_user'
");

 $data = mysqli_fetch_assoc($query);

if (!$data) {
    // Jika data tidak ditemukan, tetap tampilkan dalam style yang sama
    echo "<body style='background-color: #AABFAC; font-family: sans-serif; display:flex; justify-content:center; align-items:center; height:100vh;'>";
    echo "<div style='background:white; padding:40px; border-radius:20px; text-align:center; box-shadow:0 10px 30px rgba(0,0,0,0.1);'>";
    echo "<h3 style='color:#4F6356;'>Data laporan tidak ditemukan atau Anda tidak berhak melihat laporan ini.</h3>";
    echo "<a href='siswa.php' style='display:inline-block; margin-top:20px; padding:10px 20px; background:#4F6356; color:white; text-decoration:none; border-radius:6px;'>Kembali</a>";
    echo "</div></body>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Laporan Saya</title>
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
            border-radius: 20px; /* Sudut tumpul */
            box-shadow: 0 10px 30px rgba(0,0,0,0.1); /* Bayangan halus */
        }

        /* 3. Tipografi & Elemen */
        h2 {
            color: #4F6356; /* Sage Dark */
            border-bottom: 2px solid #E8F0EB;
            padding-bottom: 15px;
            margin-top: 0;
        }

        .info-group { 
            margin-bottom: 20px; 
        }

        label { 
            display: block; 
            font-weight: bold; 
            color: #4F6356; /* Sage untuk label */
            margin-bottom: 8px; 
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .value { 
            font-size: 16px; 
            color: #555; 
            line-height: 1.6;
        }

        /* 4. Feedback Box (Sederhana & Bersih) */
        .feedback-wrapper {
            margin-top: 30px;
            padding: 20px;
            background-color: #F4F7F5; /* Sage sangat muda */
            border: 1px solid #E0E8E3;
            border-radius: 12px;
        }

        textarea { 
            width: 100%; 
            padding: 12px; 
            border: 1px solid #D1D9D6;
            border-radius: 8px; 
            resize: vertical; 
            background-color: #ffffff; 
            font-family: inherit;
            color: #555;
            font-size: 14px;
        }

        textarea:focus {
            outline: none;
            border-color: #78887C;
        }

        /* 5. Tombol */
        .btn { 
            padding: 10px 24px; 
            text-decoration: none; 
            color: white; 
            background-color: #4F6356; /* Sage Dark (Netral/Kembali) */
            border-radius: 6px; 
            display: inline-block; 
            margin-top: 30px; 
            font-weight: 500;
            transition: background 0.3s;
        }
        
        .btn:hover {
            background-color: #3A4A3F;
        }
        
        /* 6. Status Badge (Muted Style) */
        .status-badge { 
            padding: 6px 14px; 
            border-radius: 20px; /* Pill shape */
            font-size: 13px; 
            font-weight: bold; 
            display: inline-block;
        }
        
        .status-0 { 
            background-color: #999; 
            color: white; 
        } /* Abu-abu */

        .status-proses { 
            background-color: #D4B658; /* Kuning Muted */
            color: #333; 
        } 
        
        .status-selesai { 
            background-color: #78887C; /* Sage Medium */
            color: white;
        }

        .status-tolak { 
            background-color: #9E4F4F; /* Merah Muted */
            color: white;
        }

    </style>
</head>
<body>

    <div class="container">
        <h2>Detail Laporan #<?= $data['id_pelaporan'] ?></h2>
        
        <!-- Data Dasar -->
        <div class="info-group">
            <label>Kategori</label>
            <div class="value"><?= $data['ket_kategori'] ?></div>
        </div>

        <div class="info-group">
            <label>Lokasi</label>
            <div class="value"><?= $data['lokasi'] ?></div>
        </div>

        <div class="info-group">
            <label>Isi Laporan</label>
            <div class="value"><?= nl2br($data['keterangan']) ?></div>
        </div>

        <div class="info-group">
            <label>Status Saat Ini</label>
            <div class="value">
                <?php 
                // Logika Status
                $statusClass = 'status-0'; 
                $statusText = 'Menunggu';
                $dbStatus = isset($data['status']) ? $data['status'] : '';
                
                if($dbStatus == 'proses') { 
                    $statusClass = 'status-proses'; 
                    $statusText = 'Sedang Diproses'; 
                } elseif($dbStatus == 'selesai') { 
                    $statusClass = 'status-selesai'; 
                    $statusText = 'Selesai'; 
                } elseif($dbStatus == 'tolak') { 
                    $statusClass = 'status-tolak'; 
                    $statusText = 'Ditolak'; 
                }
                ?>
                <span class="status-badge <?= $statusClass ?>"><?= $statusText ?></span>
            </div>
        </div>

        <!-- BAGIAN TANGGAPAN (Sederhana) -->
        <div class="feedback-wrapper">
            <label>Tanggapan Admin</label>
            <?php 
            if(!empty($data['feedback'])) {
                // Menampilkan feedback dalam textarea readonly
                echo "<textarea rows='5' readonly>" . htmlspecialchars($data['feedback']) . "</textarea>";
            } else {
                echo "<p style='color: #888; font-style: italic; margin:0;'>Belum ada tanggapan dari admin.</p>";
            }
            ?>
        </div>

        <!-- Tombol Kembali -->
        <div style="text-align: right;">
            <a href="siswa.php" class="btn">&larr; Kembali ke Riwayat</a>
        </div>
    </div>

</body>
</html>