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

// Define the custom page size (in millimeters)
$pageWidth = 160; // 3 times A4 width
$pageHeight = 240  ; // 2 times A4 height

// Create TCPDF instance with custom page size
$pdf = new TCPDF('P', 'mm', array($pageWidth, $pageHeight), true, 'UTF-8', false);

$pdf->SetCreator('JD');
$pdf->SetAuthor('CS');
$pdf->SetTitle('ID Card');
$pdf->AddPage();

$pdf->SetFont('helvetica', 'B', 14);
$pdf->SetTextColor(0, 0, 128);

// Add background image
$pdf->Image('./image/bg1.png', 0, 0, 160, 240, '', '', '', false, 300, '', false, false, 0);

// Add QR code
$pdf->Image($data['OR'], 50, 50, 50, 50, 'png');

// Set position for name and number
$namePosition = 50;
$numberPosition = 50;

// Output data on the PDF
$pdf->SetXY($namePosition, 110);
$pdf->Cell(0, 10, 'Name:     ' . $data['Name'], 0, 1);

$pdf->SetXY($numberPosition, 117);
$pdf->Cell(0, 10, 'Number:   ' . $data['Phone'], 0, 1);

// Output the PDF to the browser
$pdf->Output('id_card_' . $id . '.pdf', 'I');
?>
