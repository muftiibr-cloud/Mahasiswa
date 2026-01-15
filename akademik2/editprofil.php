<?php
include('../koneksi.php');
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM users WHERE id = $user_id";
$result = mysqli_query($koneksi, $query);
$user = mysqli_fetch_assoc($result);

if (isset($_POST['update'])) {
    $nama_lengkap = mysqli_real_escape_string($koneksi, $_POST['nama_lengkap']);
    $email = mysqli_real_escape_string($koneksi, $_POST['email']);
    $tanggal_lahir = mysqli_real_escape_string($koneksi, $_POST['tanggal_lahir']);
    $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);

    $foto_profil = $user['foto_profil'];
    if ($_FILES['foto_profil']['name']) {
        $target_dir = "uploads/";
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        $file_name = time() . '_' . basename($_FILES['foto_profil']['name']);
        $target_file = $target_dir . $file_name;
        
        if (move_uploaded_file($_FILES['foto_profil']['tmp_name'], $target_file)) {
            $foto_profil = $target_file;
        }
    }

    $update_query = "UPDATE users SET 
                    nama_lengkap = '$nama_lengkap',
                    email = '$email',
                    tanggal_lahir = '$tanggal_lahir',
                    alamat = '$alamat',
                    foto_profil = '$foto_profil'
                    WHERE id = $user_id";

    if (mysqli_query($koneksi, $update_query)) {
        $_SESSION['nama_lengkap'] = $nama_lengkap;
        $_SESSION['email'] = $email;
        
        $success = "Profil berhasil diperbarui!";
        $result = mysqli_query($koneksi, $query);
        $user = mysqli_fetch_assoc($result);
    } else {
        $error = "Gagal memperbarui profil: " . mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-info text-white">
                        <h3 class="text-center">Edit Profil</h3>
                    </div>
                    <div class="card-body">
                        <?php if (isset($error)): ?>
                            <div class="alert alert-danger"><?php echo $error; ?></div>
                        <?php endif; ?>
                        <?php if (isset($success)): ?>
                            <div class="alert alert-success"><?php echo $success; ?></div>
                        <?php endif; ?>

                        <div class="text-center mb-4">
                            <?php if ($user['foto_profil']): ?>
                                <img src="<?php echo $user['foto_profil']; ?>" 
                                     class="rounded-circle" 
                                     width="150" 
                                     height="150" 
                                     style="object-fit: cover;">
                            <?php else: ?>
                                <div class="rounded-circle bg-secondary d-inline-flex align-items-center justify-content-center" 
                                     style="width: 150px; height: 150px;">
                                    <span class="text-white fs-1"><?php echo strtoupper(substr($user['username'], 0, 1)); ?></span>
                                </div>
                            <?php endif; ?>
                        </div>

                        <form method="POST" action="" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" 
                                       value="<?php echo htmlspecialchars($user['username']); ?>" disabled>
                                <small class="text-muted">Username tidak dapat diubah</small>
                            </div>
                            <div class="mb-3">
                                <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" id="nama_lengkap" 
                                       name="nama_lengkap" 
                                       value="<?php echo htmlspecialchars($user['nama_lengkap']); ?>" 
                                       required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" 
                                       name="email" 
                                       value="<?php echo htmlspecialchars($user['email']); ?>" 
                                       required>
                            </div>
                            <div class="mb-3">
                                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                <input type="date" class="form-control" id="tanggal_lahir" 
                                       name="tanggal_lahir" 
                                       value="<?php echo $user['tanggal_lahir']; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <textarea class="form-control" id="alamat" 
                                          name="alamat" 
                                          rows="3"><?php echo htmlspecialchars($user['alamat']); ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="foto_profil" class="form-label">Foto Profil</label>
                                <input type="file" class="form-control" id="foto_profil" name="foto_profil" accept="image/*">
                                <small class="text-muted">Kosongkan jika tidak ingin mengubah foto</small>
                            </div>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="../mahasiswa/list.php" class="btn btn-secondary me-md-2">Kembali</a>
                                <button type="submit" name="update" class="btn btn-primary">Perbarui Profil</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>


/sederhana 
<?php
include('../koneksi.php');
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM users WHERE id = $user_id";
$result = mysqli_query($koneksi, $query);
$user = mysqli_fetch_assoc($result);

if (isset($_POST['update'])) {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    
    $update = "UPDATE users SET nama='$nama', alamat='$alamat' WHERE id=$user_id";
    
    if (mysqli_query($koneksi, $update)) {
        $_SESSION['nama'] = $nama;
        echo "Profil berhasil diupdate! <a href='list.php'>Kembali</a>";
    } else {
        echo "Gagal update";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Profile</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        form { max-width: 400px; margin: 0 auto; }
        input, button { width: 100%; padding: 8px; margin: 5px 0; }
    </style>
</head>
<body>
    <h2>Edit Profile</h2>
    <p>Username: <?php echo $user['username']; ?></p>
    <form method="POST">
        <input type="text" name="nama" value="<?php echo $user['nama']; ?>" required>
        <input type="text" name="alamat" value="<?php echo $user['alamat']; ?>" placeholder="Alamat">
        <button type="submit" name="update">Update</button>
    </form>
    <p><a href="list.php">Kembali ke List</a> | <a href="logout.php">Logout</a></p>
</body>
</html>