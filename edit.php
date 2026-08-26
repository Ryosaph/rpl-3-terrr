<?php
session_start();
require 'koneksi.php';

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

$id = $_GET['id'];
$data_inven = mysqli_query($koneksi, "SELECT * FROM inven WHERE id = '$id'");
$data = mysqli_fetch_assoc($data_inven);

if (!$data) {
    header("Location: dashboard.php");
    exit;
}

// Data relasi untuk dropdown
$admin_list = mysqli_query($koneksi, "SELECT * FROM admin");
$supplier_list = mysqli_query($koneksi, "SELECT * FROM supplier");
$gudang_list = mysqli_query($koneksi, "SELECT * FROM gudang");

if (isset($_POST['update'])) {
    $id_admin      = $_POST['id_admin'];
    $id_supplier   = $_POST['id_supplier'];
    $id_gudang     = $_POST['id_gudang'];
    $nama_barang   = $_POST['nama_barang'];
    $jenis_barang  = $_POST['jenis_barang'];
    $kuantitas     = $_POST['kuantitas_stok'];
    $lokasi_barang = $_POST['lokasi_barang'];
    $serial_number = $_POST['serial_number'];

    $query = "UPDATE inven SET
                id_admin = '$id_admin',
                id_supplier = '$id_supplier',
                id_gudang = '$id_gudang',
                nama_barang = '$nama_barang',
                jenis_barang = '$jenis_barang',
                kuantitas_stok = '$kuantitas',
                lokasi_barang = '$lokasi_barang',
                serial_number = '$serial_number'
              WHERE id = '$id'";

    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Data berhasil diperbarui!'); window.location='dashboard.php';</script>";
    } else {
        echo "Gagal memperbarui data: " . mysqli_error($koneksi);
    }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Edit Inventaris</title>
    <link rel="stylesheet" href="style4.css">
</head>

<body>
    <h2>Edit Data Inventaris</h2>
    <form action="" method="POST">
        <label>Nama Barang:</label><br>
        <input type="text" name="nama_barang" value="<?= htmlspecialchars($data['nama_barang']); ?>" required><br><br>

        <label>Jenis Barang: </label><br>
        <select name="jenis_barang" required>
            <option value="ringan" <?= $data['jenis_barang'] == 'ringan' ? 'selected' : ''; ?>>Ringan</option>
            <option value="berat" <?= $data['jenis_barang'] == 'berat' ? 'selected' : ''; ?>>Berat</option>
        </select><br><br>

        <label>Kuantitas Stok: </label><br>
        <input type="number" name="kuantitas_stok" value="<?= htmlspecialchars($data['kuantitas_stok']); ?>"
            required><br><br>

        <label>Lokasi Barang: </label><br>
        <input type="text" name="lokasi_barang" value="<?= htmlspecialchars($data['lokasi_barang']); ?>"
            required><br><br>

        <label>Serial Number: </label><br>
        <input type="text" name="serial_number" value="<?= htmlspecialchars($data['serial_number']); ?>"
            required><br><br>

        <label>Gudang: </label><br>
        <select name="id_gudang" required>
            <?php while ($g = mysqli_fetch_assoc($gudang_list)): ?>
            <option value="<?= $g['id']; ?>" <?= $data['id_gudang'] == $g['id'] ? 'selected' : ''; ?>>
                <?= htmlspecialchars($g['nama_gudang']); ?>
            </option>
            <?php endwhile; ?>
        </select><br><br>

        <label>Supplier:</label><br>
        <select name="id_supplier" required>
            <?php while ($s = mysqli_fetch_assoc($supplier_list)): ?>
            <option value="<?= $s['id']; ?>" <?= $data['id_supplier'] == $s['id'] ? 'selected' : ''; ?>>
                <?= htmlspecialchars($s['nama']); ?>
            </option>
            <?php endwhile; ?>
        </select><br><br>

        <label>Admin PIC:</label><br>
        <select name="id_admin" required>
            <?php while ($a = mysqli_fetch_assoc($admin_list)): ?>
            <option value="<?= $a['id']; ?>" <?= $data['id_admin'] == $a['id'] ? 'selected' : ''; ?>>
                <?= htmlspecialchars($a['nama']); ?>
            </option>
            <?php endwhile; ?>
        </select><br><br>

        <button type="submit" name="update">Simpan Perubahan</button>
        <a href="dashboard.php">Batal</a>
    </form>
</body>

</html>