<?php

include "assets/conn/koneksi.php";
$nama_penyewa   = mysqli_real_escape_string($conn, $_POST['nama']);
$email          = mysqli_real_escape_string($conn, $_POST['email']);
$alamat         = mysqli_real_escape_string($conn, $_POST['alamat']);
$telp           = mysqli_real_escape_string($conn, $_POST['telp']);
$kamar          = mysqli_real_escape_string($conn, $_POST['kamar']);
$pass           = mysqli_real_escape_string($conn, $_POST['password']);
$date           = date('Y-m-d');
$pembayaran     = mysqli_real_escape_string($conn, $_POST['id_bayar']);
$ket            = mysqli_real_escape_string($conn, $_POST['ket']);
$invoice_id = rand();

// Sesuaikan dengan urutan kolom dalam tabel `user`
$query = mysqli_query($conn, "INSERT INTO user VALUES ('','$nama_penyewa','$email','$alamat','$telp','$kamar','$pembayaran','$pass','$date','$ket')");

if ($query) {
    // Dapatkan id_user yang baru saja dimasukkan
    $id = mysqli_insert_id($conn);

    // Memasukkan data ke dalam tabel `invoice`
    $invoice_query = false;
    if ($pembayaran == '4' && $ket == 'Bayar DP') {
        $invoice_query = mysqli_query($conn, "INSERT INTO invoice  VALUES ('$invoice_id ','$id','$date','700000','Belum Dibayar')");
    } else if ($pembayaran == '5' && $ket == 'Bayar DP') {
        $invoice_query = mysqli_query($conn, "INSERT INTO invoice  VALUES ('$invoice_id ','$id','$date','100000','Belum Dibayar')");
    } else if ($pembayaran == '4' && $ket == 'Bayar Full') {
        $invoice_query = mysqli_query($conn, "INSERT INTO invoice  VALUES ('$invoice_id ','$id','$date','2500000','Belum Dibayar')");
    } else if ($pembayaran == '5' && $ket == 'Bayar Full') {
        $invoice_query = mysqli_query($conn, "INSERT INTO invoice  VALUES ('$invoice_id ','$id','$date','300000','Belum Dibayar')");
    }

    // Cek apakah query `INSERT INTO invoice` berhasil
    if (!$invoice_query) {
        echo "Error: " . mysqli_error($conn); // Tampilkan pesan kesalahan jika ada
    }
}

header("location:index.php");
