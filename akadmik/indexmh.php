<?php
// index.php
include("koneksimh.php");

// Query data mahasiswa
$query = "SELECT m.*, p.nama_prodi, p.jenjang 
          FROM mahasiswa m 
          LEFT JOIN prodi p ON m.prodi_id = p.id 
          ORDER BY m.nim ASC";

$result = $koneksimh->query($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2 class="text-center mb-4">Data Mahasiswa</h2>
        
        <?php if (isset($_GET['success'])): ?>
            <div class="alert alert-success">
                <?php echo htmlspecialchars($_GET['success']); ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-danger">
                <?php echo htmlspecialchars($_GET['error']); ?>
            </div>
        <?php endif; ?>

        <div class="text-end mb-3">
            <a href="createmh.php" class="btn btn-primary">Tambah Data</a>
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Tanggal Lahir</th>
                    <th>Alamat</th>
                    <th>Program Studi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php $no = 1; while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo htmlspecialchars($row['nim']); ?></td>
                            <td><?php echo htmlspecialchars($row['nama_mhs']); ?></td>
                            <td><?php echo date('d-m-Y', strtotime($row['tgl_lahir'])); ?></td>
                            <td><?php echo htmlspecialchars($row['alamat']); ?></td>
                            <td>
                                <?php echo htmlspecialchars($row['nama_prodi']); ?>
                                <?php if($row['jenjang']): ?>
                                    (<?php echo $row['jenjang']; ?>)
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="edit.php?nim=<?php echo $row['nim']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="hapus.php?nim=<?php echo $row['nim']; ?>" class="btn btn-danger btn-sm" 
                                   onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center">Tidak ada data mahasiswa</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>