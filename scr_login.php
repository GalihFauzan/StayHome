<?php
include 'assets/conn/koneksi.php';

session_start();

$username = $_POST['username'];
$password = $_POST['password'];

$query = mysqli_query($conn, "SELECT * FROM petugas WHERE email = '$username' OR telp='$username' OR username='$username'");
if (mysqli_num_rows($query)) {
    $baris = mysqli_fetch_assoc($query);
    if ($password == $baris['password']) {
        header("Location: admin/index.php");
        $_SESSION['id'] = $baris['id_petugas'];
        $_SESSION['nama'] = $baris['nama_petugas'];
        $_SESSION['level'] = $baris['level'];
        $_SESSION['login'] = true;
        exit;
    } else {
        echo "<script>alert('Username atau Password Anda Salah');document.location.href='index.php';</script>";
    }
} else {
    $querypengguna = mysqli_query($conn, "SELECT * FROM user WHERE email = '$username' OR telp='$username'");
    if (mysqli_num_rows($querypengguna)) {
        $baris = mysqli_fetch_assoc($querypengguna);
        if ($password == $baris['password']) {
            header("Location: user/index.php");
            $_SESSION['id'] = $baris['id_user'];
            $_SESSION['nama'] = $baris['nama_user'];
            $_SESSION['login'] = true;
            exit;
        } else {
            echo "<script>alert('Username atau Password Anda Salah');document.location.href='index.php';</script>";
        }
    }
}
