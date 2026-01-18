<?php
include("koneksimh.php");
if(isset($_GET['nim']) && !empty($_GET['nim'])) {
    $nim = $_GET['nim'];
    $stmt = $koneksimh->prepare("DELETE FROM mahasiswa WHERE nim = ?");
    $stmt->bind_param("s", $nim);
    
    if($stmt->execute()) {
        header("Location: indexmh.php");
        exit();
    } else {
        echo "GAGAL menghapus data: " . $koneksimh->error;
    }
    $stmt->close();
} else {
    echo "Parameter nim tidak valid!";
    exit();
}
?>