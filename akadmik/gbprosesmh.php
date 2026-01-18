<?php
// gbprosesmh.php
include("koneksimh.php");

if(isset($_POST['submit'])){
    $nim = $_POST['nim'];
    $nama_mhs = $_POST['nama_mhs'];
    $tgl_lahir = $_POST['tgl_lahir'];
    $alamat = $_POST['alamat'];
    $prodi_id = $_POST['prodi_id'];
    
    // Validasi
    if(empty($nim) || empty($nama_mhs) || empty($tgl_lahir) || empty($alamat) || empty($prodi_id)) {
        header("Location: createmh.php?error=Semua field harus diisi!");
        exit();
    }
    
    // Cek apakah NIM sudah ada
    $check_query = "SELECT * FROM mahasiswa WHERE nim = '$nim'";
    $check_result = $koneksimh->query($check_query);
    
    if($check_result->num_rows > 0) {
        header("Location: createmh.php?error=NIM sudah terdaftar!");
        exit();
    }
    
    $sql = "INSERT INTO mahasiswa(nim, nama_mhs, tgl_lahir, alamat, prodi_id) 
            VALUES ('$nim', '$nama_mhs', '$tgl_lahir', '$alamat', '$prodi_id')";
    
    if($koneksimh->query($sql)){
        header("Location: index.php?success=Data mahasiswa berhasil ditambahkan!");
        exit();
    } else {
        header("Location: createmh.php?error=Gagal menyimpan data!");
        exit();
    }
} else {
    header("Location: createmh.php");
    exit();
}
?>