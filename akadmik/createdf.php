<?php
// createdf.php
include('koneksidf.php');

// Ambil data prodi untuk dropdown
$prodi_query = "SELECT id, nama_prodi, jenjang FROM prodi ORDER BY nama_prodi";
$prodi_result = $koneksidf->query($prodi_query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h3>Tambah Data Mahasiswa</h3>
        
        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-danger">
                <?php echo htmlspecialchars($_GET['error']); ?>
            </div>
        <?php endif; ?>
        
        <form method="POST" action="gbprosesmhdf.php">
            <div class="mb-3">
                <label for="nim" class="form-label">NIM</label>
                <input type="text" name="nim" class="form-control" id="nim" maxlength="10" required>
            </div>
            
            <div class="mb-3">
                <label for="nama_mhs" class="form-label">Nama Mahasiswa</label>
                <input type="text" name="nama_mhs" class="form-control" id="nama_mhs" maxlength="50" required>
            </div>
            
            <div class="mb-3">
                <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                <input type="date" name="tgl_lahir" class="form-control" id="tgl_lahir" required>
            </div>
            
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea class="form-control" name="alamat" id="alamat" rows="3" required></textarea>
            </div>
            
            <div class="mb-3">
                <label for="prodi_id" class="form-label">Program Studi</label>
                <select name="prodi_id" class="form-control" id="prodi_id" required>
                    <option value="">Pilih Program Studi</option>
                    <?php if ($prodi_result && $prodi_result->num_rows > 0): ?>
                        <?php while($prodi = $prodi_result->fetch_assoc()): ?>
                            <option value="<?php echo $prodi['id']; ?>">
                                <?php echo htmlspecialchars($prodi['nama_prodi']); ?> (<?php echo $prodi['jenjang']; ?>)
                            </option>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <option value="" disabled>Data prodi tidak tersedia</option>
                    <?php endif; ?>
                </select>
            </div>
            
            <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
            <button type="reset" class="btn btn-secondary">Reset</button>
            <a href="indexdf.php" class="btn btn-warning">Kembali</a>
        </form>
    </div>
</body>
</html>