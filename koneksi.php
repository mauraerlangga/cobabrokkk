<?php
//untuk menyambungkan codingan ke database
$koneksi = mysqli_connect("localhost", "root", "", "ujikom_2026_ratum");
if (!$koneksi)
    {
        die("Koneksi Gagal!");
    }
?>