<?php
include "../../assets/conn/koneksi.php";

$id = $_GET['id'];
$query = mysqli_query($conn, "DELETE FROM biaya WHERE id='$id'");
header("location:../index.php?page=10");
