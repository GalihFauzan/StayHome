<?php
include "../../assets/conn/koneksi.php";

$kamar      = $_POST['kamar'];

$query = mysqli_query($conn, "INSERT INTO kamar VALUES ('','$kamar')");
header("location:../index.php?page=10");
