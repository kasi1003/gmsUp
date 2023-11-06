<?php
// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $fullName = $_POST["FullName"];
    $quantity = $_POST["NumberOfGraves"];
    $email = $_POST["Email"];
    $phoneNumber = $_POST["PhoneNumber"];
    $sectionCode = mysqli_real_escape_string($conn, $_GET["sectionCode"]); // Get SectionCode from the URL

    // Calculate total price (you need to implement the calculation)
    $totalPrice = calculateTotalPrice($quantity);

    // Get the current timestamp
    $createdAt = date("Y-m-d H:i:s");

    // Database connection (modify as needed)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "htdb";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Calculate the timestamp 5 seconds ago
    $timestampToDelete = date("Y-m-d H:i:s", strtotime("-5 seconds"));

    // Delete rows older than the specified timestamp
    $deleteSql = "DELETE FROM quotations WHERE created_at < '$timestampToDelete'";
    if ($conn->query($deleteSql) === TRUE) {
        echo "Deleted old rows successfully";
    } else {
        echo "Error: " . $deleteSql . "<br>" . $conn->error;
    }

    // Query the database to get the current AvailableGraves for the section
    $sql = "SELECT AvailableGraves FROM grave_sections WHERE SectionCode = '$sectionCode'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $availableGraves = intval($row["AvailableGraves"]);

        if ($availableGraves >= $quantity) {
            // Calculate the new available graves after the subtraction
            $newAvailableGraves = $availableGraves - $quantity;

            // Update the available graves in the database
            $updateSql = "UPDATE grave_sections SET AvailableGraves = $newAvailableGraves WHERE SectionCode = '$sectionCode'";
            if ($conn->query($updateSql) === TRUE) {
                echo "Successfully updated available graves.";
            } else {
                echo "Error updating available graves: " . $conn->error;
            }
        } else {
            echo "Not enough available graves in this section.";
        }
    } else {
        echo "Section not found in the database.";
    }

    // Insert data into the SQL table
    $insertSql = "INSERT INTO quotations (FullName, Quantity, TotalPrice, Email, PhoneNumber, created_at)
            VALUES ('$fullName', $quantity, $totalPrice, '$email', '$phoneNumber', '$createdAt')";

    if ($conn->query($insertSql) === TRUE) {
        echo "Data inserted successfully";
    } else {
        echo "Error: " . $insertSql . "<br>" . $conn->error;
    }

    $conn->close();
}

// Function to calculate total price (implement your logic here)
function calculateTotalPrice($quantity)
{
    // Implement your calculation logic here
    return $quantity * 100; // Adjust as needed
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../css/cemeteriesBooking.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
    integrity="sha512-BPxTfN7eBUceU3W5Fs5IxFh+0ObJmo4Qh/a9x9vN1oQwvEJrhzMQ8biJrbUlf7nWhHr58Hh6gPuGvz6ARu94Q=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
  <title>Heavenly Tomb|Buy Graves</title>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="index.html">Home</a>

        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            Service Providers
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink" id="serviceProvidersDropdown">
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="cemeteries.html">Buy a Grave</a>
        </li>
        <li class="nav-item-right">
          <a class="nav-link" href="notification.html">Notification</a>
        </li>

      </ul>
    </div>
  </nav>


  <section class="grave-booking-landing">
    <div class="card text-white bg-dark mb-3 border-secondary" style="max-width: 90%">
      <div class="card-header border-secondary" style="font-size: 2em">
        Quotation For Graves
      </div>
      <div class="card-body">
        <div class="wrapper">
        <form action="../php/cemeteriesBooking.php" method="POST" id="bookingForm">
            <h4>Buyer Details</h4>
            <div class="input-group">
              <div class="input-box">
                <input name="FullName" type="text" placeholder="Full Name" required class="name" />
                <i class="fa fa-user icon"></i>
              </div>
            </div>
            <div class="input-group">
              <div class="input-box">
                <input type="number" placeholder="Phone Number" required class="name" name="PhoneNumber" />
                <i class="fa fa-credit-card icon"></i>
              </div>
            </div>


            <div class="input-group">
              <div class="input-box">
                <input type="email" placeholder="Email Adress" required class="name" name="Email" />
                <i class="fa fa-envelope icon"></i>
              </div>
            </div>

            <h4>Quotaion Details</h4>
            <div class="input-group">
              <div class="input-box">
                <input id="graveNum" type="number" oninput="calculateTotal()" placeholder="Numer of Graves" required
                  class="name" name="NumberOfGraves" />
                <i class="fa fa-user icon"></i>
              </div>
            </div>



            <div class="input-group">
              <div class="input-box">
                <button id="checkoutBtn" type="submit" class="btn btn-primary" data-toggle="modal"
                  data-target="#exampleModal">
                  PAY NOW
                </button>
              </div>
            </div>
          </form>
        </div>
        <!--end of form-->



        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
          aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content bg-dark border-secondary">
              <div class="modal-header border-secondary">
                <h5 class="modal-title" id="exampleModalLabel">
                  Payment in Process
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body ">
                Payment is in Progress. Go to local authorities to buy and get your graves in 48 hours, else quotation gets canceled. In the meantime, you can find a Service Provider.
              </div>
              <div class="modal-footer border-secondary">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                  Close
                </button>
                <button type="button" class="btn btn-primary">
                  <a href="../php/serviceProvidersPage..html" style="color:white;">Find Service Provider</a>
                </button>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>
  <script>
    function clearForm() {
      // Get the form element by its id
      var form = document.getElementById('bookingForm');

      // Reset the form to clear the input fields
      form.reset();
    }

    // Delay the clearForm function for 5 seconds (5000 milliseconds)
    setTimeout(clearForm, 5000);
  </script>


  <script src="../js/cemeteriesBooking.js"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
    crossorigin="anonymous"></script>
</body>

</html>