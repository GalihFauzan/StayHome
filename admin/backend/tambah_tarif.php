<?php
include "../../assets/conn/koneksi.php";

$tarif = $_POST['tarif'];
$dp = $_POST['dp'];
$ket = $_POST['ket'];

$query = mysqli_query($conn, "INSERT INTO biaya VALUES ('','$tarif','$dp','$ket')");
header("location:../index.php?page=10");
