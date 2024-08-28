<?php
include "../../assets/conn/koneksi.php";

$id_user = $_GET['id_user'];
$query = mysqli_query($conn, "DELETE FROM user WHERE id_user='$id_user'");
header("location:../index.php?page=1");
