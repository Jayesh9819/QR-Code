<?php
include("config.php");
session_start();

if (isset($_SESSION['user_name'])) {
    echo '<!DOCTYPE html>
          <html lang="en">
          <head>
              <meta charset="UTF-8">
              <meta name="viewport" content="width=device-width, initial-scale=1.0">
              <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

              <!-- DataTables CSS -->
              <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

              <!-- Select2 CSS -->
              <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

              <title>Admin Page</title>';
            //   include "./script.php";
              
    echo '</head>
          <body>';
          //include "./script.php";

    echo '<h3>Welcome ' . $_SESSION['user_name'] . '</h3>
          <p><a href="Logout.php">Log Out</a></p>

          <div class="col-md-2"></div>
          <div class="col-md-8">
              <h1>QR Code List</h1><br><br>
              <div id="columnControls"></div>
              <table  class="table table-bordered table-hover" id="data">
                  <thead>
                      <tr>
                          <th>Sr.No</th>
                          <th>Name</th>
                          <th>Designation</th>
                          <th>Name of Company</th>
                          <th>Address of Company</th>
                          <th>Phone</th>
                          <th>Email</th>
                          <th>QR CODE</th>
                          <th>Download QR</th>
                      </tr>
                  </thead>
                  <tbody>';

    switch ($_SESSION['type']) {
        case 'admin':
            $query = "SELECT * FROM registration";
            break;
        case 'registrationdesk':
            $pcid = $_SESSION['no'];
            $query = "SELECT * FROM registration WHERE pcid = $pcid";
            break;
        default:
            exit("Invalid session data");
    }

    if ($result = $mysqli->query($query)) {
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_object()) {
                echo '<tr>
                          <td>' . $row->Id . '</td>
                          <td>' . $row->Name . '</td>
                          <td>' . $row->Designation . '</td>
                          <td>' . $row->NOC . '</td>
                          <td>' . $row->AOC . '</td>
                          <td>' . $row->Phone . '</td>
                          <td>' . $row->Email . '</td>
                          <td><img src="' . $row->OR . '" width="50px" height="50px"></td>
                          <td><a href="Try.php">Download QR</a></td>
                      </tr>';
            }
        }
    }

    echo '</tbody>
          </table>
      </div>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
      <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
      <script>
          $(document).ready(function() {
              // Initialize DataTable
              var table = $("#data").DataTable({
                  dom: "Bfrtip", // Controls position: B = Buttons, f = Filtering input, r = Processing display element, t = The table, i = Information summary
                  buttons: [
                      {
                          extend: "colvis",
                          postfixButtons: ["colvisRestore"],
                          collectionLayout: "fixed two-column"
                      }
                  ]
              });

              // Add the controls to the desired location
              table.buttons().container().appendTo($("#columnControls"));
          });
      </script>
      </body>
      </html>';
} else {
    header("location: Login.php");
    exit;
}
?>
