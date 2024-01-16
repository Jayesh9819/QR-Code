<?php
session_start();
include("config.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = $_POST['Email'];
    $password = $_POST['Password'];
    echo $password;

    if (empty($email) || empty($password) || is_numeric($email)) {
        echo "<script>alert('Invalid Input');</script>";
        exit;
    }

    $query = "SELECT * FROM admin WHERE Email = ? LIMIT 1";
    $stmt = mysqli_prepare($mysqli, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        if ($result && $user_data = mysqli_fetch_assoc($result)) {
            if ($user_data['Password'] === $password) {
                echo $user_data['Password'];
                $_SESSION['user_name'] = $user_data['Fname'];
                $_SESSION['type'] = $user_data['type'];
                $_SESSION['no'] = $user_data['no'];
                $_SESSION['User_id'] = $user_data['id'];
                $type = $_SESSION['type'];

                switch ($type) {
                    case 'vendor':
                        header("location: vender.php");
                        break;
                    default:
                        header("location: admin.php");
                        exit;
                }




                header("location: admin.php");
                exit;
            } else {
                header("location: ?err=wr");
            }
        } else {
            header("location: ?err=user");
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "<script>alert('Error in preparing statement');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Try.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Login In</title>
</head>

<body>
    <div class="main">
        <h2>Login In</h2>
        <?php
        if (isset($_GET['err'])) {
            $err = $_GET['err'];
            if ($err == 'wr') {
                echo '      <div class="alert alert-danger" role="alert">
                Wrong Email or Password
              </div>
              
              ';
            } elseif ($err == 'user') {
                echo '      <div class="alert alert-danger" role="alert">Wrong Email 
              </div>
              ';
            }
        }
        ?>
        <form method="POST">
            <label for="Email">Email</label>
            <input type="text" name="Email" required>
            <label for="Password">Password</label>
            <input type="password" name="Password" required>
            <input type="submit" value="LOGIN IN">
        </form>
        <p>Not have an Account <a href="registerall.php">Sign Up</a></p>
    </div>
</body>

</html>
