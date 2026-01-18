<?php
// editdf.php
include("koneksidf.php");

if (!isset($_GET['nim'])) {
    header("Location: indexdf.php");
    exit();
}

$nim = $_GET['nim'];

// Ambil data mahasiswa
$query = "SELECT m.*, p.nama_prodi FROM mahasiswa m 
          LEFT JOIN prodi p ON m.prodi_id = p.id 
          WHERE m.nim = '$nim'";
$result = $koneksidf->query($query);

if ($result->num_rows == 0) {
    header("Location: indexdf.php");
    exit();
}

$mahasiswa = $result->fetch_assoc();

// Ambil data prodi
$prodi_query = "SELECT id, nama_prodi, jenjang FROM prodi ORDER BY nama_prodi";
$prodi_result = $koneksidf->query($prodi_query);

// Proses update
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_mhs = $_POST['nama_mhs'];
    $tgl_lahir = $_POST['tgl_lahir'];
    $alamat = $_POST['alamat'];
    $prodi_id = $_POST['prodi_id'];
    
    $update_sql = "UPDATE mahasiswa SET 
                  nama_mhs = '$nama_mhs', 
                  tgl_lahir = '$tgl_lahir', 
                  alamat = '$alamat', 
                  prodi_id = '$prodi_id'
                  WHERE nim = '$nim'";
    
    if ($koneksidf->query($update_sql)) {
        header("Location: indexdf.php?success=Data berhasil diperbarui!");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h3>Edit Data Mahasiswa</h3>
        
        <form method="POST" action="">
            <div class="mb-3">
                <label for="nim" class="form-label">NIM</label>
                <input type="text" class="form-control" value="<?php echo $mahasiswa['nim']; ?>" readonly>
            </div>
            
            <div class="mb-3">
                <label for="nama_mhs" class="form-label">Nama Mahasiswa</label>
                <input type="text" name="nama_mhs" class="form-control" value="<?php echo $mahasiswa['nama_mhs']; ?>" required>
            </div>
            
            <div class="mb-3">
                <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                <input type="date" name="tgl_lahir" class="form-control" value="<?php echo $mahasiswa['tgl_lahir']; ?>" required>
            </div>
            
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea class="form-control" name="alamat" rows="3" required><?php echo $mahasiswa['alamat']; ?></textarea>
            </div>
            
            <div class="mb-3">
                <label for="prodi_id" class="form-label">Program Studi</label>
                <select name="prodi_id" class="form-control" required>
                    <option value="">Pilih Program Studi</option>
                    <?php if ($prodi_result && $prodi_result->num_rows > 0): ?>
                        <?php while($prodi = $prodi_result->fetch_assoc()): ?>
                            <option value="<?php echo $prodi['id']; ?>"
                                <?php echo ($mahasiswa['prodi_id'] == $prodi['id']) ? 'selected' : ''; ?>>
                                <?php echo $prodi['nama_prodi']; ?> (<?php echo $prodi['jenjang']; ?>)
                            </option>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </select>
            </div>
            
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="indexdf.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</body>
</html>