<?php
$koneksi = mysqli_connect("localhost", "root", "", "ujikom_2026_ratum");

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}