<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include("koneksimh.php");

// Query untuk mengambil data mahasiswa dengan nama prodi
$query = "SELECT m.*, p.nama_prodi, p.jenjang 
          FROM mahasiswa m 
          LEFT JOIN prodi p ON m.prodi_id = p.id 
          ORDER BY m.nim ASC";
$result = $koneksimh->query($query);
$no = 1;
?>   
<!DOCTYPE html>
<html>
<head>
    <title>Data Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .table th {
            background-color: #0d6efd;
            color: white;
            vertical-align: middle;
        }
        .badge-jenjang {
            font-size: 0.7em;
            padding: 3px 8px;
        }
    </style>
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
                        <a class="nav-link active" href="indexmh.php">
                            <i class="bi bi-list-ul"></i> Data Mahasiswa
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="createmh.php">
                            <i class="bi bi-person-plus"></i> Tambah Data
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="editprofil.php">
                            <i class="bi bi-person-gear"></i> Edit Profil
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <span class="nav-link">
                            <i class="bi bi-person-circle"></i> <?php echo $_SESSION['username']; ?>
                        </span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-danger btn-sm text-white" href="logout.php">
                            <i class="bi bi-box-arrow-right"></i> Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2><i class="bi bi-people"></i> Data Mahasiswa</h2>
            <a href="createmh.php" class="btn btn-success">
                <i class="bi bi-plus-circle"></i> Tambah Data
            </a>
        </div>
        
        <?php if(isset($_GET['success'])): ?>
            <div class="alert alert-success alert-dismissible fade show">
                <i class="bi bi-check-circle"></i> <?php echo $_GET['success']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>
        
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIM</th>
                        <th>Nama Mahasiswa</th>
                        <th>Tanggal Lahir</th>
                        <th>Alamat</th>
                        <th>Program Studi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if($result && $result->num_rows > 0): ?>
                        <?php while($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><strong><?php echo htmlspecialchars($row['nim']); ?></strong></td>
                                <td><?php echo htmlspecialchars($row['nama_mhs']); ?></td>
                                <td><?php echo date('d-m-Y', strtotime($row['tgl_lahir'])); ?></td>
                                <td><?php echo htmlspecialchars($row['alamat']); ?></td>
                                <td>
                                    <?php if($row['nama_prodi']): ?>
                                        <?php echo htmlspecialchars($row['nama_prodi']); ?>
                                        <?php if($row['jenjang']): ?>
                                            <span class="badge bg-info badge-jenjang"><?php echo $row['jenjang']; ?></span>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <span class="text-muted">-</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="edit.php?nim=<?php echo $row['nim']; ?>" 
                                           class="btn btn-warning">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <a href="hapus.php?nim=<?php echo $row['nim']; ?>" 
                                           class="btn btn-danger" 
                                           onclick="return confirm('Yakin ingin menghapus data mahasiswa <?php echo addslashes($row['nama_mhs']); ?>?')">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center text-muted py-5">
                                <i class="bi bi-database-exclamation display-5"></i><br>
                                <h5 class="mt-3">Tidak ada data mahasiswa</h5>
                                <p>Silakan tambah data mahasiswa terlebih dahulu</p>
                                <a href="createmh.php" class="btn btn-primary mt-2">
                                    <i class="bi bi-plus-circle"></i> Tambah Data Mahasiswa
                                </a>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        
        <?php if($result && $result->num_rows > 0): ?>
        <div class="alert alert-info mt-3">
            <i class="bi bi-info-circle"></i> 
            Menampilkan <?php echo ($no-1); ?> data mahasiswa
        </div>
        <?php endif; ?>
    </div>
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>