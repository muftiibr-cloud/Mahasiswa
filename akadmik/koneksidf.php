<?php
// koneksidf.php
$host = "localhost";
$user = "root";
$password = "";
$nama_database = "db_akademik";

$koneksidf = new mysqli($host, $user, $password, $nama_database);

if ($koneksidf->connect_error) {
    die("Koneksi database gagal: " . $koneksidf->connect_error);
}
?>