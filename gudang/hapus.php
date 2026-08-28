<?php
include '../koneksi.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id > 0) {
    try {
        $stmt = mysqli_prepare($koneksi, "DELETE FROM gudang WHERE id = ?");
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
    } catch (mysqli_sql_exception $e) {
        // Mencegah crash jika gudang masih terpakai pada data inventaris (Foreign Key Constraint)
        echo "<script>
            alert('Gudang tidak dapat dihapus karena masih digunakan pada data inventaris!');
            window.location.href = 'index.php';
        </script>";
        exit;
    }
}

header("Location: index.php");
exit;
?>