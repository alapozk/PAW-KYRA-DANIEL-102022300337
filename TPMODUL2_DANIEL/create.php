<?php
include 'connect.php';

// ==================1==================
// If statement untuk mengecek POST request dari form
// Lalu definisikan variabel-variabel untuk menyimpan data yang dikirim dari POST
if (isset($_POST['create'])) {
    $judul = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $tahun_terbit = $_POST['tahun_terbit'];
    
    if (!is_numeric($tahun_terbit)) {
        echo "<script>alert('Tahun Terbit harus berupa angka!'); window.history.back();</script>";
        exit();
    }
    // ==================2==================
    // Definisikan $query untuk melakukan koneksi ke database
    $query = "INSERT INTO tb_buku (judul, penulis, tahun_terbit) VALUES ('$judul', '$penulis', '$tahun_terbit')";

    // ==================3==================
    // Eksekusi query
    $result = mysqli_query($conn, $query);

    if (mysqli_affected_rows($conn) > 0) {
        header("location: katalog_buku.php");
        exit();
    } else {
        echo "<script>alert('Data gagal ditambahkan');</script>";
    }
}
?>
