<?php
include "../../assets/conn/koneksi.php";

$id_invoice = $_POST['id'];
$id_user = $_POST['id_user'];
$tanggal_pembayaran = $_POST['tanggal_pembayaran'];
$jumlah_bayar = $_POST['jumlah_pembayaran'];

$foto = $_POST['foto'];


$limit = 10 * 1025 * 1025;
$ekstensi = array('png', 'jpg', 'jpeg', 'gif');

foreach ($_FILES['foto']['name'] as $x => $namafile) {
    $tmp = $_FILES['foto']['tmp_name'][$x];
    $tipe_file = pathinfo($namafile, PATHINFO_EXTENSION);
    $ukuran = $_FILES['foto']['size'][$x];

    if ($ukuran > $limit) {
        echo "<script>alert('Mohon diperhatikan ukuran file yang diunggah terlalu besar.'); window.location.href = '../index.php?page=5';</script>";
    } else {
        if (!in_array($tipe_file, $ekstensi)) {
            echo "<script>alert('Mohon maaf Ekstensi yang diperbolehkan .png | .jpg | .jpeg | .gif'); window.location.href = '../index.php?page=5';</script>";
        } else {
            $tanggal = date('d-m-Y');
            $file_destination = '../../assets/bukti/' . $tanggal . '-' . $namafile;

            if (move_uploaded_file($tmp, $file_destination)) {
                // Update status invoice menjadi Lunas
                $update_invoice = mysqli_query($conn, "UPDATE invoice SET status = 'Lunas' WHERE id_invoice = '$id_invoice'");
                if ($update_invoice) {
                    // Update tanggal sewa di tabel user
                    $update_tgl_sewa = mysqli_query($conn, "UPDATE user SET tgl_sewa = '$tanggal_pembayaran' WHERE id_user = '$id_user'");

                    if ($update_tgl_sewa) {
                        // Insert data pembayaran
                        $insert_pembayaran = mysqli_query($conn, "INSERT INTO pembayaran (id_invoice, tanggal_pembayaran, jumlah_pembayaran,metode,foto) VALUES ('$id_invoice', '$tanggal_pembayaran', '$jumlah_bayar','Cash','$tanggal-$namafile')");

                        if ($insert_pembayaran) {
                            header("Location: ../index.php?page=5");
                            exit;
                        } else {
                            echo "<script>alert('Terjadi kesalahan saat menyimpan data pembayaran!'); window.location.href = '../index.php?page=5';</script>";
                        }
                    } else {
                        echo "<script>alert('Terjadi kesalahan saat memperbarui tanggal sewa!'); window.location.href = '../index.php?page=5';</script>";
                    }
                } else {
                    echo "<script>alert('Terjadi kesalahan saat memperbarui status invoice!'); window.location.href = '../index.php?page=5';</script>";
                }
            } else {
                echo "<script>alert('Mohon maaf data gagal disimpan, silahkan periksa kembali!'); window.location.href = '../index.php?page=5';</script>";
            }
        }
    }
}
