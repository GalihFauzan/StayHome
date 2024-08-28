<?php
include "../../assets/conn/koneksi.php";

$judul  = $_POST['judul'];
$info   = $_POST['info'];
$tarif  = $_POST['tarif'];

$data = mysqli_query($conn, "SELECT * FROM pengaturan");
$total = mysqli_num_rows($data);

if ($total > 0) {

    $query = mysqli_query($conn, "UPDATE pengaturan SET judul='$judul',informasi='$info',tarif='$tarif' WHERE id='1'");
    header("location:../index.php?page=8");
} else {

    $query = mysqli_query($conn, "INSERT INTO pengaturan VALUES ('','$judul','$info','$tarif')");
    header("location:../index.php?page=8");
}
