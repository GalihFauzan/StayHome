<?php
include "../../assets/conn/koneksi.php";

$nama_penyewa   = $_POST['nama_penyewa'];
$email          = $_POST['email'];
$alamat         = $_POST['alamat'];
$telp           = $_POST['telp'];
$kamar          = $_POST['kamar'];
$pass           = $_POST['password'];
$date           = date('Y-m-d');
$pembayaran     = $_POST['pembayaran'];
$ket            = $_POST['ket'];


$query = mysqli_query($conn, "INSERT INTO user VALUES ('','$nama_penyewa','$email','$alamat','$telp','$kamar','$pembayaran','$pass','$date','$ket')");
header("location:../index.php?page=2");
