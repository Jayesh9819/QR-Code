<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the QR code data from the AJAX request
    $qrCodeData = $_POST['qrCode'];
    $venderid=$_SESSION['id'];
    $sql="INSERT into qr_scanned VALUES ('',$venderid,$qrCodeData,'')";
    if ($mysqli->query($sql) === true) {
        // Qrcode::png($pname, $file, $ecc, $pixel_Size, $frame_Size);
        header('location:vender.php?msg=data added successfully');

    }
    echo "Received QR Code Data: $qrCodeData";
} else {
    // Handle invalid requests
    http_response_code(400);
    echo "Invalid request method";
}
?>
