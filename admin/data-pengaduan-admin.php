<?php
session_start();
// Cek apakah yang login admin
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    echo "Akses Ditolak. <a href='../index.php'>Login</a>";
    exit;
}

include '../koneksi.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <!-- CSS DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css">
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
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px;
            background-color: #ffffff;
            border-radius: 20px; /* Sudut Tumpul */
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        /* 3. Judul Halaman (Paling Atas) */
        h1 {
            color: #4F6356; /* Sage Dark */
            margin-top: 0; /* Supaya menempel tepat di atas container */
            margin-bottom: 25px; /* Jarak ke elemen di bawahnya */
            border-bottom: 2px solid #E8F0EB;
            padding-bottom: 15px;
            font-size: 24px;
        }

        /* 4. Header Admin (Di Bawah Judul) */
        .admin-header {
            display: flex;
            align-items: center; /* Vertikal tengah */
            gap: 15px; /* Jarak antar elemen */
            margin-bottom: 30px; /* Jarak ke tabel */
            margin-top: 10px; /* Sedikit jarak dari judul */
            flex-wrap: wrap; /* Agar responsif */
        }

        .welcome-text {
            color: #4F6356; /* Sage Dark */
            font-size: 16px;
            font-weight: 600;
            margin: 0;
        }

        .divider {
            color: #ccc;
            font-weight: bold;
            font-size: 18px;
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

        .btn-primary { background-color: #5F7A76; } /* Muted Blue-Green (Detail) */
        .btn-action  { background-color: #78887C; } /* Sage Medium (Tambah Data) */
        .btn-danger  { background-color: #C26A6A; } /* Muted Red (Logout) */

        /* 6. Tabel Styling */
        .dataTables_wrapper { font-size: 14px; padding-top: 10px; }

        table.dataTable thead th {
            background-color: #78887C !important; /* Sage Medium */
            color: white !important;
            border-bottom: 2px solid #4F6356 !important;
        }

        table.dataTable tbody tr.odd { background-color: #ffffff !important; }
        table.dataTable tbody tr.even { background-color: #F4F7F5 !important; } /* Sage Sangat Muda */
        table.dataTable tbody tr:hover { background-color: #E8F0EB !important; }

        /* 7. Status Badge */
        .status-badge { 
            padding: 4px 10px; 
            border-radius: 20px; 
            font-size: 11px; 
            font-weight: bold; 
            color: white; 
            display: inline-block;
        }

        .status-0 { background-color: #999 !important; } 
        .status-proses { background-color: #D4B658 !important; color: #333 !important; } 
        .status-selesai { background-color: #78887C !important; } 
        .status-tolak { background-color: #9E4F4F !important; } 
    </style>
</head>
<body>

    <div class="container">
        
        <!-- 1. JUDUL HALAMAN (Paling Atas) -->
        <h1>Data Pengaduan Masuk</h1>

        <!-- 2. HEADER ADMIN (Sejajar, Di Bawah Judul) -->
        <div class="admin-header">
            <p class="welcome-text">
                Selamat Datang, <b><?php echo $_SESSION['nama']; ?></b>
            </p>
            
            <!-- Garis Pemisah -->
            <span class="divider">|</span>
            
            <!-- Tombol Aksi -->
            <a href="data-kategori.php" class="btn btn-action">+ Kategori</a>
            <a href="data-siswa.php" class="btn btn-action">+ Siswa</a>
            <a href="../logout.php" class="btn btn-danger">Logout</a>
        </div>

        <!-- Tabel Data -->
        <table id="datatable" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>ID Pelaporan</th>
                    <th>Nama Siswa</th>
                    <th>Username</th>
                    <th>Kategori</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = mysqli_query($koneksi, "
                    SELECT a.id_pelaporan, u.nama, u.username, k.ket_kategori, a.status 
                    FROM `input-aspirasi` a
                    JOIN `user` u ON a.iduser = u.id 
                    JOIN `kategori` k ON a.id_kategori = k.id_kategori 
                    ORDER BY 
                        CASE a.status 
                            WHEN 'proses' THEN 1
                            WHEN '0' THEN 2
                            WHEN '' THEN 2
                            WHEN 'tolak' THEN 3
                            WHEN 'selesai' THEN 4
                            ELSE 5
                        END ASC,
                        a.id_pelaporan DESC
                ");

                while($data = mysqli_fetch_assoc($query)){ 
                    $s = $data['status'];
                    $badgeClass = 'status-0';
                    $statusLabel = 'Menunggu';

                    if($s == 'proses') { 
                        $badgeClass = 'status-proses'; 
                        $statusLabel = 'Proses';
                    } elseif($s == 'selesai') { 
                        $badgeClass = 'status-selesai'; 
                        $statusLabel = 'Selesai';
                    } elseif($s == 'tolak') { 
                        $badgeClass = 'status-tolak'; 
                        $statusLabel = 'Ditolak';
                    }
                ?>
                <tr>
                    <td><?= $data["id_pelaporan"]; ?></td>
                    <td><?= $data["nama"]; ?></td>
                    <td><?= $data["username"]; ?></td>
                    <td><?= $data["ket_kategori"]; ?></td>
                    <td>
                        <span class="status-badge <?= $badgeClass; ?>">
                            <?= $statusLabel; ?>
                        </span>
                    </td>
                    <td>
                        <a href="detail-pengaduan-admin.php?id=<?= $data['id_pelaporan']; ?>" class="btn btn-primary">Detail / Proses</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <!-- Script jQuery & DataTables -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#datatable').DataTable({
                "order": [],
                "language": {
                    "search": "Cari:",
                    "lengthMenu": "Tampilkan _MENU_ data",
                    "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    "paginate": {
                        "next": "Selanjutnya",
                        "previous": "Sebelumnya"
                    }
                }
            });
        });
    </script>
</body>
</html> 