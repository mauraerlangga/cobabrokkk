<?php
session_start();
include 'koneksi.php';

if(isset($_POST['username']) && isset($_POST['password'])){

    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = mysqli_query($koneksi, 
        "SELECT * FROM user 
         WHERE username='$username' 
         AND password='$password'"
    );

    $data = mysqli_fetch_assoc($query);

    if($data){

        // Simpan session
        $_SESSION['id']       = $data['id'];
        $_SESSION['username'] = $data['username'];
        $_SESSION['nama']     = $data['nama'];
        $_SESSION['role']     = $data['role'];

        // Redirect sesuai role
        if($data['role'] == 'admin'){
            header("Location: admin/admin.php");
            exit;
        }

        if($data['role'] == 'siswa'){
            header("Location: data-pengaduan-siswa.php");
            exit;
        }

    } else {
        echo "Login gagal! Username atau password salah.";
        echo "<br><a href='index.php'>Kembali</a>";
    }

} else {
    header("Location: index.php");
    exit;
}
?>
