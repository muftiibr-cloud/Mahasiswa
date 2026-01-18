<?php
// hapus.php
include("koneksimh.php");

if (!isset($_GET['nim'])) {
    header("Location: indexmh.php");
    exit();
}

$nim = $_GET['nim'];

// Hapus data
$delete_sql = "DELETE FROM mahasiswa WHERE nim = '$nim'";

if ($koneksimh->query($delete_sql)) {
    header("Location: indexmh.php?success=Data berhasil dihapus!");
} else {
    header("Location: indexmh.php?error=Gagal menghapus data!");
}

exit();
?>