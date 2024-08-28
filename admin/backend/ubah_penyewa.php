<?php
include "../../assets/conn/koneksi.php";

$id       = $_POST['id'];
$nama_penyewa   = $_POST['nama_penyewa'];

$email          = $_POST['email'];
$alamat         = $_POST['alamat'];
$telp           = $_POST['telp'];
$kamar          = $_POST['kamar'];
$pass           = $_POST['password'];
$date           = date('Y-m-d');
$pembayaran     = $_POST['pembayaran'];
$ket            = $_POST['ket'];

$query = mysqli_query($conn, "UPDATE user SET nama_user ='$nama_penyewa',email='$email',alamat='$alamat',telp='$telp',id_kamar='$kamar',password='$pass',tgl_sewa='$date',id_bayar='$pembayaran',keterangan='$ket' WHERE id_user='$id'");
header("location:../index.php?page=2");
