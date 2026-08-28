<?php
session_start();
require 'koneksi.php';

// Proteksi Sesi: Jika sudah login, lempar ke dashboard
if (isset($_SESSION['login'])) {
    header("Location: inven/dashboard.php");
    exit;
}

$error = false;

if (isset($_POST['login'])) {
    $email  = trim($_POST['email']);
    $kontak = trim($_POST['kontak']);

    // Query login menggunakan kolom yang ada: email & kontak
    $stmt = mysqli_prepare($koneksi, "SELECT id, nama, email, kontak FROM admin WHERE email = ? AND kontak = ?");
    mysqli_stmt_bind_param($stmt, "ss", $email, $kontak);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);

        $_SESSION['login']      = true;
        $_SESSION['admin_id']   = $row['id'];
        $_SESSION['admin_nama'] = $row['nama'];

        echo "<script>alert('Login berhasil!'); window.location='dashboard.php';</script>";
        exit;
    } else {
        $error = true;
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Invenkoryz</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="auth-container">
        <h2>Form Login Admin</h2>

        <?php if ($error): ?>
        <div class="alert-error">Email atau Kontak tidak terdaftar!</div>
        <?php endif; ?>

        <form action="" method="POST">
            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" placeholder="contoh@domain.com" required>
            </div>
            <div class="form-group">
                <label>Kontak (No. HP):</label>
                <input type="number" name="kontak" placeholder="08xxxxxxxx" required>
            </div>
            <button type="submit" name="login" class="btn-submit">Login</button>
        </form>
        <p class="text-center">Belum punya akun? <a href="register.php">Daftar di sini</a></p>
    </div>
</body>

</html>