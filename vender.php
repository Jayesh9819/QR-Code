<!-- index.php -->
<?php
include 'config.php';

$user_id = $_SESSION['user_id'];

// Fetch data from the qr_scanned table for the logged-in vendor
$query = "SELECT * FROM registration
JOIN qr_scanned ON qr_scanned.user_id = registration.UniqueID
WHERE qr_scanned.vender_id = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
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