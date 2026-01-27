<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Tambah Data Siswa</h2>
    <form action="proses-tambah-siswa.php" method="POST">
        <label>NIS</label>
        <input type="text" id="nis" name="nis" required><br><br>

        <label for="nama">Nama</label>
        <input type="text" id="nama" name="nama" required><br><br>

        <label for="kelas">Kelas </label>
        <select name="kelas" id="">
            <option value="X-RPL">X-RPL</option>
            <option value="XI-RPL">XI-RPL</option>
            <option value="XII-RPL">XII-RPL</option>
            <option value="X-TKJ">X-TKJ</option>
            <option value="XI-TKJ">XI-TKJ</option>
            <option value="XII-TKJ">XII-TKJ</option>
        </select><br><br>

        <label for="kelas">Password</label>
        <input type="text" id="password" name="password" required><br><br>

        <button type="submit" name="simpan">Simpan Data Siswa</button>
</body>
</html>