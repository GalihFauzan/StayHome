<?php
include "../../assets/conn/koneksi.php";

$id_kamar = $_GET['id_kamar'];
$query = mysqli_query($conn, "DELETE FROM kamar WHERE id_kamar='$id_kamar'");
header("location:../index.php?page=3");
