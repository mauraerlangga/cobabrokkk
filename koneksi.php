<?php
$koneksi = mysqli_connect("localhost", "root", "", "ujikom_maura");

mysqli_query($koneksi, "INSERT INTO kategori VALUES(NULL, 'Sarana Kelas')");