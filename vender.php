<?php
include "config.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the QR code data from the AJAX request
    $qrCodeData = $_POST['qrCode'];
    $sql="INSERT INTO QR";

    echo $qrCodeData;

    echo "Received QR Code Data: $qrCodeData";
} else {
    http_response_code(400);
    echo "Invalid request method";
}
?>
