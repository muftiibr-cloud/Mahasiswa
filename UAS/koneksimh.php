<?php
$host = "localhost";
$user = "root";
$password = "";
$nama_database = "db_akademik";
$koneksimh = new mysqli($host, $user, $password, $nama_database);

// Cek koneksi
if ($koneksimh->connect_error) {
    die("Koneksi database gagal: " . $koneksimh->connect_error);
}

// Set charset
$koneksimh->set_charset("utf8mb4");
?>