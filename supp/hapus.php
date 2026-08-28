<?php
include '../koneksi.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id > 0) {
    try {
        $stmt = mysqli_prepare($koneksi, "DELETE FROM supplier WHERE id = ?");
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
    } catch (mysqli_sql_exception $e) {
        // Mencegah error jika id_supplier sedang digunakan di tabel inven (Foreign Key Constraint)
        echo "<script>
            alert('Data tidak dapat dihapus karena masih terhubung dengan tabel inventaris!');
            window.location.href = 'index.php';
        </script>";
        exit;
    }
}

header("Location: index.php");
exit;
?>