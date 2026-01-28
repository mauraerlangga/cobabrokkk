<?php

echo "<h1>Proses Pengaduan</h1>";
echo "<hr>"; // Garis pemisah


session_start();
    $nis = $_SESSION['nis'];
$query = mysqli_query($koneksi, "SELECT * FROM `input_aspirasi` WHERE nis= '$nis'");

// Mengambil data dari form (lebih baik dipisah agar variabel siap digunakan)
 $nis = $_POST['nis']; 
 $kelas = $_POST['kelas'];
 $kategori = $_POST['kategori'];
 $keterangan = $_POST['keterangan'];
 $lokasi = $_POST['lokasi'];

// Menampilkan data dengan menambahkan "<br>" untuk ganti baris
// dan teks label agar jelas datanya apa
echo "NIS: " . $nis . "<br>"; 
echo "Kelas: " . $kelas . "<br>";
echo "Kategori: " . $kategori . "<br>";
echo "Keterangan: " . $keterangan . "<br>";
echo "Lokasi: " . $lokasi . "<br>";

// Koneksi ke database
 $koneksi = mysqli_connect("localhost", "root", "", "ujikom_maura");

// Query simpan data
// (Perhatikan: $kelas diambil tapi tidak dimasukkan ke query insert di bawah)
 $query = "INSERT INTO `input_aspirasi`( `nis`, `lokasi`, `keterangan`, `id_kategori`) 
          VALUES ('$nis','$lokasi','$keterangan','$kategori')";

if(mysqli_query($koneksi, $query)){
    echo "<br><b>Data berhasil disimpan!</b>";
} else {
    echo "<br><b>Gagal menyimpan data: </b>" . mysqli_error($koneksi);
}
?>