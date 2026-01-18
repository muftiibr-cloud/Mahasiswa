<?php
// koneksimh.php
$host = "localhost";
$user = "root";
$password = "";
$nama_database = "db_akademik";

$koneksimh = new mysqli($host, $user, $password, $nama_database);

if ($koneksimh->connect_error) {
    die("Koneksi database gagal: " . $koneksimh->connect_error);
}
?>