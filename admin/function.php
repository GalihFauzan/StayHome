<?php
include "../assets/conn/koneksi.php"; // Menghubungkan ke database

// Fungsi untuk menghasilkan invoice
function generateInvoices($conn)
{
    $today = date('Y-m-d');
    $query = mysqli_query($conn, "SELECT user.id_user, user.tgl_sewa, biaya.tarif, biaya.ket 
                                  FROM user 
                                  INNER JOIN biaya ON user.id_bayar = biaya.id");

    while ($d = mysqli_fetch_assoc($query)) {
        $invoice_id = rand();
        $user_id = $d['id_user'];
        $tarif = $d['tarif'];
        $ket = $d['ket'];

        if ($ket == 'Bulanan') {
            $due_date = date('Y-m-d', strtotime("+1 month", strtotime($d['tgl_sewa'])));
            $interval = "1 MONTH";
        } elseif ($ket == 'Harian') {
            $due_date = date('Y-m-d', strtotime("+1 day", strtotime($d['tgl_sewa'])));
            $interval = "1 DAY";
        }

        // Periksa apakah invoice sudah ada
        $check_invoice = mysqli_query($conn, "SELECT * FROM invoice 
                                              WHERE id_user = '$user_id' 
                                              AND tanggal_invoice = '$due_date'");

        if (mysqli_num_rows($check_invoice) == 0) {
            // Membuat invoice baru
            $insert_invoice = mysqli_query($conn, "INSERT INTO invoice (id_invoice,id_user, tanggal_invoice, jumlah_invoice, status) 
                                                   VALUES ('$invoice_id','$user_id', '$due_date', '$tarif', 'Belum Dibayar')");
        }
    }
}

// Panggil fungsi untuk menghasilkan invoice
generateInvoices($conn);
