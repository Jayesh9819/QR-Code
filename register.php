<?php
include("config.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Retrieve form data
    $fname = $_POST['Fname'];
    $lname = $_POST['Lname'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $designation = $_POST['designation'];
    $deskNumber = ($designation == 'registrationdesk') ? $_POST['deskNumber'] : null;

    // Basic validation
    if (empty($fname) || empty($mobile) || empty($email) || empty($password) || empty($designation)) {
        echo "<script>alert('Please fill in all required fields');</script>";
        exit;
    }

    // Additional validation (you may add more validation as needed)
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Invalid email address');</script>";
        exit;
    }

    // Prepare and execute the SQL query using prepared statements
    $query = "INSERT INTO admin (Fname, Lname, Phone, Email, Password, type, no) 
              VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($mysqli, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sssssss", $fname, $lname, $mobile, $email, $password, $designation, $deskNumber);
        mysqli_stmt_execute($stmt);

        if (mysqli_stmt_affected_rows($stmt) > 0) {
            echo "<script>alert('Registration successful');</script>";
            header("location: Login.php");
            exit;
        } else {
            echo "<script>alert('Error in registration');</script>";
            exit;
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "<script>alert('Error in preparing statement');</script>";
        exit;
    }
} else {
    // If the request method is not POST, redirect to the registration form
    header("location: registration_form.php");
    exit;
}
?>
