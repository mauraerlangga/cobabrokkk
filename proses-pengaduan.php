<?php

echo "Proses Pengaduan";

//dia akan mengambil data dengan method post dari form-pengaduan.php
echo $nis = $_POST['nis'];
echo $kelas = $_POST['kelas'];
echo $kategori = $_POST['kategori'];
echo $keterangan = $_POST['keterangan'];
echo $lokasi = $_POST['lokasi'];

$koneksi = mysqli_connect("localhost", "root", "", "ujikom_maura");

mysqli_query($koneksi, "INSERT INTO `input_aspirasi`( `nis`,`lokasi`, `keterangan`,`id_kategori`) VALUES ('$nis','$lokasi','$keterangan','$kategori')");