<?php
session_start();
// Cek keamanan agar hanya admin yang bisa akses
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    echo "Akses Ditolak. <a href='../index.php'>Login</a>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kategori</title>
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
            max-width: 600px; /* Lebar pas untuk form */
            margin: 0 auto;
            padding: 40px;
            background-color: #ffffff;
            border-radius: 20px;
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

        /* 4. Link Kembali */
        .back-link {
            display: inline-block;
            margin-bottom: 20px;
            text-decoration: none;
            color: #4F6356;
            font-weight: 600;
            font-size: 14px;
        }
        .back-link:hover { text-decoration: underline; }

        /* 5. Form Styling */
        .form-group { 
            margin-bottom: 25px; 
        }

        label { 
            display: block; 
            margin-bottom: 8px; 
            font-weight: bold; 
            color: #4F6356; /* Sage untuk label */
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        input[type="text"] { 
            width: 100%; 
            padding: 12px; 
            box-sizing: border-box;
            border: 1px solid #D1D9D6; /* Border lembut */
            border-radius: 8px; 
            font-family: inherit;
            font-size: 14px;
            transition: border-color 0.3s;
        }

        input[type="text"]:focus {
            outline: none;
            border-color: #78887C; /* Sage Medium saat diklik */
            box-shadow: 0 0 0 3px rgba(120, 136, 124, 0.1);
        }

        /* 6. Tombol Simpan */
        button { 
            width: 100%; /* Tombol memenuhi lebar */
            padding: 12px; 
            background-color: #4F6356; /* Sage Dark */
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
        <!-- Link Kembali -->
        <a href="data-kategori.php" class="back-link">&larr; Kembali ke Data Kategori</a>

        <h1>Tambah Data Kategori</h1>
        
        <form action="proses-tambah-kategori.php" method="POST">
            <div class="form-group">
                <label for="kategori">Nama Kategori Baru</label>
                <input type="text" id="kategori" name="kategori" placeholder="Masukkan nama kategori..." required>
            </div>

            <button type="submit" name="simpan">Simpan Data Kategori</button>
        </form>
    </div>

</body>
</html>