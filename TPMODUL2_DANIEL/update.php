<!-- BUAT FUNGSI EDIT DATA ( ketika data berhasil di tambahkan maka akan dialihkan ke halaman katalog buku) -->
<?php
include('connect.php');

// Cek apakah tombol update diklik dan ID tersedia
if (isset($_POST['update']) && isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    $judul = mysqli_real_escape_string($conn, $_POST['judul']);
    $penulis = mysqli_real_escape_string($conn, $_POST['penulis']);
    $tahun_terbit = (int) $_POST['tahun_terbit']; // Pastikan tahun berupa angka

    // Query Update Data
    $query = "UPDATE tb_buku SET judul = '$judul', penulis = '$penulis', tahun_terbit = $tahun_terbit WHERE id = $id";
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Redirect ke katalog_buku.php jika berhasil
        header("Location: katalog_buku.php");
        exit;
    } else {
        echo "<script>alert('Data gagal diperbarui!'); window.history.back();</script>";
    }
} else {
    echo "<script>alert('Permintaan tidak valid!'); window.location='katalog_buku.php';</script>";
}
?>
