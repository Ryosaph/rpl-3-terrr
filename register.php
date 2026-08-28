<?php
require 'koneksi.php';

if (isset($_POST['register'])) {
    $nama   = trim($_POST['nama']);
    $kontak = (int)$_POST['kontak'];
    $email  = trim($_POST['email']);

    // Cek duplikasi email
    $stmt_cek = mysqli_prepare($koneksi, "SELECT id FROM admin WHERE email = ?");
    mysqli_stmt_bind_param($stmt_cek, "s", $email);
    mysqli_stmt_execute($stmt_cek);
    mysqli_stmt_store_result($stmt_cek);

    if (mysqli_stmt_num_rows($stmt_cek) > 0) {
        echo "<script>alert('Email sudah terdaftar!'); window.history.back();</script>";
    } else {
        // Insert data sesuai skema tabel admin (id, nama, kontak, email)
        $stmt_insert = mysqli_prepare($koneksi, "INSERT INTO admin (nama, kontak, email) VALUES (?, ?, ?)");
        mysqli_stmt_bind_param($stmt_insert, "sis", $nama, $kontak, $email);

        if (mysqli_stmt_execute($stmt_insert)) {
            echo "<script>alert('Registrasi berhasil! Silakan login.'); window.location='index.php';</script>";
            exit;
        } else {
            echo "<script>alert('Gagal mendaftar: " . mysqli_error($koneksi) . "');</script>";
        }
        mysqli_stmt_close($stmt_insert);
    }
    mysqli_stmt_close($stmt_cek);
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Invenkoryz</title>
    <link rel="stylesheet" href="style3.css">
</head>

<body>
    <div class="auth-container">
        <h2>Form Register Admin</h2>
        <form action="" method="POST">
            <div class="form-group">
                <label>Nama Lengkap:</label>
                <input type="text" name="nama" required>
            </div>
            <div class="form-group">
                <label>Kontak (Angka):</label>
                <input type="number" name="kontak" required>
            </div>
            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" required>
            </div>
            <button type="submit" name="register" class="btn-submit">Daftar</button>
        </form>
        <p class="text-center">Sudah punya akun? <a href="index.php">Login di sini</a></p>
    </div>
</body>

</html>