<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include("koneksimh.php");

if(isset($_POST['submit'])){
    $nim = trim($_POST['nim']);
    $nama_mhs = trim($_POST['nama_mhs']);
    $tgl_lahir = $_POST['tgl_lahir'];
    $alamat = trim($_POST['alamat']);
    $prodi_id = $_POST['prodi_id'];
    
    // Validasi input
    if(empty($nim) || empty($nama_mhs) || empty($tgl_lahir) || empty($alamat) || empty($prodi_id)) {
        echo "<script>
                alert('Semua field harus diisi!');
                window.history.back();
              </script>";
        exit();
    }
    
    // Cek apakah NIM sudah ada
    $check_nim = $koneksimh->prepare("SELECT nim FROM mahasiswa WHERE nim = ?");
    $check_nim->bind_param("s", $nim);
    $check_nim->execute();
    $check_nim->store_result();
    
    if($check_nim->num_rows > 0) {
        echo "<script>
                alert('NIM $nim sudah terdaftar!');
                window.history.back();
              </script>";
        exit();
    }
    $check_nim->close();
    
    // Cek apakah prodi_id valid di tabel prodi
    $check_prodi = $koneksimh->prepare("SELECT id, nama_prodi FROM prodi WHERE id = ?");
    $check_prodi->bind_param("i", $prodi_id);
    $check_prodi->execute();
    $check_prodi_result = $check_prodi->get_result();
    
    if($check_prodi_result->num_rows == 0) {
        echo "<script>
                alert('Program Studi tidak valid! Silakan pilih program studi yang tersedia.');
                window.history.back();
              </script>";
        exit();
    }
    $check_prodi->close();
    
    // Insert data mahasiswa
    $stmt = $koneksimh->prepare("INSERT INTO mahasiswa (nim, nama_mhs, tgl_lahir, alamat, prodi_id) 
                                 VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssi", $nim, $nama_mhs, $tgl_lahir, $alamat, $prodi_id);
    
    if($stmt->execute()){
        echo "<script>
                alert('Data mahasiswa berhasil disimpan!');
                window.location.href = 'indexmh.php';
              </script>";
    } else {
        echo "<script>
                alert('Error: " . addslashes($stmt->error) . "');
                window.history.back();
              </script>";
    }
    $stmt->close();
} else {
    header("Location: createmh.php");
    exit();
}
?>