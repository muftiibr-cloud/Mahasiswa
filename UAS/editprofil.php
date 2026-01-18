<?php
include('koneksi.php');
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Ambil data user
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM pengguna WHERE id = '$user_id'";
$result = mysqli_query($koneksi, $query);
$user = mysqli_fetch_assoc($result);

$error = '';
$success = '';

if (isset($_POST['update'])) {
    $password = mysqli_real_escape_string($koneksi, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($koneksi, $_POST['confirm_password']);

    if (empty($password) || empty($confirm_password)) {
        $error = "Password dan konfirmasi password harus diisi!";
    } elseif ($password !== $confirm_password) {
        $error = "Password tidak cocok!";
    } elseif (strlen($password) < 6) {
        $error = "Password minimal 6 karakter!";
    } else {
        // Update password
        $update_query = "UPDATE pengguna SET password = '$password' WHERE id = '$user_id'";
        
        if (mysqli_query($koneksi, $update_query)) {
            $success = "Password berhasil diperbarui!";
        } else {
            $error = "Gagal memperbarui password: " . mysqli_error($koneksi);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-warning text-dark">
                        <h3 class="text-center">Edit Profil Pengguna</h3>
                    </div>
                    <div class="card-body">
                        <?php if (isset($error)): ?>
                            <div class="alert alert-danger"><?php echo $error; ?></div>
                        <?php endif; ?>
                        <?php if (isset($success)): ?>
                            <div class="alert alert-success"><?php echo $success; ?></div>
                        <?php endif; ?>
                        
                        <div class="mb-4">
                            <h5>Informasi Akun</h5>
                            <div class="mb-3">
                                <label class="form-label">Username</label>
                                <input type="text" class="form-control" 
                                       value="<?php echo htmlspecialchars($user['username']); ?>" 
                                       readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" 
                                       value="<?php echo htmlspecialchars($user['email']); ?>" 
                                       readonly>
                                <small class="text-muted">Email tidak dapat diubah</small>
                            </div>
                        </div>
                        
                        <hr>
                        
                        <h5 class="mb-3">Ubah Password</h5>
                        <form method="POST" action="">
                            <div class="mb-3">
                                <label for="password" class="form-label">Password Baru</label>
                                <input type="password" class="form-control" id="password" 
                                       name="password" minlength="6" required>
                                <small class="text-muted">Minimal 6 karakter</small>
                            </div>
                            <div class="mb-3">
                                <label for="confirm_password" class="form-label">Konfirmasi Password</label>
                                <input type="password" class="form-control" id="confirm_password" 
                                       name="confirm_password" minlength="6" required>
                            </div>
                            
                            <div class="d-flex justify-content-between">
                                <a href="indexmh.php" class="btn btn-secondary">Kembali</a>
                                <button type="submit" name="update" class="btn btn-warning">Update Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>