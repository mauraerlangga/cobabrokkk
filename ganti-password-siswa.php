<?php
session_start();
include 'koneksi.php';

// Cek apakah user sudah login dan role-nya siswa
if (!isset($_SESSION['id']) || $_SESSION['role'] != 'siswa') {
    echo "Akses Ditolak. <a href='index.php'>Login</a>";
    exit;
}

 $id_user = $_SESSION['id'];

// LOGIKA UBAH PASSWORD
if (isset($_POST['ubah_password'])) {
    $password_baru = $_POST['password_baru'];
    $password_konfirm = $_POST['password_konfirm'];

    // Cek apakah password baru diisi
    if (!empty($password_baru)) {
        // Cek apakah password baru sama dengan konfirmasi
        if ($password_baru === $password_konfirm) {
            // Query Update Password
            $query_update = mysqli_query($koneksi, "UPDATE user SET password = '$password_baru' WHERE id = '$id_user'");
            
            if ($query_update) {
                // Jika berhasil, alert dan kembali ke halaman siswa
                echo "<script>alert('Password berhasil diubah!'); window.location='siswa.php';</script>";
            } else {
                // Jika gagal query
                echo "<script>alert('Gagal mengubah password: " . mysqli_error($koneksi) . "');</script>";
            }
        } else {
            // Jika konfirmasi tidak cocok
            echo "<script>alert('Konfirmasi password tidak cocok!');</script>";
        }
    } else {
        echo "<script>alert('Password baru tidak boleh kosong!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ganti Password</title>
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

        input[type="password"] { 
            width: 100%; 
            padding: 12px; 
            box-sizing: border-box;
            border: 1px solid #D1D9D6; /* Border lembut */
            border-radius: 8px; 
            font-family: inherit;
            font-size: 14px;
            transition: border-color 0.3s;
        }

        input[type="password"]:focus {
            outline: none;
            border-color: #78887C; /* Sage Medium saat diklik */
            box-shadow: 0 0 0 3px rgba(120, 136, 124, 0.1);
        }

        /* 6. Tombol */
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
        <a href="siswa.php" class="back-link">&larr; Kembali ke Dashboard</a>

        <h1>Ganti Password</h1>
        
        <form action="" method="POST">
            <div class="form-group">
                <label for="password_baru">Password Baru</label>
                <input type="password" id="password_baru" name="password_baru" placeholder="Masukkan password baru..." required>
            </div>

            <div class="form-group">
                <label for="password_konfirm">Konfirmasi Password</label>
                <input type="password" id="password_konfirm" name="password_konfirm" placeholder="Ulangi password baru..." required>
            </div>

            <div class="btn-group">
                <!-- Tombol Simpan -->
                <button type="submit" name="ubah_password">Simpan Perubahan</button>
                
            </div>
        </form>
    </div>

</body>
</html>