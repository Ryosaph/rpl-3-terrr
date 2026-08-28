<?php
include '../koneksi.php';

if (isset($_POST['submit'])) {
    $nama_gudang   = trim($_POST['nama_gudang']);
    $lokasi_gudang = trim($_POST['lokasi_gudang']);

    // Menggunakan Prepared Statement (Secure Best Practice)
    $stmt = mysqli_prepare($koneksi, "INSERT INTO gudang (nama_gudang, lokasi_gudang) VALUES (?, ?)");
    mysqli_stmt_bind_param($stmt, "ss", $nama_gudang, $lokasi_gudang);

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
    <title>Tambah Gudang</title>
    <link rel="stylesheet" href="style1.css">
</head>

<body>

    <h2>Tambah Gudang Baru</h2>

    <?php if (isset($error)) : ?>
    <p style="color: red;"><?= $error; ?></p>
    <?php endif; ?>

    <form method="POST" action="">
        <div class="form-group">
            <label>Nama Gudang</label>
            <input type="text" name="nama_gudang" placeholder="Contoh: Gudang Utama / Gudang A" required>
        </div>
        <div class="form-group">
            <label>Lokasi Gudang</label>
            <input type="text" name="lokasi_gudang" placeholder="Contoh: Blok B No. 12" required>
        </div>
        <div>
            <button type="submit" name="submit" class="btn btn-green">Simpan</button>
            <a href="index.php" class="btn btn-secondary">Batal</a>
        </div>
    </form>

</body>

</html>