<?php
    include "../koneksi.php"; //ambil koneksi

    $query = mysqli_query($koneksi, "SELECT * FROM `input_aspirasi`");
?>

<table border="1">
    <tr>
        <td>Lokasi</td>
        <td>Keterangan</td>
        <td>Status</td>
        <td>Feedback</td>
    </tr>
<?php
while($data = mysqli_fetch_assoc($query)){ ?>
<tr>
    <td><?= $data["lokasi"]; ?></td>
    <td><?= $data["keterangan"]; ?></td>
    <td><?= $data["status"]; ?></td>
    <td><?= $data["feedback"]; ?></td>
</tr>

<?php } ?>
</table>