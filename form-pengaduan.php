<!DOCTYPE html>
<html lang="en">
<head>

    <title>Form Pengaduan</title>
</head>
<body>
    <div>
        <h1>Form Pengaduan Masyarakat</h1>
        <form action="proses-pengaduan.php" method="POST">
            <div>
                <label for="">NIS</label>
                <input type="text" name="nis" required>
            </div>
            <div>
                <label for="">Kelas</label>
                <input type="text" name="kelas" required>
            </div>
            <div>
                <label>Kategori</label>
                <select name="kategori" required>
                <option value="1">Sarana Kelas</option>
                </select><br><br>
            </div>
            <div>
                <label for="">Keterangan Laporan</label><br>
                <textarea name="keterangan" rows="5" required></textarea>
                </select><br><br>
            </div>
            <div>
                <label for="">Lokasi</label>
                <input type="text" name="lokasi">
                </select><br><br>
            </div>
        <input type="submit" value="Kirim Pengaduan" href="proses-pengaduan.php">
    </form></div>
    
</body>
</html>