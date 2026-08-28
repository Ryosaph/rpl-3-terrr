<?php
include '../koneksi.php';

$query = "SELECT * FROM gudang ORDER BY id DESC";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Data Gudang</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <h2>Daftar Gudang</h2>
    <div style="margin-bottom: 15px;">
        <a href="tambah.php" class="btn btn-green">+ Tambah Gudang</a>
        <a href="../index.php" class="btn btn-blue">Kembali ke Dashboard</a>
        <a href="../supp/index.php" class="btn btn-maroon">ke supplier</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Gudang</th>
                <th>Lokasi Gudang</th>
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
                <td><?= htmlspecialchars($row['nama_gudang']); ?></td>
                <td><?= htmlspecialchars($row['lokasi_gudang']); ?></td>
                <td>
                    <a href="edit.php?id=<?= $row['id']; ?>" class="btn btn-blue">Edit</a>
                    <a href="hapus.php?id=<?= $row['id']; ?>" class="btn btn-red"
                        onclick="return confirm('Hapus gudang ini?');">Hapus</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

</body>

</html>