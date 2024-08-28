<?php
include "../../assets/conn/koneksi.php";

$id_pesan   = $_POST['id_pesan'];
$status     = $_POST['status'];

$query      = mysqli_query($conn, "UPDATE pesan SET status='$status' WHERE id_pesan='$id_pesan'");
header("location:../index.php?page=7");
