<?php

include('phpqrcode/qrlib.php');
require_once('config.php');

function generateUniqueId($name) {
    
include "./config.php";
    // Extract the first 3 letters of the name
    $namePrefix = substr(str_replace(' ', '', strtoupper($name)), 0, 3);
    
    // Create a timestamp in the format ddhhmm
    $timestamp = date('dHis', strtotime('+5 hours 30 minutes'));
    
    // Combine timestamp and name prefix to create a unique ID
    $uniqueId = $timestamp . $namePrefix;

    // Check if the generated ID already exists in the database
    $queryCheck = "SELECT * FROM registration WHERE UniqueID = '$uniqueId'";
    $resultCheck = $mysqli->query($queryCheck);

    if ($resultCheck->num_rows === 0) {
        return $uniqueId; // Return the unique ID if it's not found in the database
    } else {
        // If the ID already exists, handle it as needed (throw an exception, etc.)
        throw new Exception("Generated ID already exists in the database");
    }
}

// Getting Values from Form
$Name = $_POST['Name'];
$Designation = $_POST['Designation'];
$NOC = $_POST['NOC'];
$Address = $_POST['Address'];
$Phone = $_POST['Phone'];
$Email = $_POST['Email'];

// Generate a unique ID using the function
try {
    $uniqueId = generateUniqueId($Name);

    // Check uniqueness of email and phone
    $queryCheck = "SELECT * FROM registration WHERE Email = '$Email' OR Phone = '$Phone' OR UniqueID = '$uniqueId'";
    $resultCheck = $mysqli->query($queryCheck);

    if ($resultCheck->num_rows > 0) {
        header('location:index.php?msg=Email, Phone, or ID already exists');
        exit();
    }

    $pname = $uniqueId;
    $path = 'image/';
    $file = $path . $uniqueId . ".png";

    $ecc = 'L';
    $pixel_Size = 10;
    $frame_Size = 10;

    $query = "INSERT INTO registration VALUES('', '$Name', '$Designation', '$NOC', '$Address', '$Phone', '$Email', '$file','','','$uniqueId')";
    if ($mysqli->query($query) === true) {
        Qrcode::png($pname, $file, $ecc, $pixel_Size, $frame_Size);
        header('location:index.php?msg=data added successfully');
    } else {
        throw new Exception("Database Error: " . $mysqli->error);
    }
} catch (Exception $e) {
    header('location:index.php?msg=' . $e->getMessage());
}
?>
