<?php
include "../../assets/conn/koneksi.php";

$id_invoice     = $_POST['id_invoice'];
$id_pembayaran  = $_POST['id_pembayaran'];
$tanggal_pembayaran = $_POST['tanggal_pembayaran'];
$jumlah_pembayaran  = $_POST['jumlah_pembayaran'];
// $metode         = $_POST['metode'];
$status         = $_POST['status'];

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
            unlink('../../assets/bukti/' . $x);

            // Upload gambar baru

            move_uploaded_file($tmp, '../../assets/bukti/' . $x);
        }
    }
}
if (isset($namafile)) {
    $query = "UPDATE pembayaran SET
                tanggal_pembayaran='$tanggal_pembayaran',
                jumlah_pembayaran='$jumlah_pembayaran',
                status='$status'
          WHERE id_pembayaran = '$id_pembayaran'";
} else {

    // Query update
    $query = "UPDATE pembayaran SET
              tanggal_pembayaran='$tanggal_pembayaran',
                jumlah_pembayaran='$jumlah_pembayaran',
                foto='$x'
          WHERE id_pembayaran = '$id_pembayaran'";
}

// Eksekusi query
$result = mysqli_query($conn, $query);

if ($result) {
    $hapus = mysqli_query($conn, "DELETE FROM pembayaran WHERE id_pembayaran='$id_pembayaran'");
    if ($hapus) {
        $data = mysqli_query($conn, "UPDATE invoice SET status='$status' WHERE id_invoice='$id_invoice'");
        if ($data) {
            // Data berhasil diupdate
            echo "<script>alert('Selamat data telah dirubah dan disimpan ke database.'); window.location.href = '../index.php?page=6';</script>";
        } else {
            header("location:../index.php?page=6");
        }
    } else {
        header("location:../index.php?page=6");
    }
} else {
    // Terjadi kesalahan
    echo "<script>alert('Mohon maaf data gagal diubah. Silahkan periksa kembali!'); window.location.href = '../index.php?page=6';</script>";
}
