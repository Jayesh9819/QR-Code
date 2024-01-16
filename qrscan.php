<?php
include "config.php";
session_start();

if (isset($_GET['qrCode'])) {
    // Get the QR code data from the AJAX request
    $qrCodeData = $_GET['qrCode'];
    $venderid = $_SESSION['User_id'];

    // Using a prepared statement to prevent SQL injection
    $sql = "INSERT INTO qr_scanned (vender_id, user_id) VALUES (?, ?)";
    $stmt = $mysqli->prepare($sql);

    // Check if the statement was prepared successfully
    if ($stmt) {
        // Bind parameters and execute the statement
        $stmt->bind_param("is", $venderid, $qrCodeData);
        $stmt->execute();

        // Check if the query was successful
        if ($stmt->affected_rows > 0) {
            // Redirect to another page with a success message
            header('Location: vender.php?msg=data added successfully');
            exit();
        } else {
            // Redirect to another page with an error message
            header('Location: vender.php?msg=error adding data');
            exit();
        }

        // Close the statement
        $stmt->close();
    } else {
        // Redirect to another page with an error message
        header('Location: vender.php?msg=error preparing statement');
        exit();
    }
} else {
    // Handle invalid requests
    http_response_code(400);
    echo "Invalid request method";
}
?>
