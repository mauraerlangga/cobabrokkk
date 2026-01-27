<?php
    include "koneksi.php"; //ambil koneksi

    $query = mysqli_query($koneksi, "SELECT * FROM `input_aspirasi`");
?>

<table border="1">
    <tr>
        <td>Lokasi</td>
        <td>Keterangan</td>
        <td>Status</td>
        <td>Feedback</td>
        <td>Aksi</td>
    </tr>
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