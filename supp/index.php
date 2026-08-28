<?php
include '../koneksi.php';

$query = "SELECT * FROM supplier ORDER BY id DESC";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Data Supplier</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <h2>Daftar Supplier</h2>
    <div style="margin-bottom: 15px;">
        <a href="tambah.php" class="btn btn-green">+ Tambah Supplier</a>
        <a href="../index.php" class="btn btn-blue">Kembali ke Dashboard</a>
        <a href="../gudang/index.php" class="btn btn-brown">ke gudang</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Supplier</th>
                <th>Kontak</th>
                <th>Nama Barang</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $no = 1;
            while ($row = mysqli_fetch_assoc($result)) : 
            ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= htmlspecialchars($row['nama']); ?></td>
                <td><?= htmlspecialchars($row['kontak']); ?></td>
                <td><?= htmlspecialchars($row['nama_barang']); ?></td>
                <td>
                    <a href="edit.php?id=<?= $row['id']; ?>" class="btn btn-blue">Edit</a>
                    <a href="hapus.php?id=<?= $row['id']; ?>" class="btn btn-red"
                        onclick="return confirm('Hapus data ini?');">Hapus</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

</body>

</html>