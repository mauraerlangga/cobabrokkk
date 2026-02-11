<?php
session_start(); // Pastikan sesi aktif
// Cek keamanan (opsional tapi disarankan agar admin saja yang akses)
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    echo "Akses Ditolak.";
    exit;
}

include '../koneksi.php';

// Query mengambil semua data kategori
 $query = mysqli_query($koneksi, "SELECT * FROM kategori ORDER BY id_kategori DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Kategori</title>
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
            max-width: 900px; /* Lebar sedikit lebih kecil karena datanya sederhana */
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
            justify-content: space-between; /* Kiri: Kembali, Kanan: Tambah */
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

    </style>
</head>
<body>

    <div class="container">
        <!-- Judul Halaman -->
        <h1>Manajemen Kategori</h1>

        <!-- Toolbar Navigasi -->
        <div class="toolbar">
            <a href="data-pengaduan-admin.php" class="btn btn-back">&larr; Kembali ke Dashboard</a>
            
            <!-- Tombol Tambah Kategori -->
            <a href="form-kategori.php" class="btn btn-action">+ Tambah Kategori</a>
        </div>

        <!-- Tabel Data -->
        <table id="datatable" class="display" style="width:100%">
            <thead>
                <tr>
                    <th width="10%">No</th>
                    <th width="60%">Nama Kategori</th>
                    <th width="30%" style="text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                while($row = mysqli_fetch_assoc($query)){
                ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $row['ket_kategori']; ?></td>
                    <td style="text-align: center;">
                        <!-- Tombol Edit -->
                        <a href="edit-kategori.php?id=<?= $row['id_kategori']; ?>" class="btn btn-info">Edit</a>
                        
                        <!-- Spasi kecil antar tombol -->
                        
                        <!-- Tombol Hapus -->
                        <a href="proses-hapus-kategori.php?id=<?= $row['id_kategori']; ?>" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus kategori ini?')">Hapus</a>
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
                "language": {
                    "search": "Cari:",
                    "lengthMenu": "Tampilkan _MENU_ data",
                    "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    "paginate": {
                        "next": "Selanjutnya",
                        "previous": "Sebelumnya"
                    }
                },
                "columnDefs": [
                    { "orderable": false, "targets": 2 } // Kolom Aksi tidak bisa di-sort
                ]
            });
        });
    </script>
</body>
</html>