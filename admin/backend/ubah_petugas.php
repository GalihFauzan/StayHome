<?php
include "../../assets/conn/koneksi.php";

$id             = $_POST['id'];
$nama_petugas   = $_POST['nama_petugas'];
$username       = $_POST['username'];
$email          = $_POST['email'];
$telp           = $_POST['telp'];
$pass           = $_POST['password'];


$limit = 10 * 1024 * 1024;
$ekstensi = array('png', 'jpg', 'jpeg', 'gif');
$jumlahFile = count($_FILES['foto']['name']);

// Default nama file
$x = $_POST['old_foto'];

// Cek apakah ada file yang diunggah
if (!empty($_FILES['foto']['name'][0])) {
    for ($i = 0; $i < $jumlahFile; $i++) {
        $namafile = $_FILES['foto']['name'][$i];
        $tmp = $_FILES['foto']['tmp_name'][$i];
        $tipe_file = pathinfo($namafile, PATHINFO_EXTENSION);
        $ukuran = $_FILES['foto']['size'][$i];

        if ($ukuran > $limit) {
            echo "gagal ukuran";
        } elseif (!in_array($tipe_file, $ekstensi)) {
            echo "gagal ekstensi";
        } else {
            // Hapus gambar yang sudah ada
            unlink('../../assets/foto/' . $x);

            // Upload gambar baru

            move_uploaded_file($tmp, '../../assets/foto/' . $x);
        }
    }
}
if (isset($namafile)) {
    $query = "UPDATE petugas SET
            nama_petugas='$nama_petugas',
            username='$username',
            email='$email',
            telp='$telp',
            password='$pass'
          WHERE id_petugas = '$id'";
} else {

    // Query update
    $query = "UPDATE petugas SET
            nama_petugas='$nama_petugas',
            username='$username',
            email='$email',
            telp='$telp',
            password='$pass',
            foto = '$x'
          WHERE id_petugas = '$id'";
}

// Eksekusi query
$result = mysqli_query($conn, $query);

if ($result) {
    // Data berhasil diupdate
    echo "<script>alert('Selamat data telah dirubah dan disimpan ke database.'); window.location.href = '../index.php?page=4';</script>";
} else {
    // Terjadi kesalahan
    echo "<script>alert('Mohon maaf data gagal diubah. Silahkan periksa kembali!'); window.location.href = '../index.php?page=4';</script>";
}
