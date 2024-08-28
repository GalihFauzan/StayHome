<?php
include "../../assets/conn/koneksi.php";

$nama_petugas   = $_POST['nama_petugas'];
$username       = $_POST['username'];
$email          = $_POST['email'];
$telp           = $_POST['telp'];
$pass           = $_POST['password'];
$foto           = $_POST['foto'];


$limit = 10 * 1024 * 1024;
$ekstensi = array('png', 'jpg', 'jpeg', 'gif');

foreach ($_FILES['foto']['name'] as $x => $namafile) {
    $tmp = $_FILES['foto']['tmp_name'][$x];
    $tipe_file = pathinfo($namafile, PATHINFO_EXTENSION);
    $ukuran = $_FILES['foto']['size'][$x];

    if ($ukuran > $limit) {
        echo "<script>alert('Mohon diperhatikan ukuran file yang diunggah terlalu besar.'); window.location.href = '../index.php?page=4';</script>";
    } else {
        if (!in_array($tipe_file, $ekstensi)) {
            echo "<script>alert('Mohon maaf Ekstensi yang diperbolehkan .png | .jpg | .jpeg | .gif'); window.location.href = '../index.php?page=4';</script>";
        } else {
            $tanggal = date('d-m-Y');
            $file_destination = '../../assets/foto/' . $tanggal . '-' . $namafile;

            if (move_uploaded_file($tmp, $file_destination)) {
                $query = "INSERT INTO petugas (id_petugas,nama_petugas,username,email,telp,password,foto) 
                          VALUES ('','$nama_petugas','$username','$email','$telp','$pass', '$tanggal-$namafile')";

                $result = mysqli_query($conn, $query);

                header("location:../index.php?page=4");
            } else {
                echo "<script>alert('Mohon maaf data gagal disimpan, silahkan periksa kembali!'); window.location.href = '../index.php?page=4';</script>";
            }
        }
    }
}
