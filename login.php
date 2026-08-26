<?php
session_start();
require 'koneksi.php';

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $result = mysqli_query($koneksi, "SELECT * FROM admin WHERE username='$username'");

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        
        // Verifikasi password hash
        if (password_verify($password, $row['password'])) {
            $_SESSION['login'] = true;
            $_SESSION['admin_id'] = $row['id'];
            $_SESSION['admin_nama'] = $row['nama'];

            echo "<script>alert('Login berhasil!'); window.location='dashboard.php';</script>";
            exit;
        }
    }
    
    $error = true;
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Login Admin</title>
</head>

<body>
    <h2>Form Login Admin</h2>

    <?php if (isset($error)) : ?>
    <p style="color: red;">Username atau password salah!</p>
    <?php endif; ?>

    <form action="" method="POST">
        <label>Username:</label><br>
        <input type="text" name="username" required><br><br>

        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>

        <button type="submit" name="login">Login</button>
    </form>
    <p>Belum punya akun? <a href="register.php">Daftar di sini</a></p>
</body>

</html>