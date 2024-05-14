<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "htdb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Get form data
  $name = $_POST['name'];
  $review = $_POST['review'];

  // Get the service_provider_name from the URL parameter
  $serviceProviderName = $_GET['service_provider_name'];

  // Query the database to get the id value corresponding to the service_provider_name
  $sql_provider_id = "SELECT id FROM service_providers WHERE Name = '$serviceProviderName'";
  $result_provider_id = $conn->query($sql_provider_id);

  // Check if the query was successful
  if ($result_provider_id->num_rows > 0) {
    // Fetch the result
    $row_provider_id = $result_provider_id->fetch_assoc();
    $provider_id = $row_provider_id['id'];

    // Insert the review into the reviews table
    $sql_insert_review = "INSERT INTO reviews (Name, Review, ProviderId) VALUES ('$name', '$review', $provider_id)";

    if ($conn->query($sql_insert_review) === TRUE) {
      echo "Review added successfully!";
    } else {
      echo "Error: " . $sql_insert_review . "<br>" . $conn->error;
    }
  } else {
    echo "Provider not found.";
  }
  // Assuming you have the service provider name stored in a variable called $serviceProviderName
  $encodedServiceProviderName = rawurlencode($serviceProviderName);
  // Redirect to the companyPage.php with the encoded service provider name
  header("Location: ../php/companyPage.php?service_provider_name=" . $encodedServiceProviderName);
  exit(); // Ensure that no further code is executed

}
?>
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
  <?php
  include '../components/header.php'; // or include_once if you want to ensure it's included only once
  ?>

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
          session_start();
          // Step 1: Extract the service provider name from the URL
          $service_provider_name = $_GET['service_provider_name'];
          // Step 2: Retrieve the UserId from the session or generate a new one if not available
          // Step 1: Retrieve the UserId from the session
          if (isset($_SESSION['UserId'])) {
            $user_id = $_SESSION['UserId'];
          } else {
            // Set UserId to PHPSESSID
            $_SESSION['UserId'] = session_id();

            // Now $_SESSION['UserId'] holds the same value as PHPSESSID

            // Function to generate a unique user ID
            function generateUserId()
            {
              // Use a simple method to generate a unique user ID
              return 'User_' . uniqid(); // Example format: User_randomUniqueId
            }
          }
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

          // Check if the request is a POST request (for updating ordered_services)
          if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['service_id']) && isset($_POST['selected'])) {
            $serviceId = $_POST['service_id'];
            $selected = $_POST['selected'];

            if ($selected == '1') {
              // Check if the record already exists in ordered_services
              $sql_check_existence = "SELECT * FROM ordered_services WHERE ServiceId = $serviceId AND UserId = '$user_id'";
              $result_check_existence = $conn->query($sql_check_existence);
              if ($result_check_existence->num_rows == 0) {
                // If the record does not exist, insert it into the ordered_services table
                $sql_insert = "INSERT INTO ordered_services (ServiceId, UserId) VALUES ($serviceId, '$user_id')";
                if ($conn->query($sql_insert) === TRUE) {
                  echo "Service with ID $serviceId added to ordered_services.";
                } else {
                  echo "Error adding service to ordered_services: " . $conn->error;
                }
              }
            } else {
              // If the button is toggled off, delete the record from the ordered_services table
              $sql_delete = "DELETE FROM ordered_services WHERE ServiceId = $serviceId AND UserId = '$user_id'";
              if ($conn->query($sql_delete) === TRUE) {
                echo "Service with ID $serviceId removed from ordered_services.";
              } else {
                echo "Error removing service from ordered_services: " . $conn->error;
              }
            }
          } else {
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
          }
          // Close the connection
          $conn->close();
          ?>
          <script>
            document.addEventListener('DOMContentLoaded', function() {
              // Add event listeners to all select-service buttons
              var selectServiceButtons = document.querySelectorAll('.select-service');
              selectServiceButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                  var serviceId = button.dataset.serviceId;
                  var selected = !button.classList.contains('selected'); // Toggle the selected state
                  updateOrderedServices(serviceId, selected);
                });
              });

              function updateOrderedServices(serviceId, selected) {
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                  if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                      console.log(xhr.responseText);
                      // Update the button's appearance based on the selected state
                      var button = document.querySelector('[data-service-id="' + serviceId + '"]');
                      if (selected) {
                        button.classList.add('selected');
                      } else {
                        button.classList.remove('selected');
                      }
                    } else {
                      console.error('Error:', xhr.status);
                    }
                  }
                };
                xhr.open('POST', '<?php echo $_SERVER["PHP_SELF"]; ?>', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.send('service_id=' + serviceId + '&selected=' + (selected ? '1' : '0'));
              }
            });
          </script>
        </div>
        <br>
        <div style="text-align: center;">
          <a href="#" class="btn btn-primary" id="confirm-button">Confirm</a>
          <a href="pdf_quote.php" class="btn btn-primary" id="confirm-button">View Quotation</a>

        </div>
        <br>
      </div>
    </div>
  </section>
  <section class="funeral-services">

    <h2 style="display: flex; justify-content: center; color: white;">Services</h2>
    <div id="carouselExampleControls" class="carousel carousel-dark slide" data-bs-ride="carousel">
      <div class="carousel-inner">
        <?php
        // Your PHP code for fetching reviews
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

        // Step 1: Get the service_provider_name from the URL parameter
        $serviceProviderName = $_GET['service_provider_name'];

        // Step 2: Query the database to get the id value corresponding to the service_provider_name
        $sql_provider_id = "SELECT id FROM service_providers WHERE Name = '$serviceProviderName'";
        $result_provider_id = $conn->query($sql_provider_id);

        // Check if the query was successful
        if ($result_provider_id->num_rows > 0) {
          // Fetch the result
          $row_provider_id = $result_provider_id->fetch_assoc();
          $provider_id = $row_provider_id['id'];

          // Step 3: Fetch records from the reviews table with the same ProviderId
          // Prepare the query
          $sql_reviews = "SELECT Name, Review FROM reviews WHERE ProviderId = $provider_id";

          // Execute the query
          $result_reviews = $conn->query($sql_reviews);

          // Check if there are any records
          if ($result_reviews->num_rows > 0) {
            // Display each fetched record in groups of three
            $reviews = $result_reviews->fetch_all(MYSQLI_ASSOC);
            $chunks = array_chunk($reviews, 3); // Split reviews into chunks of three

            // Loop through each chunk
            $active = true; // Variable to track the active carousel item
            foreach ($chunks as $chunk) {
              // Start carousel item
              echo '<div class="carousel-item ';
              if ($active) {
                echo 'active'; // Set the first item as active
                $active = false; // Set active to false for subsequent items
              }
              echo '">';

              // Start card wrapper
              echo '<div class="card-wrapper container-sm d-flex justify-content-around">';

              // Loop through reviews in the chunk
              foreach ($chunk as $review) {
                // Display dynamic content (review card)
                echo '<div class="card" style="width: 18rem;">';
                echo '<div class="card-body">';
                echo '<h5 class="card-title">' . $review['Name'] . '</h5>';
                echo '<p class="card-text">' . $review['Review'] . '</p>';
                echo '</div>';
                echo '</div>';
              }

              // End card wrapper
              echo '</div>';

              // End carousel item
              echo '</div>';
            }
          } else {
            echo '<div class="carousel-item active"><p>No reviews found for the provider.</p></div>';
          }
        } else {
          echo '<div class="carousel-item active"><p>Provider not found.</p></div>';
        }

        // Close the connection
        $conn->close();
        ?>
      </div>
      <!-- Carousel controls -->
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>


    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
      Add Review
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Review</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="../php/companyPage.php?service_provider_name=<?php echo urlencode($serviceProviderName); ?>" method="post">
              <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" aria-describedby="emailHelp">
              </div>
              <div class="mb-3">
                <label for="reviewMessage" class="form-label">Add Review</label>
                <textarea class="form-control" id="reviewMessage" name="review" rows="3"></textarea>
              </div>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>




          </div>


        </div>
      </div>
    </div>

  </section>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Select buttons
      const selectButtons = document.querySelectorAll('.select-service');

      // Add click event listeners to select buttons
      selectButtons.forEach(button => {
        button.addEventListener('click', function(event) {
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
      confirmButton.addEventListener('click', function(event) {
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
          xhr.onreadystatechange = function() {
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
  <!-- Footer -->
  <?php
  include '../components/footer.php'; // or include_once if you want to ensure it's included only once
  ?>
  <!-- Footer -->

  <!--review section-->

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  <script src="../js/companyPage.js"></script>
</body>

</html>