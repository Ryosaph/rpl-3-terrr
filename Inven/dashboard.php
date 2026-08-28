<?php
session_start();
require '../koneksi.php';

// Proteksi halaman: Cek apakah user sudah login
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

// Query JOIN untuk mengambil data barang beserta nama admin, supplier, dan gudang
$query = "SELECT inven.*, 
                 admin.nama AS nama_admin, 
                 supplier.nama AS nama_supplier, 
                 gudang.nama_gudang 
          FROM inven
          LEFT JOIN admin ON inven.id_admin = admin.id
          LEFT JOIN supplier ON inven.id_supplier = supplier.id
          LEFT JOIN gudang ON inven.id_gudang = gudang.id";

$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style2.css">
    <title>Dashboard Inventaris</title>
</head>

<body>
    <h1 style="text-align: center;">Halo, Selamat Datang <?= htmlspecialchars($_SESSION['admin_nama']); ?>!</h1>
    <p style="text-align: center;"><a href="../logout.php">Logout</a></p>

    <h2 style="text-align: center;">Data Inventaris Stok</h2>

    <!-- Tombol Navigasi Tambah Data Barang -->
    <div style="text-align: center; margin-bottom: 15px;">
        <a href="tambah.php"
            style="display: inline-block; padding: 8px 16px; background-color: #28a745; color: #ffffff; text-decoration: none; border-radius: 4px; font-weight: bold;">+
            Tambah Data Barang</a>
        <a href="../supp/index.php"
            style="display: inline-block; padding: 8px 16px; background-color: #2857a7; color: #ffffff; text-decoration: none; border-radius: 4px; font-weight: bold;">
            Supplier
        </a>
    </div>


    <table border="1" cellpadding="10" cellspacing="0" style="margin: 0 auto; border-collapse: collapse;">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Jenis</th>
                <th>Kuantitas</th>
                <th>Lokasi Barang</th>
                <th>Serial Number</th>
                <th>Gudang</th>
                <th>Supplier</th>
                <th>Admin PIC</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
            <tr>
                <td><?= $i++; ?></td>
                <td><?= htmlspecialchars($row['nama_barang']); ?></td>
                <td><?= htmlspecialchars($row['jenis_barang']); ?></td>
                <td><?= htmlspecialchars($row['kuantitas_stok']); ?></td>
                <td><?= htmlspecialchars($row['lokasi_barang']); ?></td>
                <td><?= htmlspecialchars($row['serial_number']); ?></td>
                <td><?= htmlspecialchars($row['nama_gudang'] ?? '-'); ?></td>
                <td><?= htmlspecialchars($row['nama_supplier'] ?? '-'); ?></td>
                <td><?= htmlspecialchars($row['nama_admin'] ?? '-'); ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>

</html>