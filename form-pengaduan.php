<?php
session_start();
// Cek keamanan agar orang yang belum login tidak bisa isi form
if (!isset($_SESSION['id'])) {
    header("Location: index.php");
    exit;
}

// 1. Sertakan file koneksi database
include 'koneksi.php';

// 2. Ambil data kategori dari database
 $query_kategori = mysqli_query($koneksi, "SELECT * FROM kategori");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pengaduan</title>
    <style>
        /* 1. Global Styles & Background */
        body { 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #AABFAC; /* Hijau Sage Muted */
            margin: 0;
            padding: 40px 20px;
            color: #333;
        }

        /* 2. Container Putih Utama (Kartu) */
        .container {
            max-width: 600px; /* Lebar form tidak perlu terlalu lebar */
            margin: 0 auto;
            padding: 40px;
            background-color: #ffffff;
            border-radius: 20px; /* Sudut tumpul */
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        /* 3. Tipografi */
        h1 {
            color: #4F6356; /* Sage Dark */
            margin-top: 0;
            border-bottom: 2px solid #E8F0EB;
            padding-bottom: 15px;
            margin-bottom: 25px;
        }

        .back-link {
            display: inline-block;
            margin-bottom: 20px;
            text-decoration: none;
            color: #4F6356; /* Sage Dark */
            font-weight: 600;
            font-size: 14px;
        }

        .back-link:hover {
            text-decoration: underline;
            color: #3A4A3F;
        }

        /* 4. Form Styling */
        .form-group { 
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

        /* Style untuk Input Text, Select, dan Textarea */
        input[type="text"], 
        select, 
        textarea { 
            width: 100%; 
            padding: 12px; 
            box-sizing: border-box;
            border: 1px solid #D1D9D6; /* Border lembut */
            border-radius: 8px; /* Sudut membulat */
            font-family: inherit;
            font-size: 14px;
            background-color: #FAFAFA;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        /* Efek saat diklik (Focus) */
        input[type="text"]:focus, 
        select:focus, 
        textarea:focus {
            outline: none;
            border-color: #78887C; /* Sage Medium */
            background-color: #ffffff;
            box-shadow: 0 0 0 3px rgba(120, 136, 124, 0.1);
        }

        /* 5. Tombol */
        button { 
            width: 100%; /* Tombol memenuhi lebar form */
            padding: 12px; 
            background-color: #4F6356; /* Sage Dark (Warna Utama) */
            color: white; 
            border: none; 
            border-radius: 8px; 
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
            transition: background-color 0.3s;
        }

        button:hover { 
            background-color: #3A4A3F; /* Lebih gelap saat hover */
        }

    </style>
</head>
<body>

    <div class="container">
        <!-- Link kembali ke dashboard -->
        <a href="siswa.php" class="back-link">&larr; Kembali ke Dashboard</a>
        
        <h1>Form Pengaduan</h1>
        
        <form action="proses-pengaduan.php" method="POST">
            
            <div class="form-group">
                <label for="kategori">Kategori</label>
                <select name="kategori" id="kategori" required>
                    <option value="">--- Pilih Kategori ---</option>
                    
                    <!-- 3. Looping PHP untuk menampilkan opsi dari database -->
                    <?php
                    // Asumsi nama kolom ID adalah 'id_kategori' dan Nama adalah 'ket_kategori'
                    while($row = mysqli_fetch_assoc($query_kategori)) {
                    ?>
                        <!-- Value akan berisi ID kategori (1, 2, dst) -->
                        <option value="<?php echo $row['id_kategori']; ?>">
                            <?php echo $row['ket_kategori']; ?>
                        </option>
                    <?php 
                    } 
                    ?>
                    <!-- Akhir Looping -->
                    
                </select>
            </div>

            <div class="form-group">
                <label for="lokasi">Lokasi</label>
                <input type="text" name="lokasi" id="lokasi" placeholder="Contoh: Lantai 2, Koridor" required>
            </div>

            <div class="form-group">
                <label for="keterangan">Keterangan Laporan</label>
                <textarea name="keterangan" id="keterangan" rows="5" placeholder="Jelaskan detail masalah..." required></textarea>
            </div>

            <div class="form-group" style="margin-top: 30px;">
                <button type="submit">Kirim Pengaduan</button>
            </div>
        </form>
    </div>

</body>
</html>