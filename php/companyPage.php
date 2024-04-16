<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/companyPage.css" />
  <!-- Bootstrap CSS -->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

  <title>Heavenly Tomb | AVBOB</title>
</head>

<body>
  <!--navbar-->
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
    </div>
  </nav>

  <!--first section-->
  <section class="funeral-services">
    <?php
    // Get the service_provider_name from the query parameter
    $serviceProviderName = $_GET['service_provider_name'];
    // Use htmlspecialchars to prevent cross-site scripting (XSS) attacks
    $serviceProviderName = htmlspecialchars($serviceProviderName, ENT_QUOTES, 'UTF-8');
    ?>
    <h1 style="display: flex; justify-content: center; color: white; margin-top:0.5em; font-size: 5em;"><?php echo $serviceProviderName; ?></h1>
    <?php
    // Step 1: Extract the service provider name from the URL
    $service_provider_name = $_GET['service_provider_name'];

    // Step 2: Retrieve the corresponding Motto and Email column values from the service_providers table
    // Establish a connection to your database (Replace the values with your actual database credentials)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "htdb";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    // Prepare the query to fetch the motto and email
    $sql_info = "SELECT Motto, Email FROM service_providers WHERE name = '$service_provider_name'";

    // Execute the query
    $result_info = $conn->query($sql_info);

    // Check if the query was successful
    if ($result_info->num_rows > 0) {
      // Fetch the result
      $row_info = $result_info->fetch_assoc();
      $motto = $row_info['Motto'];
      $email = $row_info['Email'];

      // Display the company motto and email
      echo '<h2 style="display: flex; justify-content: center; color: white;">' . $motto . '</h2>';
      echo '<h3 style="display: flex; justify-content: center; color: white;">Email: ' . $email . '</h3>';
    } else {
      echo "Motto and Email not found for the provider.";
    }

    // Close the connection
    $conn->close();
    ?>

    <div style="display: flex; justify-content: center;">
      <div class="accordion w-75 m-4" id="accordionPanelsStayOpenExample">
        <div class="accordion-item">
          <h2 class="accordion-header" id="panelsStayOpen-headingOne">
            <!-- Button goes here -->
          </h2>
        </div>
      </div>
    </div>

    <h2 style="display: flex; justify-content: center; color: white;">Services</h2>

    <div class="container">
      <div class="container">
        <div class="row">
          <?php
          // Step 1: Extract the service provider name from the URL
          $service_provider_name = $_GET['service_provider_name'];

          // Step 2: Retrieve the corresponding ID from the service_providers table
          // Establish a connection to your database (Replace the values with your actual database credentials)
          $servername = "localhost";
          $username = "root";
          $password = "";
          $database = "htdb";

          // Create connection
          $conn = new mysqli($servername, $username, $password, $database);

          // Check connection
          if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
          }

          // Prepare the query
          $sql_provider_id = "SELECT id FROM service_providers WHERE Name = '$service_provider_name'";

          // Execute the query
          $result_provider_id = $conn->query($sql_provider_id);

          // Check if the query was successful
          if ($result_provider_id->num_rows > 0) {
            // Fetch the result
            $row_provider_id = $result_provider_id->fetch_assoc();
            $provider_id = $row_provider_id['id'];

            // Step 3: Fetch records from the services table with the same ProviderId
            // Prepare the query
            $sql_services = "SELECT * FROM services WHERE ProviderId = $provider_id";

            // Execute the query
            $result_services = $conn->query($sql_services);

            // Check if there are any records
            if ($result_services->num_rows > 0) {
              // Step 4: Display each fetched record in its own card
              while ($service = $result_services->fetch_assoc()) {
                echo '<div class="col-sm">';
                echo '  <section class="block1">';
                echo '    <div class="card" style="width: 18rem;">';
                echo '      <div class="card-body">';
                echo '        <h5 class="SERVICE">' . $service['ServiceName'] . '</h5>';
                echo '        <p class="card-text">' . $service['Description'] . '</p>';
                echo '        <p class="card-text">Price: ' . $service['Price'] . '</p>'; // Adding Price
                echo '        <a href="#" class="btn btn-primary select-service" data-service-id="' . $service['id'] . '">Select</a>';
                echo '      </div>';
                echo '    </div>';
                echo '  </section>';
                echo '</div>';
              }
            } else {
              echo "No services found for the provider.";
            }
          } else {
            echo "Provider not found.";
          }

          // Close the connection
          $conn->close();
          ?>
        </div>
        <br>
        <div style="text-align: center;">
          <a href="#" class="btn btn-primary" id="confirm-button">Confirm</a>
        </div>
        <br>
      </div>
    </div>
  </section>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      // Select buttons
      const selectButtons = document.querySelectorAll('.select-service');

      // Add click event listeners to select buttons
      selectButtons.forEach(button => {
        button.addEventListener('click', function (event) {
          event.preventDefault();
          // Toggle 'selected' class for the clicked button
          this.classList.toggle('selected');

          // Change button color to green when selected
          if (this.classList.contains('selected')) {
            this.style.backgroundColor = 'green';
          } else {
            this.style.backgroundColor = ''; // Reset to default
          }
        });
      });

      // Confirm button
      const confirmButton = document.getElementById('confirm-button');

      // Add click event listener to confirm button
      confirmButton.addEventListener('click', function (event) {
        event.preventDefault();
        const selectedServices = document.querySelectorAll('.select-service.selected');
        const providerEmail = "<?php echo $email ?? 'simeonalfeus078@gmail.com'; ?>"; // Updated to ensure email comes from simeonalfeus21@gmail.com

        if (providerEmail !== '') {
          const serviceDetails = [];
          selectedServices.forEach(service => {
            const serviceName = service.parentNode.querySelector('.SERVICE').innerText;
            const serviceDescription = service.parentNode.querySelector('.card-text').innerText;
            const servicePrice = service.parentNode.querySelector('.card-text').nextSibling.innerText; // Assuming Price is the next sibling after Description
            serviceDetails.push({
              name: serviceName,
              description: serviceDescription,
              price: servicePrice
            });
          });

          // Send AJAX request to PHP script to send email
          const xhr = new XMLHttpRequest();
          xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
              if (xhr.status === 200) {
                alert('Selection confirmed. Email sent to provider.');
              } else {
                alert('Error occurred while sending email.');
              }
            }
          };
          xhr.open('POST', 'send_email.php', true);
          xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
          xhr.send('email=' + encodeURIComponent(providerEmail) + '&services=' + encodeURIComponent(JSON.stringify(serviceDetails)));
        } else {
          alert('Error: Provider email not found.');
        }
      });
    });
  </script>

  <!--review section-->

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  <script src="../js/companyPage.js"></script>
</body>

</html>
