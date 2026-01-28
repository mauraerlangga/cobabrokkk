
<?php
    include "koneksi.php"; //ambil koneksi
    session_start();
        $nis = $_SESSION['nis'];
    $query = mysqli_query($koneksi, "SELECT * FROM `input_aspirasi` WHERE nis= '$nis'");
?>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
 <!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css">
 <!-- DataTables JS -->
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
             }
         });
     });
</script>

<table id="datatable" border="1">
     <thead>
        <tr>
            <th>Lokasi</th>
            <th>Keterangan</th>
            <th>Status</th>
            <th>Feedback</th>
            <th>Aksi</th>
        </tr>
     </thead>
<?php
while($data = mysqli_fetch_assoc($query)){ ?>
<tr>
    <td><?= $data["lokasi"]; ?></td>
    <td><?= $data["keterangan"]; ?></td>
    <td><?= $data["status"]; ?></td>
    <td><?= $data["feedback"]; ?></td>
    <td><a href="detail-pengaduan.php?id=<?=$data['id_pelaporan']; ?>">Detail</a></td>
</tr>

<?php } ?>
</table>