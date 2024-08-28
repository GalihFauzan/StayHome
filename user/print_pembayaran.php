<?php
require('../assets/fpdf/fpdf.php');
include "../assets/conn/koneksi.php";

class PDF extends FPDF
{
    function Header()
    {
        // Logo
        $this->Image('../assets/images/logo.png', 10, 6, 30);
        // Arial bold 15
        $this->SetFont('Arial', 'B', 15);
        // Title
        $this->Cell(190, 10, 'Nota Pembayaran', 0, 1, 'C');
        // Line break
        $this->Ln(20);
    }

    function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }

    function InvoiceTable($data)
    {
        // Table header
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(10, 10, 'No', 1);
        $this->Cell(35, 10, 'Tgl Invoice', 1);
        $this->Cell(35, 10, 'Tgl Pembayaran', 1);
        $this->Cell(40, 10, 'Nama Penyewa', 1);
        $this->Cell(25, 10, 'Kamar', 1);
        $this->Cell(45, 10, 'Jumlah Pembayaran', 1);
        $this->Ln();

        // Data
        $this->SetFont('Arial', '', 12);
        $no = 1;
        foreach ($data as $row) {
            $this->Cell(10, 10, $no++, 1);
            $this->Cell(35, 10, $row['tanggal_invoice'], 1);
            $this->Cell(35, 10, $row['tanggal_pembayaran'], 1);
            $this->Cell(40, 10, $row['nama_user'], 1);
            $this->Cell(25, 10, $row['kamar'], 1);
            $this->Cell(45, 10, number_format($row['jumlah_pembayaran'], 0, ',', '.'), 1);
            $this->Ln();
        }
    }
}

// Fetch data from the database
$query = mysqli_query($conn, "SELECT user.nama_user, kamar.kamar, invoice.tanggal_invoice, pembayaran.tanggal_pembayaran, pembayaran.jumlah_pembayaran 
                              FROM user 
                              INNER JOIN kamar ON user.id_kamar=kamar.id_kamar 
                              INNER JOIN invoice ON invoice.id_user=user.id_user 
                              INNER JOIN pembayaran ON pembayaran.id_invoice=invoice.id_invoice 
                              WHERE invoice.status='Lunas'");

$data = [];
while ($row = mysqli_fetch_assoc($query)) {
    $data[] = $row;
}

// Create PDF
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->InvoiceTable($data);
$pdf->Output();
