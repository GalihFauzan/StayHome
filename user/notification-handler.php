<?php
// Memastikan file Midtrans di-include
namespace Midtrans;

require_once dirname(__FILE__) . '/../assets/midtrans-php-master/Midtrans.php';

Config::$isProduction = false;
Config::$serverKey = 'SB-Mid-server-QKWObO5iQ2xc73Q6TB3mzMDr';

printExampleWarningMessage();

try {
    $notif = new Notification();
} catch (\Exception $e) {
    exit($e->getMessage());
}

$transaction = $notif->transaction_status;
$order_id = $notif->order_id;
$gross_amount = $notif->gross_amount;
$settlement_time = $notif->settlement_time;
$payment_method = $notif->payment_type;  

// Koneksi ke database
include "../assets/conn/koneksi.php";

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($transaction == 'settlement') {
    $status = 'Lunas';
    $tanggal_pembayaran = date("Y-m-d H:i:s", strtotime($settlement_time));
} else if ($transaction == 'pending') {
    $status = 'Pembayaran Pending';
} else if ($transaction == 'deny') {
    $status = 'Pembayaran Gagal';
} else if ($transaction == 'expire') {
    $status = 'Kode Pembayaran Expire';
} else if ($transaction == 'cancel') {
    $status = 'Pembayaran Dibatalkan';
}

// Update status di tabel invoice
$stmt = $conn->prepare("UPDATE invoice SET status=? WHERE id_invoice=?");
$stmt->bind_param("ss", $status, $order_id);

if ($stmt->execute()) {
    // Jika status berhasil di-update, tambahkan data ke tabel pembayaran
    if ($transaction == 'settlement') {
        $stmt_insert = $conn->prepare("INSERT INTO pembayaran (id_invoice, tanggal_pembayaran, jumlah_pembayaran,metode) VALUES (?, ?, ?, ?)");
        $stmt_insert->bind_param("ssss", $order_id, $tanggal_pembayaran, $gross_amount,$payment_method);

        if ($stmt_insert->execute()) {
            echo "Data pembayaran berhasil ditambahkan";
        } else {
            error_log("Error inserting pembayaran: " . $stmt_insert->error);
        }

        $stmt_insert->close();
    }
} else {
    error_log("Error updating invoice: " . $stmt->error);
}

$stmt->close();
$conn->close();

function printExampleWarningMessage()
{
    if ($_SERVER['REQUEST_METHOD'] != 'POST') {
        echo 'Notification-handler tidak dimaksudkan untuk dibuka melalui browser / metode GET HTTP. Ini digunakan untuk menangani notifikasi HTTP POST dari Midtrans / webhook.';
    }
    if (strpos(Config::$serverKey, 'your ') !== false) {
        echo "<code>";
        echo "<h4>Silakan atur server key Anda dari sandbox</h4>";
        echo "Di file: " . __FILE__;
        echo "<br><br>";
        echo htmlspecialchars('Config::$serverKey = \'SB-Mid-server-QKWObO5iQ2xc73Q6TB3mzMDr\';');
        die();
    }
}
?>
