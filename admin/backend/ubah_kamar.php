<?php
include "../../assets/conn/koneksi.php";

$id   = $_POST['id'];
$kamar      = $_POST['kamar'];

$query      = mysqli_query($conn, "UPDATE kamar SET kamar='$kamar' WHERE id_kamar='$id'");
header("location:../index.php?page=3");
