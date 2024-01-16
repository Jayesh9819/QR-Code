<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <title>Registration Form</title>
    <style>
        body {
            padding: 20px;
        }

        form {
            max-width: 600px;
            margin: 0 auto;
        }

        #registrationDeskNumber {
            display: none;
        }
    </style>
</head>
<body>
    <h2 class="text-center">Registration Form</h2>
    <form method="POST" action="register.php" class="form-horizontal">
        <div class="form-group">
            <label for="name" class="col-sm-3 control-label">First Name:</label>
            <div class="col-sm-9">
                <input type="text" name="Fname" class="form-control" required>
            </div>
        </div>
        <div class="form-group">
            <label for="name" class="col-sm-3 control-label">Last Name:</label>
            <div class="col-sm-9">
                <input type="text" name="Lname" class="form-control" required>
            </div>
        </div>


        <div class="form-group">
            <label for="mobile" class="col-sm-3 control-label">Mobile:</label>
            <div class="col-sm-9">
                <input type="text" name="mobile" class="form-control" required>
            </div>
        </div>

        <div class="form-group">
            <label for="email" class="col-sm-3 control-label">Email:</label>
            <div class="col-sm-9">
                <input type="email" name="email" class="form-control" required>
            </div>
        </div>

        <div class="form-group">
            <label for="password" class="col-sm-3 control-label">Password:</label>
            <div class="col-sm-9">
                <input type="password" name="password" class="form-control" required>
            </div>
        </div>

        <div class="form-group">
            <label for="designation" class="col-sm-3 control-label">Designation:</label>
            <div class="col-sm-9">
                <select name="designation" id="designation" class="form-control" required>
                    <option value="admin">Admin</option>
                    <option value="registrationdesk">Registration Desk</option>
                    <option value="vendor">Vendor Desk</option>

                </select>
            </div>
        </div>

        <div id="registrationDeskNumber" class="form-group">
            <label for="deskNumber" class="col-sm-3 control-label">Desk Number:</label>
            <div class="col-sm-9">
                <input type="text" name="deskNumber" class="form-control">
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-9">
                <button type="submit" class="btn btn-primary">Register</button>
            </div>
        </div>
    </form>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#designation').change(function () {
                var registrationDeskNumberField = $('#registrationDeskNumber');
                registrationDeskNumberField.toggle($(this).val() === 'registrationdesk');
            });
        });
    </script>
</body>
</html>
