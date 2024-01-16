<!-- index.php -->
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scan Data</title>
</head>
<body>
    <h1>Scan Data</h1>

   <a href="./qrscan.php"> <button>Scan</button></a>

    <table border="1">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Mobile Number</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['Fname'] . "</td>";
                echo "<td>" . $row['Email'] . "</td>";
                echo "<td>" . $row['Phone'] . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>

    <script>
        function scanData() {
            // Add your scanning logic here
            alert("Scanning data...");
        }
    </script>
</body>
</html>
