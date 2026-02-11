<?php
session_start();
include 'koneksi.php';

// Cek apakah user sudah login dan role-nya siswa
if (!isset($_SESSION['id']) || $_SESSION['role'] != 'siswa') {
    echo "Anda tidak punya akses atau belum login. <a href='index.php'>Login disini</a>";
    exit;
}

 $id_user = $_SESSION['id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Siswa</title>
    <!-- CSS DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css">
    <!-- Jika Anda memiliki style.css terpisah dari langkah sebelumnya, aktifkan baris di bawah ini: -->
    <!-- <link rel="stylesheet" href="style.css"> -->
    
    <style>
        /* 1. Pengaturan Background Halaman (Hijau Sage Muted) */
        body { 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #AABFAC; /* Hijau Sage Muted Background */
            margin: 0;
            padding: 40px 20px; /* Jarak pinggir layar agar kotak tidak mepet */
            color: #333;
        }
        
        /* 2. Kotak Putih Utama (Container) */
        .main-container {
            background-color: #ffffff; /* Putih */
            max-width: 1100px;         /* Lebar maksimal konten */
            margin: 0 auto;            /* Posisi Tengah Horizontal */
            padding: 40px;             /* Ruang dalam kotak */
            border-radius: 20px;       /* Sudut Tumpul */
            box-shadow: 0 10px 30px rgba(0,0,0,0.1); /* Bayangan halus agar efek timbul */
        }

        /* 3. Tipografi dan Elemen Dasar */
        h1 {
            color: #4F6356; /* Sage Dark */
            border-bottom: 2px solid #E8F0EB;
            padding-bottom: 15px;
            margin-top: 0;
        }

        h2 {
            color: #4F6356;
            font-size: 18px;
            margin-bottom: 15px;
        }

        hr {
            border: 0;
            border-top: 1px solid #E8F0EB;
            margin: 25px 0;
        }
        
        /* 4. Style DataTables Tambahan */
        .dataTables_wrapper { 
            font-size: 14px; 
        }

        /* 5. Tombol (Mempertahankan warna dari kode sebelumnya) */
        .btn { 
            padding: 8px 16px; 
            text-decoration: none; 
            color: white;
            border-radius: 6px; /* Sedikit lebih tumpul */
            font-size: 13px; 
            display: inline-block;
            transition: opacity 0.3s;
        }

        .btn:hover {
            opacity: 0.9;
        }

        .btn-primary { 
            background-color: #4F6356; /* Sage Dark */
        }

        .btn-danger { 
            background-color: #C26A6A; /* Muted Red */
        }

        .btn-info { 
            background-color: #5F7A76; /* Muted Blue/Green */
        }
        
        /* 6. Badge Status */
        .status-badge { 
            padding: 5px 10px; 
            border-radius: 15px; /* Lebih bulat/pill */
            font-size: 11px; 
            font-weight: bold; 
            color: white; 
        }

        .status-0 { 
            background-color: #999 !important; 
        } 

        .status-proses { 
            background-color: #D4B658 !important; /* Kuning Muted */
            color: #333 !important;
        } 

        .status-selesai { 
            background-color: #78887C !important; /* Sage Medium */
        }

        .status-tolak { 
            background-color: #9E4F4F !important; /* Red Muted Dark */
        }

        /* 7. Override Warna Tabel DataTables agar cocok dengan tema */
        table.dataTable thead th {
            background-color: #78887C !important; /* Sage Medium */
            color: white !important;
            border-bottom: 2px solid #4F6356 !important;
        }
        
        table.dataTable tbody tr.odd {
            background-color: #ffffff !important;
        }
        
        table.dataTable tbody tr.even {
            background-color: #F4F7F5 !important; /* Sage Sangat Pudar */
        }

        table.dataTable tbody tr:hover {
            background-color: #E8F0EB !important; /* Highlight Sage */
        }
    </style>
</head>
<body>

    <!-- CONTAINER PUTIH UTAMA: Semua elemen dibungkus di sini -->
    <div class="main-container">
        
        <h1>Selamat Datang, <?php echo $_SESSION['nama']; ?></h1>
        
        <p>
            <a href="form-pengaduan.php" class="btn btn-primary">+ Buat Laporan Baru</a> | 
            <a href="logout.php" class="btn btn-danger">Logout</a>
        </p>
        
        <hr>

        <h2>Riwayat Laporan Saya</h2>
        
        <?php
        // Query mengambil data aspirasi milik user
        $query = mysqli_query($koneksi, "
            SELECT a.*, k.ket_kategori 
            FROM `input-aspirasi` a 
            JOIN kategori k ON a.id_kategori = k.id_kategori 
            WHERE a.iduser = '$id_user'
        ");

        if(mysqli_num_rows($query) > 0){
        ?>
            <!-- Tabel -->
            <table id="datatable" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kategori</th>
                        <th>Lokasi</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    while ($row = mysqli_fetch_assoc($query)) {
                        // Logika pewarnaan status
                        $statusClass = 'status-0';
                        $statusText = 'Menunggu';
                        
                        if($row['status'] == 'proses') { $statusClass = 'status-proses'; $statusText = 'Sedang Diproses'; }
                        elseif($row['status'] == 'selesai') { $statusClass = 'status-selesai'; $statusText = 'Selesai'; }
                        elseif($row['status'] == 'tolak') { $statusClass = 'status-tolak'; $statusText = 'Ditolak'; }
                    ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $row['ket_kategori']; ?></td>
                            <td><?php echo $row['lokasi']; ?></td>
                            <td><span class="status-badge <?php echo $statusClass; ?>"><?php echo $statusText; ?></span></td>
                            <td>
                                <a href="detail-pengaduan.php?id=<?= $row['id_pelaporan']; ?>" class="btn btn-info">Lihat Detail</a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        <?php
        } else {
            echo "<p style='text-align:center; color: #777; margin-top:20px;'>Belum ada laporan yang dikirim.</p>";
        }
        ?>

    </div>
    <!-- AKHIR CONTAINER PUTIH UTAMA -->

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
                // Menghilangkan fitur sorting default jika tidak diperlukan, atau biarkan default
                "pageLength": 10
            });
        });
    </script>
</body>
</html>