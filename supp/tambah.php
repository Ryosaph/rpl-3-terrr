<?php
include '../koneksi.php';

if (isset($_POST['submit'])) {
    $nama = trim($_POST['nama']);
    $kontak = trim($_POST['kontak']);
    $nama_barang = trim($_POST['nama_barang']);

    // Prepared Statement untuk mencegah SQL Injection
    $stmt = mysqli_prepare($koneksi, "INSERT INTO supplier (nama, kontak, nama_barang) VALUES (?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "sis", $nama, $kontak, $nama_barang);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: index.php");
        exit;
    } else {
        $error = "Gagal menyimpan data: " . mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Tambah Supplier</title>
    <link rel="stylesheet" href="style1.css">
</head>

<body>

    <h2>Tambah Supplier Baru</h2>

    <?php if (isset($error)) : ?>
    <p style="color: red;"><?= $error; ?></p>
    <?php endif; ?>

    <form method="POST" action="">
        <div class="form-group">
            <label>Nama Supplier</label>
            <input type="text" name="nama" required>
        </div>
        <div class="form-group">
            <label>Kontak (Angka)</label>
            <input type="number" name="kontak" required>
        </div>
        <div class="form-group">
            <label>Nama Barang</label>
            <input type="text" name="nama_barang" required>
        </div>
        <div>
            <button type="submit" name="submit" class="btn btn-green">Simpan</button>
            <a href="index.php" class="btn btn-secondary">Batal</a>
        </div>
    </form>

</body>

</html>