<?php
session_start();
// Cek keamanan agar hanya admin yang bisa akses
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    echo "Akses Ditolak. <a href='../index.php'>Login</a>";
    exit;
}

include '../koneksi.php';

// Query mengambil data user yang role-nya 'siswa'
 $query = mysqli_query($koneksi, "SELECT * FROM user WHERE role='siswa' ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Siswa</title>
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
            max-width: 1000px; /* Lebar yang pas untuk banyak kolom */
            margin: 0 auto;
            padding: 40px;
            background-color: #ffffff;
            border-radius: 20px; 
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        /* 3. Judul */
        h1 {
            color: #4F6356; /* Sage Dark */
            margin-top: 0;
            border-bottom: 2px solid #E8F0EB;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }

        /* 4. Toolbar (Tombol Kembali & Tambah) */
        .toolbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            flex-wrap: wrap;
            gap: 10px;
        }

        /* 5. Tombol (Button Styling) */
        .btn {
            padding: 8px 16px;
            text-decoration: none;
            color: white;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 500;
            display: inline-block;
            transition: opacity 0.3s;
        }

        .btn:hover { opacity: 0.9; }

        .btn-back   { background-color: #8C8C8C; } /* Abu-abu (Kembali) */
        .btn-action { background-color: #78887C; } /* Sage Medium (Tambah) */
        .btn-info   { background-color: #5F7A76; } /* Muted Blue-Green (Edit) */
        .btn-danger { background-color: #C26A6A; } /* Muted Red (Hapus) */

        /* 6. Tabel Styling (Tanpa DataTables JS, tapi Style-nya disamakan) */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th {
            background-color: #78887C !important; /* Sage Medium */
            color: white !important;
            font-weight: 600;
            padding: 12px 15px;
            text-align: left;
            border-bottom: 2px solid #4F6356;
        }

        td {
            padding: 12px 15px;
            border-bottom: 1px solid #eee;
            color: #555;
            font-size: 14px;
        }

        /* Baris selang-seling */
        tr:nth-child(even) { background-color: #F4F7F5; } /* Sage Sangat Muda */
        tr:nth-child(odd) { background-color: #ffffff; }
        
        tr:hover {
            background-color: #E8F0EB !important; /* Highlight Sage */
        }

        /* Style khusus kolom password agar sedikit beda (opsional) */
        .password-text {
            font-family: monospace;
            background: #eee;
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 12px;
        }
    </style>
</head>
<body>

    <div class="container">
        <!-- Judul Halaman -->
        <h1>Data Siswa</h1>

        <!-- Toolbar Navigasi -->
        <div class="toolbar">
            <a href="data-pengaduan-admin.php" class="btn btn-back">&larr; Kembali ke Dashboard</a>
            
            <!-- Tombol Tambah Siswa -->
            <a href="form-siswa.php" class="btn btn-action">+ Tambah Siswa</a>
        </div>

        <!-- Tabel Data -->
        <table>
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th width="25%">Nama</th>
                    <th width="20%">Username</th>
                    <th width="15%">Kelas</th>
                    <th width="20%">Password</th>
                    <th width="15%" style="text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                while($row = mysqli_fetch_assoc($query)){
                ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><b><?= $row['nama']; ?></b></td>
                    <td><?= $row['username']; ?></td>
                    <td><?= $row['kelas']; ?></td>
                    <!-- Password ditampilkan sesuai sistem asli, diberi class khusus -->
                    <td><span class="password-text"><?= $row['password']; ?></span></td>
                    
                    <td style="text-align: center;">
                        <!-- Tombol Edit -->
                        <a href="edit-siswa.php?id=<?= $row['id']; ?>" class="btn btn-info">Edit</a>
                        
                        <!-- Spasi -->
                        
                        <!-- Tombol Hapus -->
                        <a href="proses-hapus-siswa.php?id=<?= $row['id']; ?>" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus siswa ini?')">Hapus</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

</body>
</html>