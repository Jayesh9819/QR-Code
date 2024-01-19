<?php
// Include TCPDF
require_once('library/tcpdf.php');
include "./config.php";

// Get the ID from the URI
$id = isset($_GET['id']) ? $_GET['id'] : 0;

// Fetch data from the database
$query = "SELECT * FROM registration WHERE id = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param('i', $id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();
$pdf = new TCPDF();
$pdf->SetCreator('JD');
$pdf->SetAuthor('CS');
$pdf->SetTitle('ID Card');
$pdf->AddPage();
$pdf->SetFont('helvetica', 'B', 14);
$pdf->SetTextColor(255, 0, 0); // Set text color to red

// Add background image
$pdf->Image('./image/BG.png', 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);

// Add QR code
$pdf->Image($data['OR'], 50, 10, 100, 100, 'png');

// Set position for name and number
$namePosition = 50;
$numberPosition = 100;

// Output data on the PDF
$pdf->SetXY($namePosition, 90);
$pdf->Cell(0, 10, 'Name: ' . $data['Name'], 0, 1);

$pdf->SetXY($numberPosition, 100);
$pdf->Cell(0, 10, 'Number: ' . $data['Phone'], 0, 1);

// Output the PDF to the browser
$pdf->Output('id_card_' . $id . '.pdf', 'I');
?>
