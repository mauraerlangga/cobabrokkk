<?php
$koneksi = mysqli_connect("localhost", "root", "", "ujikom_maura");

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}