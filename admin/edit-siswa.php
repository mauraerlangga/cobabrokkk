

<?php
session_start();
// Cek keamanan agar hanya admin yang bisa akses
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    echo "Akses Ditolak. <a href='../index.php'>Login</a>";
    exit;
}

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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Siswa</title>
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
            max-width: 600px; /* Lebar pas untuk form */
            margin: 0 auto;
            padding: 40px;
            background-color: #ffffff;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        /* 3. Tipografi */
        h1 {
            color: #4F6356; /* Sage Dark */
            margin-top: 0;
            border-bottom: 2px solid #E8F0EB;
            padding-bottom: 15px;
            margin-bottom: 25px;
        }

        /* 4. Link Kembali */
        .back-link {
            display: inline-block;
            margin-bottom: 20px;
            text-decoration: none;
            color: #4F6356;
            font-weight: 600;
            font-size: 14px;
        }
        .back-link:hover { text-decoration: underline; }

        /* 5. Form Styling */
        .form-group { 
            margin-bottom: 20px; 
        }

        label { 
            display: block; 
            margin-bottom: 8px; 
            font-weight: bold; 
            color: #4F6356; /* Sage untuk label */
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Style untuk Input Text dan Select Dropdown */
        input[type="text"], 
        select { 
            width: 100%; 
            padding: 12px; 
            box-sizing: border-box;
            border: 1px solid #D1D9D6; /* Border lembut */
            border-radius: 8px; 
            font-family: inherit;
            font-size: 14px;
            background-color: #FAFAFA;
            transition: border-color 0.3s, box-shadow 0.3s;
            appearance: none; 
            -webkit-appearance: none;
            background-image: url("data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%22292.4%22%20height%3D%22292.4%22%3E%3Cpath%20fill%3D%22%234F6356%22%20d%3D%22M287%2069.4a17.6%2017.6%200%200%200-13-5.4H18.4c-5%200-9.3%201.8-12.9%205.4A17.6%2017.6%200%200%200%200%2082.2c0%205%201.8%209.3%205.4%2012.9l128%20127.9c3.6%203.6%207.8%205.4%2012.8%205.4s9.2-1.8%2012.8-5.4L287%2095c3.5-3.5%205.4-7.8%205.4-12.8%200-5-1.9-9.2-5.5-12.8z%22%2F%3E%3C%2Fsvg%3E");
            background-repeat: no-repeat;
            background-position: right 12px top 50%;
            background-size: 12px auto;
        }

        input[type="text"]:focus, 
        select:focus {
            outline: none;
            border-color: #78887C; /* Sage Medium saat diklik */
            background-color: #ffffff;
            box-shadow: 0 0 0 3px rgba(120, 136, 124, 0.1);
        }

        /* 6. Group Tombol */
        .btn-group {
            display: flex;
            gap: 10px;
            margin-top: 10px;
        }

        button, a.btn {
            padding: 12px 20px;
            text-align: center;
            border: none; 
            border-radius: 8px; 
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            flex: 1; /* Tombol sama lebar */
            transition: opacity 0.3s;
        }

        button:hover, a.btn:hover { opacity: 0.9; }

        /* Tombol Utama (Simpan) */
        button[type="submit"] { 
            background-color: #4F6356; /* Sage Dark */
            color: white;
        }

        /* Tombol Kedua (Batal) */
        .btn-cancel {
            background-color: #8C8C8C; /* Abu-abu */
            color: white;
        }
    </style>
</head>
<body>

    <div class="container">
        <!-- Link Kembali -->
        <a href="data-siswa.php" class="back-link">&larr; Kembali ke Data Siswa</a>

        <h1>Edit Data Siswa</h1>
        
        <form action="proses-edit-siswa.php" method="POST">
            <!-- Hidden ID -->
            <input type="hidden" name="id" value="<?= $data['id']; ?>">

            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" value="<?= $data['username']; ?>" required>
            </div>

            <div class="form-group">
                <label for="nama">Nama Lengkap</label>
                <input type="text" id="nama" name="nama" value="<?= $data['nama']; ?>" required>
            </div>

            <div class="form-group">
                <label for="kelas">Kelas</label>
                <!-- Logic selected tetap dipertahankan -->
                <select name="kelas" id="kelas" required>
                    <option value="X-RPL" <?php if($data['kelas'] == 'X-RPL') echo 'selected'; ?>>X-RPL</option>
                    <option value="XI-RPL" <?php if($data['kelas'] == 'XI-RPL') echo 'selected'; ?>>XI-RPL</option>
                    <option value="XII-RPL" <?php if($data['kelas'] == 'XII-RPL') echo 'selected'; ?>>XII-RPL</option>
                    <option value="X-TKJ" <?php if($data['kelas'] == 'X-TKJ') echo 'selected'; ?>>X-TKJ</option>
                    <option value="XI-TKJ" <?php if($data['kelas'] == 'XI-TKJ') echo 'selected'; ?>>XI-TKJ</option>
                    <option value="XII-TKJ" <?php if($data['kelas'] == 'XII-TKJ') echo 'selected'; ?>>XII-TKJ</option>
                </select>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <!-- Password ditampilkan sebagai text sesuai sistem asli -->
                <input type="text" id="password" name="password" value="<?= $data['password']; ?>" required>
            </div>

            <div class="btn-group">
                <!-- Tombol Simpan -->
                <button type="submit" name="update">Simpan Perubahan</button>
                
                <!-- Tombol Batal -->
                <a href="data-siswa.php" class="btn btn-cancel">Batal</a>
            </div>

        </form>
    </div>

</body>
</html>
```