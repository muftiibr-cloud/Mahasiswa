<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
include('koneksimh.php');

// Ambil data prodi dari database
$prodi_query = "SELECT id, nama_prodi FROM prodi ORDER BY nama_prodi";
$prodi_result = $koneksimh->query($prodi_query);

// Data program studi yang diinginkan
$desired_prodi = [
    'Teknologi Rekayasa Perangkat Lunak',
    'Animasi', 
    'Teknik Komputer',
    'Manajemen Informatika'
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Tambah Data Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Sistem Akademik</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="indexmh.php">Data Mahasiswa</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="createmh.php">Tambah Data</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="editprofil.php">Edit Profil</a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <span class="nav-link">Halo, <?php echo $_SESSION['username']; ?></span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-danger btn-sm text-white" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h3 class="mb-4">Tambah Data Mahasiswa</h3>
        <div class="card">
            <div class="card-body">
                <form method="POST" action="gbprosesmh.php">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nim" class="form-label">NIM</label>
                            <input type="text" name="nim" class="form-control" id="nim" required maxlength="10" 
                                   placeholder="Masukkan NIM">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="nama_mhs" class="form-label">Nama Mahasiswa</label>
                            <input type="text" name="nama_mhs" class="form-control" id="nama_mhs" required maxlength="50"
                                   placeholder="Masukkan nama lengkap">
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" name="tgl_lahir" class="form-control" id="tgl_lahir" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="prodi_id" class="form-label">Program Studi</label>
                            <select name="prodi_id" class="form-control" id="prodi_id" required>
                                <option value="">Pilih Program Studi</option>
                                <?php 
                                // Tampilkan prodi dari database
                                if($prodi_result && $prodi_result->num_rows > 0):
                                    while($prodi = $prodi_result->fetch_assoc()):
                                ?>
                                    <option value="<?php echo $prodi['id']; ?>">
                                        <?php echo htmlspecialchars($prodi['nama_prodi']); ?>
                                    </option>
                                <?php 
                                    endwhile;
                                else:
                                    // Jika tabel prodi kosong, tampilkan pesan
                                ?>
                                    <option value="" disabled>Data prodi tidak tersedia</option>
                                <?php endif; ?>
                            </select>
                            <?php if($prodi_result->num_rows == 0): ?>
                                <small class="text-danger">
                                    <i class="bi bi-exclamation-triangle"></i> 
                                    Silakan tambah data prodi terlebih dahulu di database
                                </small>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea class="form-control" name="alamat" id="alamat" rows="3" required 
                                  placeholder="Masukkan alamat lengkap"></textarea>
                    </div>
                    
                    <div class="d-flex gap-2">
                        <button type="submit" name="submit" class="btn btn-primary">
                            <i class="bi bi-save"></i> Simpan
                        </button>
                        <button type="reset" class="btn btn-secondary">
                            <i class="bi bi-arrow-clockwise"></i> Reset
                        </button>
                        <a href="indexmh.php" class="btn btn-warning">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>