<?php
session_start();
require 'koneksi.php';

// Proteksi halaman login
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

// Ambil opsi pilihan dari tabel relasi
$admin_list = mysqli_query($koneksi, "SELECT * FROM admin");
$supplier_list = mysqli_query($koneksi, "SELECT * FROM supplier");
$gudang_list = mysqli_query($koneksi, "SELECT * FROM gudang");

if (isset($_POST['tambah'])) {
    $id_admin      = $_POST['id_admin'];
    $id_supplier   = $_POST['id_supplier'];
    $id_gudang     = $_POST['id_gudang'];
    $nama_barang   = $_POST['nama_barang'];
    $jenis_barang  = $_POST['jenis_barang'];
    $kuantitas     = $_POST['kuantitas_stok'];
    $lokasi_barang = $_POST['lokasi_barang'];
    $serial_number = $_POST['serial_number'];

    $query = "INSERT INTO inven (id_admin, id_supplier, id_gudang, nama_barang, jenis_barang, kuantitas_stok, lokasi_barang, serial_number)
              VALUES ('$id_admin', '$id_supplier', '$id_gudang', '$nama_barang', '$jenis_barang', '$kuantitas', '$lokasi_barang', '$serial_number')";

    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Data berhasil ditambahkan!'); window.location='dashboard.php';</script>";
    } else {
        echo "Gagal menambahkan data: " . mysqli_error($koneksi);
    }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Tambah Inventaris</title>
    <link rel="stylesheet" href="style3.css">
</head>

<body>
    <h2>Tambah Data Inventaris</h2>
    <form action="" method="POST">
        <label>Nama Barang: </label><br>
        <input type="text" name="nama_barang" required><br><br>

        <label>Jenis Barang: </label><br>
        <select name="jenis_barang" required>
            <option value="ringan">Ringan</option>
            <option value="berat">Berat</option>
        </select><br><br>

        <label>Kuantitas Stok: </label><br>
        <input type="number" name="kuantitas_stok" required><br><br>

        <label>Lokasi Barang (Sub-lokasi): </label><br>
        <input type="text" name="lokasi_barang" required><br><br>

        <label>Serial Number: </label><br>
        <input type="text" name="serial_number" required><br><br>

        <label>Gudang: </label><br>
        <select name="id_gudang" required>
            <option value="">-- Pilih Gudang --</option>
            <?php while ($g = mysqli_fetch_assoc($gudang_list)): ?>
            <option value="<?= $g['id']; ?>"><?= htmlspecialchars($g['nama_gudang']); ?></option>
            <?php endwhile; ?>
        </select><br><br>

        <label>Supplier: </label><br>
        <select name="id_supplier" required>
            <option value="">-- Pilih Supplier --</option>
            <?php while ($s = mysqli_fetch_assoc($supplier_list)): ?>
            <option value="<?= $s['id']; ?>"><?= htmlspecialchars($s['nama']); ?></option>
            <?php endwhile; ?>
        </select><br><br>

        <label>Admin Penanggung Jawab:</label><br>
        <select name="id_admin" required>
            <option value="">-- Pilih Admin --</option>
            <?php while ($a = mysqli_fetch_assoc($admin_list)): ?>
            <option value="<?= $a['id']; ?>"><?= htmlspecialchars($a['nama']); ?></option>
            <?php endwhile; ?>
        </select><br><br>

        <button type="submit" name="tambah">Simpan Data</button>
        <a href="dashboard.php">Batal</a>
    </form>
</body>

</html>