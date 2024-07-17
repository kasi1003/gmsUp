<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "htdb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Start a session
session_start();

// Check if the user ID is already set in the session
if (!isset($_SESSION['UserId'])) {
    // If not set, generate a new user ID
    $_SESSION['UserId'] = generateUserId();
}

// Function to generate a unique user ID
function generateUserId() {
    // Use a simple method to generate a unique user ID
    return 'User_' . uniqid(); // Example format: User_randomUniqueId
}

// Function to send email
function sendQuotationEmail($to, $subject, $message, $headers) {
  // Use the mail() function to send email
  return mail($to, $subject, $message, $headers);
}

// Email details
$companyEmail = "company@example.com"; 
$serviceproviderEmail = "CityOFWindhoek@example.com"; 

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['clientEmail'])) {
  $clientEmail = filter_var($_POST['clientEmail'], FILTER_SANITIZE_EMAIL);

  // Prepare the email
  $subject = "Your Quotation";
  $message = "Dear Customer,\n\nPlease find attached your quotation.\n\nBest Regards,\nYour Company";
  $headers = "From: no-reply@yourcompany.com";

  // Send the email to the client
  $clientEmailSent = sendQuotationEmail($clientEmail, $subject, $message, $headers);

  // Send the email to the company
  $companyEmailSent = sendQuotationEmail($companyEmail, $subject, $message, $headers);

  // Send the email to the service provider 
  $serviceproviderEmailSent = sendQuotationEmail($companyEmail, $subject, $message, $headers);

  if ($clientEmailSent && $companyEmailSent && $serviceProviderName) {
      $emailStatus = "Quotation sent to both client and company successfully.";
  } else {
      $emailStatus = "Failed to send quotation. Please try again.";
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
  <link rel="stylesheet" href="../css/quote.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-BPxTfN7eBUceU3W5Fs5IxFh+0ObJmo4Qh/a9x9JvN1oQwvEJrhzMQ8biJrbUlf7nWhHr58Hh6gPuGvz6ARu94Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="index.html">Home</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="service-providers-page.html" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Service Providers
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="avbobPage.html">AVBOB</a>
            <a class="dropdown-item" href="service-providers-page.html">View More</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="cemeteries.html">Buy a Grave</a>
        </li>
      </ul>
      <?php
        if (isset($emailStatus)) {
            echo '<p class="ml-auto text-white">' . $emailStatus . '</p>';
        }
      ?>
    </div>
  </nav>
  <!--home landing page-->
  <section class="topSection">
    <div class="card border-secondary bg-dark m-5 h-100" style="width: 85%;">
      <div class="card-header border-secondary">
        <h1 class="service-providers-header-text"></h1>
        <p class="service-providers-subheading">
          Quotation
        </p>
      </div>
      <div class="card-body text-secondary">
        <!-- Display a form to collect the user's email -->
        <form method="POST" action="">
          <div class="form-group">
            <label for="clientEmail">Enter your email address to receive the quotation:</label>
            <input type="email" class="form-control" id="clientEmail" name="clientEmail" required>
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <?php
        if (isset($emailStatus)) {
            echo '<p>' . $emailStatus . '</p>';
        }
        ?>
        <script>
          // Fetch user ID from the session cookie
          var userId = getCookie('PHPSESSID');
          console.log("User ID from session cookie:", userId);

          // Function to get cookie by name
          function getCookie(name) {
            var cookieArr = document.cookie.split(';');
            for (var i = 0; i < cookieArr.length; i++) {
              var cookiePair = cookieArr[i].split('=');
              if (name == cookiePair[0].trim()) {
                return decodeURIComponent(cookiePair[1]);
              }
            }
            return null;
          }

          // Send AJAX request to pdf_quote.php with user ID
          var xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              // Response from pdf_quote.php
              console.log(this.responseText);
            }
          };
          xhttp.open("GET", "pdf_quote.php?user_id=" + userId, true); // Include user ID in the URL
          xhttp.send();
        </script>

        <a href="pdf_quote.php" class="btn btn-primary">Download Quotation</a>
      </div>
    </div>
  </section>

  <div>
    <!-- Footer -->
    <footer class="text-center text-lg-start text-white" style="background-color: #1c2331">
      <!-- Section: Social media -->
      <section class="d-flex justify-content-between p-4" style="background-color: #6351ce">
        <!-- Left -->
        <div class="me-5">
          <span>Get connected with us on social networks:</span>
        </div>
        <!-- Left -->

        <!-- Right -->
        <div>
          <a href="" class="text-white me-4">
            <i class="fab fa-facebook-f"></i>
          </a>
          <a href="" class="text-white me-4">
            <i class="fab fa-twitter"></i>
          </a>
          <a href="" class="text-white me-4">
            <i class="fab fa-google"></i>
          </a>
          <a href="" class="text-white me-4">
            <i class="fab fa-instagram"></i>
          </a>
          <a href="" class="text-white me-4">
            <i class="fab fa-linkedin"></i>
          </a>
          <a href="" class="text-white me-4">
            <i class="fab fa-github"></i>
          </a>
        </div>
        <!-- Right -->
      </section>
      <!-- Section: Social media -->

      <!-- Section: Links  -->
      <section class="">
        <div class="container text-center text-md-start mt-5">
          <!-- Grid row -->
          <div class="row mt-3">
            <!-- Grid column -->
            <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
              <!-- Content -->
              <h6 class="text-uppercase fw-bold">Company name</h6>
              <hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background-color: #7c4dff; height: 2px" />
              <p>
                Here you can use rows and columns to organize your footer content. Lorem ipsum dolor sit amet,
                consectetur adipisicing elit.
              </p>
            </div>
            <!-- Grid column -->

            <!-- Grid column -->
            <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
              <!-- Links -->
              <h6 class="text-uppercase fw-bold">Products</h6>
              <hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background-color: #7c4dff; height: 2px" />
              <p>
                <a href="#!" class="text-white">MDBootstrap</a>
              </p>
              <p>
                <a href="#!" class="text-white">MDWordPress</a>
              </p>
              <p>
                <a href="#!" class="text-white">BrandFlow</a>
              </p>
              <p>
                <a href="#!" class="text-white">Bootstrap Angular</a>
              </p>
            </div>
            <!-- Grid column -->

            <!-- Grid column -->
            <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
              <!-- Links -->
              <h6 class="text-uppercase fw-bold">Useful links</h6>
              <hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background-color: #7c4dff; height: 2px" />
              <p>
                <a href="#!" class="text-white">Your Account</a>
              </p>
              <p>
                <a href="#!" class="text-white">Become an Affiliate</a>
              </p>
              <p>
                <a href="#!" class="text-white">Shipping Rates</a>
              </p>
              <p>
                <a href="#!" class="text-white">Help</a>
              </p>
            </div>
            <!-- Grid column -->

            <!-- Grid column -->
            <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
              <!-- Links -->
              <h6 class="text-uppercase fw-bold">Contact</h6>
              <hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background-color: #7c4dff; height: 2px" />
              <p><i class="fas fa-home mr-3"></i> New York, NY 10012, US</p>
              <p><i class="fas fa-envelope mr-3"></i> info@example.com</p>
              <p><i class="fas fa-phone mr-3"></i> + 01 234 567 88</p>
              <p><i class="fas fa-print mr-3"></i> + 01 234 567 89</p>
            </div>
            <!-- Grid column -->
          </div>
          <!-- Grid row -->
        </div>
      </section>
      <!-- Section: Links  -->

      <!-- Copyright -->
      <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2)">
        © 2023 Copyright:
        <a class="text-white" href="#">MDBootstrap.com</a>
      </div>
      <!-- Copyright -->
    </footer>
    <!-- Footer -->
  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXlBv5PH0v7aLrC8j/uf/Q2SnTNpPLZXF1cwlXOx9Krbc4CF2IMmjF4biFxB" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9QY2Ey/vSfj8JoHnjERQ6BRXr2lE2VXw7DblJu2anrp62+UJeKBYG6g" crossorigin="anonymous"></script>
</body>

</html>
