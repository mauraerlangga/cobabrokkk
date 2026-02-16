<?php
session_start();

if (!isset($_SESSION['id']) || $_SESSION['role'] != 'siswa') {
    header("Location: index.php");
    exit;
}

include 'koneksi.php';

$id_user = $_SESSION['id'];

$query = mysqli_query($koneksi, "
SELECT `input-aspirasi`.*, kategori.ket_kategori 
FROM `input-aspirasi`
LEFT JOIN kategori 
ON `input-aspirasi`.id_kategori = kategori.id_kategori
WHERE `input-aspirasi`.iduser = '$id_user'
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Pengaduan Siswa</title>

    <style>

        body{
            background-color: rgb(142, 177, 138);
            margin: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .wrap-datsis{
            background-color: white;
            padding: 50px 80px;
            border-radius: 20px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
        }

        .wrap-datsis h1, h2{
            color: rgb(48, 68, 46);
            text-shadow: 2px 2px 5px rgba(0,0,0,0.1);
        }

        .btn-laporan{
            text-decoration: none;
            background-color: rgb(48, 68, 46);
            color: white;
            padding: 6px 10px; 
            border-radius: 5px;
        }

        .btn-ganpass{
            text-decoration: none;
            background-color: rgb(160, 140, 50);
            color: white;
            padding: 6px 10px; 
            border-radius: 5px;
        }

        .out{
            text-decoration: none;
            background-color: rgb(120, 50, 50);
            color: white;
            padding: 6px 10px; 
            border-radius: 5px;
        }

        .btn-detail{
            text-decoration: none;
            background-color: rgb(70, 75, 70);
            color: white;
            padding: 6px 10px; 
            border-radius: 5px;
        }

        /* ===== STATUS BADGE ===== */
        .status{
            padding: 6px 14px;
            border-radius: 5px;
            font-size: 13px;
            font-weight: 500;
            display: inline-block;
        }

        .status-menunggu{
            background-color: rgb(235, 238, 235);
            color: rgb(120, 125, 120);
        }

        .status-proses{
            background-color: rgba(50, 80, 120, 0.15);
            color: rgb(50, 80, 120);
        }

        .status-selesai{
            background-color: rgba(48, 68, 46, 0.15);
            color: rgb(48, 68, 46);
        }

    </style>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css">
</head>

<body>

<div class="wrap-datsis">
    <h1 style="font-size: 45px;">Data Pengaduan</h1>
    <hr>
    <h2>Selamat Datang, <?php echo $_SESSION['nama']; ?></h2>

    <div class="wrap-btn">
        <a class="btn-laporan" href="siswa.php">Buat Laporan</a> |
        <a class="btn-ganpass" href="ganti-password.php">Ganti Password</a> |
        <a class="out" href="logout.php">Logout</a> 
    </div>

    <br><br>

    <table id="datatable" border="1" cellpadding="10" width="100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Kategori</th>
                <th>Lokasi</th>
                <th>Keterangan</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            while($data = mysqli_fetch_assoc($query)){
            ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $data['ket_kategori']; ?></td>
                <td><?= $data['lokasi']; ?></td>
                <td><?= $data['keterangan']; ?></td>
                <td>
                    <?php 
                    $status = strtolower(trim($data['status']));

                    if($status == "menunggu"){
                        echo "<span class='status status-menunggu'>Menunggu</span>";
                    }
                    elseif($status == "proses"){
                        echo "<span class='status status-proses'>Proses</span>";
                    }
                    elseif($status == "selesai"){
                        echo "<span class='status status-selesai'>Selesai</span>";
                    }
                    else{
                        echo "<span class='status'>{$data['status']}</span>";
                    }
                    ?>
                </td>
                <td>
                    <a class="btn-detail" href="detail-laporan-siswa.php?id=<?= $data['id_pelaporan']; ?>">
                        Detail
                    </a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<!-- DataTables -->
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>

<script>
$(document).ready(function() {
    $('#datatable').DataTable({
        language: {
            search: "Cari:",
            lengthMenu: "Tampilkan _MENU_ data",
            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            paginate: {
                next: "Selanjutnya",
                previous: "Sebelumnya"
            }
        },
        pageLength: 5
    });
});
</script>

</body>
</html>
