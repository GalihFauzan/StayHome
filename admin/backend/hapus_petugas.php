<?php
include '../../assets/conn/koneksi.php';

$id = $_GET['id_petugas'];

// Mengambil nama file gambar sebelum data dihapus
$queryFoto = "SELECT foto FROM petugas WHERE id_petugas='$id'";
$resultFoto = mysqli_query($conn, $queryFoto);
$rowFoto = mysqli_fetch_assoc($resultFoto);
$namaFoto = $rowFoto['foto'];

// Menghapus data dari database
$query = "DELETE FROM petugas WHERE id_petugas='$id'";
$result = mysqli_query($conn, $query);

if ($result) {
    // Hapus gambar terkait
    unlink('../../assets/foto/' . $namaFoto);

    // Data berhasil dihapus
    header("location:../index.php?page=4");
} else {
    // Terjadi kesalahan
    echo "<script>alert('Mohon maaf data gagal di hapus, silahkan periksa kembali!'); window.location.href = '../index.php?page=4';</script>";
}
