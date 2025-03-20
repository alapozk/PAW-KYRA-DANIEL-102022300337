
<?php
include 'connect.php';

// (1.) Cek Apakah ada data yang dikirim
if (isset($_GET['search'])) {
    $search = trim($_GET['search']);

    // (2.) Validasi Input jika search input kurang dari 3 karakter
    if (strlen($search) < 3) {
        echo "<script>alert('Minimal 3 karakter untuk pencarian');</script>";
    }
    // (3.) Validasi Input jika search input tidak alphanumeric
    elseif (!preg_match("/^[a-zA-Z0-9 ]+$/", $search)) {
        echo "<script>alert('Pencarian hanya boleh mengandung huruf dan angka');</script>";
    } else {
        // (4.) Buat query untuk menampilkan data
        $query = "SELECT * FROM tb_buku WHERE judul LIKE '%$search%' OR penulis LIKE '%$search%'";

        // (5.) Jalankan query
        $result = mysqli_query($conn, $query);

        // (6.) Tampung hasil query ke dalam array
        $bukus = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
} else {
    $query = "SELECT * FROM tb_buku";
    $result = mysqli_query($conn, $query);
    $bukus = mysqli_fetch_all($result, MYSQLI_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="container mt-5">
        <h1>Katalog Buku</h1>
        <!-- (7.) Tambahkan Method  GET -->
        <form action="katalog_buku.php" method="GET" class="form-inline">
            <!-- (8.) Tambahkan Value $search -->
            <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search" value="<?= isset($search) ? htmlspecialchars($search) : '' ?>" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
        <table class="table table-bordered">
            <thead>
                <tr>
                  <th>No</th>
                  <th>Judul</th>
                  <th>Penulis</th>
                  <th>Tahun</th>
                  <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($bukus)) : ?>
                    <tr>
                        <th colspan="5" class="text-center">TIDAK ADA DATA DALAM KATALOG</th>
                    </tr>
                <?php else: ?>
                    <?php foreach ($bukus as $index => $buku) : ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td><?= htmlspecialchars($buku['judul']) ?></td>
                            <td><?= htmlspecialchars($buku['penulis']) ?></td>
                            <td><?= htmlspecialchars($buku['tahun_terbit']) ?></td>
                            <td>
                                <a href="edit_buku.php?id=<?= $buku['id'] ?>" class="btn btn-primary">Edit</a>
                                <a href="delete.php?id=<?= $buku['id'] ?>" class="btn btn-danger" >Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
