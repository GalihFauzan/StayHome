<?php
include "../../assets/conn/koneksi.php";

$id_user = $_POST['id_user'];
$tgl_pesan = date('Y-m-d H:i:s');
$id_kamar = $_POST['id_kamar'];
$judul = $_POST['judul'];
$pesan = $_POST['pesan'];

$query = mysqli_query($conn, "INSERT INTO (id_user,tgl_pesan,id_kamar,judul,pesan,Menunggu Konfirmasipesan) values('$id_user','$tgl_pesan','$id_kamar','$judul','$pesan','Menunggu Konfirmasi')");
header("location:../index.php?page=4");
