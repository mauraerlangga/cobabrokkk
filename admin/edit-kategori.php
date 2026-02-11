<?php
include '../koneksi.php';

// Ambil ID dari URL
 $id = $_GET['id'];

// Ambil data kategori berdasarkan ID untuk ditampilkan di form
 $query_edit = mysqli_query($koneksi, "SELECT * FROM kategori WHERE id_kategori = '$id'");
 $data = mysqli_fetch_assoc($query_edit);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kategori</title>
    <style>
        body { font-family: sans-serif; padding: 20px; }
        label { display: block; margin-bottom: 5px; }
        input[type="text"] { padding: 5px; width: 300px; margin-bottom: 10px; }
        .btn { padding: 8px 15px; border: none; cursor: pointer; border-radius: 4px; text-decoration: none; color: white; }
        .btn-save { background-color: #007bff; }
        .btn-back { background-color: #6c757d; }
    </style>
</head>
<body>
    <h2>Edit Kategori</h2>

    <!-- Form action menuju proses edit -->
    <form action="proses-edit-kategori.php" method="POST">
        
        <!-- Hidden input untuk mengirim ID agar sistem tahu data mana yang diubah -->
        <input type="hidden" name="id_kategori" value="<?= $data['id_kategori']; ?>">

        <label for="kategori">Nama Kategori</label>
        <!-- Value diisi otomatis dari database -->
        <input type="text" id="kategori" name="kategori" value="<?= $data['ket_kategori']; ?>" required>

        <button type="submit" name="update" class="btn btn-save">Simpan Perubahan</button>
        <a href="data-kategori.php" class="btn btn-back">Batal</a>
    </form>

</body>
</html>