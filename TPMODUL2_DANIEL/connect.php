<?php
// ==================1==================
// Definisikan variabel2 yang akan digunakan untuk melakukan koneksi ke database
$host = "localhost"; //diganti dengan ip VPS
 $user = "root";
 $pass = "";
 $nama_db = "db_perpustakaan"; //nama database
 $conn = mysqli_connect($host,$user,$pass,$nama_db);
// ==================2==================
// Definisikan $conn untuk melakukan koneksi ke database 
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
else{
    //echo "KOneksi Sukses"
}


