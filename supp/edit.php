<?php
include '../koneksi.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Ambil data lama
$stmt = mysqli_prepare($koneksi, "SELECT * FROM supplier WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$data = mysqli_fetch_assoc($result);

if (!$data) {
    header("Location: index.php");
    exit;
}

// Proses update
if (isset($_POST['submit'])) {
    $nama = trim($_POST['nama']);
    $kontak = trim($_POST['kontak']);
    $nama_barang = trim($_POST['nama_barang']);

    $update_stmt = mysqli_prepare($koneksi, "UPDATE supplier SET nama = ?, kontak = ?, nama_barang = ? WHERE id = ?");
    mysqli_stmt_bind_param($update_stmt, "sisi", $nama, $kontak, $nama_barang, $id);

    if (mysqli_stmt_execute($update_stmt)) {
        header("Location: index.php");
        exit;
    } else {
        $error = "Gagal memperbarui data: " . mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Edit Supplier</title>
    <link rel="stylesheet" href="style2.css">
</head>

<body>

    <h2>Edit Data Supplier</h2>

    <?php if (isset($error)) : ?>
    <p style="color: red;"><?= $error; ?></p>
    <?php endif; ?>

    <form method="POST" action="">
        <div class="form-group">
            <label>Nama Supplier</label>
            <input type="text" name="nama" value="<?= htmlspecialchars($data['nama']); ?>" required>
        </div>
        <div class="form-group">
            <label>Kontak</label>
            <input type="number" name="kontak" value="<?= htmlspecialchars($data['kontak']); ?>" required>
        </div>
        <div class="form-group">
            <label>Nama Barang</label>
            <input type="text" name="nama_barang" value="<?= htmlspecialchars($data['nama_barang']); ?>" required>
        </div>
        <div>
            <button type="submit" name="submit" class="btn btn-blue">Update</button>
            <a href="index.php" class="btn btn-secondary">Batal</a>
        </div>
    </form>

</body>

</html>