<?php
// 1. Mulai session di baris paling pertama
session_start();

// Cek apakah user sudah login (apakah session id ada)
if (!isset($_SESSION['id'])) {
    die("Error: Anda belum login. Session tidak ditemukan.");
}

// 2. Include koneksi database
include 'koneksi.php';

echo "<h1>Proses Pengaduan</h1>";
echo "<hr>"; 

// 3. Ambil ID User dari Session (JANGAN ambil dari POST untuk keamanan)
 $id_user = $_SESSION['id'];

// 4. Mengambil data dari form
// Kita cek apakah data terkirim menggunakan isset() agar tidak muncul warning
 $kategori = isset($_POST['kategori']) ? $_POST['kategori'] : '';
 $keterangan = isset($_POST['keterangan']) ? $_POST['keterangan'] : '';
 $lokasi = isset($_POST['lokasi']) ? $_POST['lokasi'] : '';

// Menampilkan data (Debugging)
echo "Id User (Session): " . $id_user . "<br>"; 
echo "Kategori: " . $kategori . "<br>";
echo "Keterangan: " . $keterangan . "<br>";
echo "Lokasi: " . $lokasi . "<br>";

// Validasi input kategori
if (empty($kategori)) {
    die("<br><b>Error:</b> Kategori belum dipilih.");
}

// 5. Query simpan data
// Hapus baris mysqli_connect yang kedua karena sudah include koneksi.php di atas
// Pastikan urutan kolom sesuai: id_kategori, iduser, lokasi, keterangan
 $query = "INSERT INTO `input-aspirasi`(`id_kategori`, `iduser`, `lokasi`, `keterangan`) 
        VALUES ('$kategori', '$id_user', '$lokasi', '$keterangan')";

if(mysqli_query($koneksi, $query)){
    echo "<script>alert('Data berhasil disimpan!'); window.location.href='siswa.php';</script>";
} else {
    echo "<br><b>Gagal menyimpan data: </b>" . mysqli_error($koneksi);
}
?>