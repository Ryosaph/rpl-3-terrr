<?php
include '../koneksi.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Ambil data gudang berdasarkan id
$stmt = mysqli_prepare($koneksi, "SELECT * FROM gudang WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$data = mysqli_fetch_assoc($result);

if (!$data) {
    header("Location: index.php");
    exit;
}

// Proses update data
if (isset($_POST['submit'])) {
    $nama_gudang   = trim($_POST['nama_gudang']);
    $lokasi_gudang = trim($_POST['lokasi_gudang']);

    $update_stmt = mysqli_prepare($koneksi, "UPDATE gudang SET nama_gudang = ?, lokasi_gudang = ? WHERE id = ?");
    mysqli_stmt_bind_param($update_stmt, "ssi", $nama_gudang, $lokasi_gudang, $id);

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
    <title>Edit Gudang</title>
    <link rel="stylesheet" href="style2.css">
</head>

<body>

    <h2>Edit Data Gudang</h2>

    <?php if (isset($error)) : ?>
    <p style="color: red;"><?= $error; ?></p>
    <?php endif; ?>

    <form method="POST" action="">
        <div class="form-group">
            <label>Nama Gudang</label>
            <input type="text" name="nama_gudang" value="<?= htmlspecialchars($data['nama_gudang']); ?>" required>
        </div>
        <div class="form-group">
            <label>Lokasi Gudang</label>
            <input type="text" name="lokasi_gudang" value="<?= htmlspecialchars($data['lokasi_gudang']); ?>" required>
        </div>
        <div>
            <button type="submit" name="submit" class="btn btn-blue">Update</button>
            <a href="index.php" class="btn btn-secondary">Batal</a>
        </div>
    </form>

</body>

</html>