<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login/login.php");
    exit();
}
?>
<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>



//dibawah body
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">Sistem Akademik</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <span class="nav-link">Halo, <?php echo $_SESSION['nama_lengkap']; ?></span>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../profile/edit_profile.php">Edit Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../login/logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<p>
    Halo, <?php echo $_SESSION['nama']; ?> | 
    <a href="edit_profile.php">Edit Profile</a> | 
    <a href="logout.php">Logout</a>
</p>


//dibawah proses

<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login/login.php");
    exit();
}
?>

CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) UNIQUE,
    password VARCHAR(50),
    nama VARCHAR(100),
    alamat TEXT
);