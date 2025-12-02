<?php
include("koneksimh.php");

if(isset($_POST['submit'])){
    $nim = $_POST['nim'];
    $name_mhs = $_POST['name_mhs'];
    $tgl_lahir = $_POST['tgl_lahir'];
    $alamat = $_POST['alamat'];
    
    $sql = "INSERT INTO mahasiswa(nim, nama_mhs, tgl_lahir, alamat) 
            VALUES ('$nim', '$name_mhs', '$tgl_lahir', '$alamat')";
    
    $query = $koneksimh->query($sql);
    
    if($query){
        header("Location: createmh.php");
        exit();
    } else {
        echo "Error: " . $koneksimh->error;
    }
} else {
    echo "Form tidak disubmit dengan benar!";
}
?>