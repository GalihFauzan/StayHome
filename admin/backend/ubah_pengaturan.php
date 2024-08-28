<?php
include "../../assets/conn/koneksi.php";

$id         = $_POST['id'];
$judul      = $_POST['judul'];
$info       = $_POST['info'];



$query      = mysqli_query($conn, "UPDATE pengaturan SET judul='$judul',informasi='$info' WHERE id='$id'");
header("location:../index.php?page=8");
