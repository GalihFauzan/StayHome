<?php
include "../../assets/conn/koneksi.php";

$id = $_POST['id'];
$update = mysqli_query($conn, "UPDATE invoice SET status='Belum Bayar' WHERE id_invoice='$id'");
header("location:../index.php?page=6");
