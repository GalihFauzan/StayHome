<?php
include "../../assets/conn/koneksi.php";

$id_pesan = $_GET['id_pesan'];
$query = mysqli_query($conn, "DELETE FROM pesan WHERE id_pesan='$id_pesan'");
header("location:../index.php?page=4");
