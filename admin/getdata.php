<?php
include "../assets/conn/koneksi.php";

$range = isset($_GET['range']) ? $_GET['range'] : 'month';

switch ($range) {
    case 'day':
        $query = "
            SELECT 
                DATE_FORMAT(tanggal_pembayaran, '%Y-%m-%d') AS periode, 
                SUM(jumlah_pembayaran) AS total
            FROM pembayaran
            GROUP BY periode
            ORDER BY periode
        ";
        break;
    case 'week':
        $query = "
            SELECT 
                DATE_FORMAT(tanggal_pembayaran, '%Y-%u') AS periode, 
                SUM(jumlah_pembayaran) AS total
            FROM pembayaran
            GROUP BY periode
            ORDER BY periode
        ";
        break;
    case 'year':
        $query = "
            SELECT 
                DATE_FORMAT(tanggal_pembayaran, '%Y') AS periode, 
                SUM(jumlah_pembayaran) AS total
            FROM pembayaran
            GROUP BY periode
            ORDER BY periode
        ";
        break;
    case 'month':
    default:
        $query = "
            SELECT 
                DATE_FORMAT(tanggal_pembayaran, '%Y-%m') AS periode, 
                SUM(jumlah_pembayaran) AS total
            FROM pembayaran
            GROUP BY periode
            ORDER BY periode
        ";
        break;
}

$result = mysqli_query($conn, $query);

$labels = [];
$data = [];

while ($row = mysqli_fetch_assoc($result)) {
    $labels[] = $row['periode'];
    $data[] = $row['total'];
}

// Menutup koneksi database
mysqli_close($conn);

// Mengirim data sebagai JSON
header('Content-Type: application/json');
echo json_encode(['labels' => $labels, 'data' => $data]);
