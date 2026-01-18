<?php
include("koneksimh.php");


if(!isset($_GET['nim']) || empty($_GET['nim'])) {
    die("Parameter nim tidak valid!");
}

$nim = $_GET['nim'];
$edit = mysqli_query($koneksimh, "SELECT * FROM mahasiswa WHERE nim = '$nim'");
$data = mysqli_fetch_array($edit);

if(!$data) {
    die("Data tidak ditemukan!");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Data Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>Edit Data Mahasiswa</h2>
    <form method="POST" action="">
        <div class="mb-3">
            <label class="form-label">NIM</label>
            <input type="text" name="nim" class="form-control" value="<?php echo htmlspecialchars($data['nim']); ?>" readonly>
        </div>
        <div class="mb-3">
            <label class="form-label">Nama Mahasiswa</label>
            <input type="text" name="nama_mhs" class="form-control" value="<?php echo htmlspecialchars($data['nama_mhs']); ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Tanggal Lahir</label>
            <input type="date" name="tgl_lahir" class="form-control" value="<?php echo $data['tgl_lahir']; ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Alamat</label>
            <textarea class="form-control" name="alamat" rows="3"><?php echo htmlspecialchars($data['alamat']); ?></textarea>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Update</button>
        <button type="reset" class="btn btn-secondary">Reset</button>
        <a href="indexmh.php" class="btn btn-outline-primary">Data Mahasiswa</a>
    </form>
</div>

<?php
if (isset($_POST['submit'])) {
    $new_nim = $_POST['nim']; 
    $nama_mhs = $_POST['nama_mhs'];
    $tgl_lahir = $_POST['tgl_lahir'];
    $alamat = $_POST['alamat'];
    
    $update = mysqli_query($koneksimh, "UPDATE mahasiswa SET 
                nama_mhs = '$nama_mhs', 
                tgl_lahir = '$tgl_lahir', 
                alamat = '$alamat' 
                WHERE nim = '$nim'");
    
    if ($update) {
        header("Location: indexmh.php");
        exit;
    } else {
        echo "<div class='container mt-3 alert alert-danger'>Maaf, data gagal diubah: " . mysqli_error($koneksimh) . "</div>";
    }
}
?>
</body>
</html>