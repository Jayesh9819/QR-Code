
<!DOCTYPE html>
<html lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Add Student</title>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
        <style>
            * {
            margin: 0px;
            padding: 0px;
            box-sizing: border-box;
        }
            form {
            width: 300px;
            border: 1px solid;
            margin: auto;
            margin-top: 30px;
            padding: 3%;
            border-radius: 5px;
        }

        label {
            font-size: large;
            padding: 3px;
        }

        input {
            width: 94%;
            padding: 5px;
        }

        button {
            padding: 5px 8px;
            margin-top: 4px;
            font-weight: bold;
        }

        </style>
    </head>
    <body>
        <div class="col-md-3">
        </div>
        <div class="col-md-6">
            <?php 
            if(isset($_GET['by'])){
                $by =$_GET['by'];
            }
            
            ?>
        <form action="qrcode.php"  method="POST" role="form">
                <label for="Fname">Name </label>
                <input type="text" name="Name" placeholder="Your Name">
                <label for="Mname">Designation</label>
                <input type="text" name="Designation"  placeholder="Designation">
                <label for="Lname">Name of Company</label>
                <input type="text" name="NOC" placeholder="">
                <label for="Lname">Address of Company</label>
                <input type="text" name="Address" placeholder="">
                <label for="Lname">Phone</label>
                <input type="text" name="Phone" placeholder="Surname">
                <!-- <label for="Lname">by</label> -->
                <?php
                if(isset($by)){
                   echo '<input hidden type="text" name="by" placeholder="Surname" value="' .$by.'">';

                }
                
                ?>
                <label for="Lname">Email</label>

                <input type="text" name="Email" placeholder="Surname">
                <button onclick="submit()">Submit</button>
                            
        </form>
        </div>
        <a href="admin.php">Admin Login</a>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </body>
</html>
