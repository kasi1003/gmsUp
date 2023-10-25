<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/companyPage.css" />


  <title>Heavenly Tomb | AVBOB</title>
</head>

<body>
  <!--navbar-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="../html/index.html">Home</a>

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
          <a class="nav-link" href="../php/quotation.php">Quotation Feedback</a>
        </li>
    
      </ul>
    </div>
  </nav>

  <!--first section-->
  <section class="funeral-services">
    <div class="card border-secondary text-white mb-3 w-75 mx-auto m-5 custom-card">
      <div class="card-header border-secondary w-100">
        <?php
        // Get the service_provider_name from the query parameter
        $serviceProviderName = $_GET['service_provider_name'];
        // Use htmlspecialchars to prevent cross-site scripting (XSS) attacks
        $serviceProviderName = htmlspecialchars($serviceProviderName, ENT_QUOTES, 'UTF-8');
        ?>
        <div style="display: flex; justify-content: center;align-items: center;">
          <div class="img-container">
            <!-- Add your image here -->
            <img src="your-image-source.jpg" alt="img">
          </div>
          <h1
            style="display: flex; align-items: center; color: white; margin-top: 0.5em; font-size: 4rem; margin-left: 0.2em;">
            <?php echo $serviceProviderName; ?>
          </h1>
        </div>
      </div>

      <div class="card-body">
        <div style="display: flex; justify-content: center;">
          <div class="accordion w-75 m-4" id="accordionPanelsStayOpenExample">
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "htdb";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
            }


            // Fetch company details
            $companyQuery = "SELECT company_motto FROM service_providers WHERE service_provider_name = '$companyName'";
            $companyResult = $conn->query($companyQuery);
            $companyData = $companyResult->fetch_assoc();

            // Fetch the company motto
            $companyMotto = $companyData['company_motto'];
            ?>
            <div class="accordion-item">
              <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                <button class="accordion-button bg-dark" type="button" data-bs-toggle="collapse"
                  data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true"
                  aria-controls="panelsStayOpen-collapseOne">
                  <h4 class="company-motto-text">Company Motto</h4>
                </button>
              </h2>
              <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show"
                aria-labelledby="panelsStayOpen-headingOne">
                <div class="accordion-body">
                  <h6 class="motto-description">

                    <?php echo $companyMotto; ?>
                  </h6>
                </div>

              </div>
            </div>

          </div>
        </div>
        <h2 style="display: flex; justify-content: center; color: white;">Funeral Services Offered</h2>
        <div style="display: flex; justify-content: center; width: 100%;">
        <div class="card w-100 border-secondary mx-auto custom-card-1">
          <div class="card-body">
          <?php

          $companyName = $_GET['service_provider_name'];

// Fetch company details based on the company name
          $sql = "SELECT id FROM service_providers WHERE service_provider_name = '$companyName'";
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $companyId = $row['id'];

            // Fetch associated services
            $servicesQuery = "SELECT service_name, service_description FROM services WHERE provider_id = $companyId";
            $servicesResult = $conn->query($servicesQuery);

            $index = 1;
            echo '<div class="row">';
            while ($service = $servicesResult->fetch_assoc()) {
              $accordionID = 'collapse' . $index;

              if (($index - 1) % 3 == 0) {
                // Start a new row for every 3 cards
                echo '</div><div class="row">';
              }
            ?>
          <div class="col-md-4">
            <div class="card bg-dark border-secondary">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $service['service_name']; ?></h5>
                    <p class="card-text"><?php echo $service['service_description']; ?></p>
                    <button type="button" class="btn btn-primary">Read More</button>

                </div>
            </div>
          </div>
          <?php
          $index++;
            }
          echo '</div>';
          } else {
          // Handle the case where the company name is not found
            echo "Company not found";
          }
          ?>

    
          </div>
        </div>
        

          <?php
          $conn->close();
          ?>
        </div>
      </div>
    </div>



  </section>

  <!--review section-->


  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
    integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
    integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
    crossorigin="anonymous"></script>
  <script src="../js/companyPage.js"></script>
</body>

</html>

<?php
$db_host = "localhost";
$db_username = "root";
$db_password = "";
$db_table = "htdb";

$conn = new mysqli($db_host, $db_username, $db_password, $db_table);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["submit-rev"])) {
  // Form has been submitted, retrieve form data
  $name = $_POST["recipient-name"];
  $review = $_POST["message-text"];

  // Insert the data into the database
  $sql = "INSERT INTO reviews (name, review) VALUES ('$name', '$review')";
  if ($conn->query($sql) === TRUE) {
    // Redirect to avoid form resubmission on refresh
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}

$conn->close();
?>