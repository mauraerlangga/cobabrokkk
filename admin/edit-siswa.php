<?php
include '../koneksi.php';

// Ambil ID dari URL
 $id = $_GET['id'];

// Ambil data siswa berdasarkan ID
 $query_edit = mysqli_query($koneksi, "SELECT * FROM user WHERE id = '$id'");
 $data = mysqli_fetch_assoc($query_edit);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Siswa</title>
    <style>
        body { font-family: sans-serif; padding: 20px; }
        label { display: block; margin-bottom: 5px; }
        input[type="text"], select { padding: 5px; width: 300px; margin-bottom: 10px; }
        .btn { padding: 8px 15px; border: none; cursor: pointer; border-radius: 4px; text-decoration: none; color: white; }
        .btn-save { background-color: #007bff; }
        .btn-back { background-color: #6c757d; }
    </style>
</head>
<body>
    <h2>Edit Data Siswa</h2>

    <form action="proses-edit-siswa.php" method="POST">
        <!-- Hidden ID -->
        <input type="hidden" name="id" value="<?= $data['id']; ?>">

        <label>Username</label>
        <input type="text" name="username" value="<?= $data['username']; ?>" required><br><br>

        <label for="nama">Nama</label>
        <input type="text" name="nama" value="<?= $data['nama']; ?>" required><br><br>

        <label for="kelas">Kelas</label>
        <select name="kelas">
            <option value="X-RPL" <?php if($data['kelas'] == 'X-RPL') echo 'selected'; ?>>X-RPL</option>
            <option value="XI-RPL" <?php if($data['kelas'] == 'XI-RPL') echo 'selected'; ?>>XI-RPL</option>
            <option value="XII-RPL" <?php if($data['kelas'] == 'XII-RPL') echo 'selected'; ?>>XII-RPL</option>
            <option value="X-TKJ" <?php if($data['kelas'] == 'X-TKJ') echo 'selected'; ?>>X-TKJ</option>
            <option value="XI-TKJ" <?php if($data['kelas'] == 'XI-TKJ') echo 'selected'; ?>>XI-TKJ</option>
            <option value="XII-TKJ" <?php if($data['kelas'] == 'XII-TKJ') echo 'selected'; ?>>XII-TKJ</option>
        </select><br><br>

        <label for="password">Password</label>
        <input type="text" name="password" value="<?= $data['password']; ?>" required><br><br>

        <button type="submit" name="update" class="btn btn-save">Simpan Perubahan</button>
        <a href="data-siswa.php" class="btn btn-back">Batal</a>
    </form>

</body>
</html>