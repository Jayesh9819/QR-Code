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

$pdf->Image($data['OR'], 50, 10, 80, 80, 'png');
$pdf->Cell(0, 10, 'Name: ' . $data['Name'], 0, 1);
$pdf->Cell(0, 10, 'Number: ' . $data['Phone'], 0, 1);

// Add image (assuming $data['qr_code_path'] is the path to the QR code image)
$id=$data['UniqueID'];
// Output the PDF to the browser
$pdf->Output('id_card_' . $id . '.pdf', 'I');
?>
