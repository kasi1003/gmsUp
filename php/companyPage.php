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

  <style>
    body {
      background-color: #f8f9fa;
      color: #333;
    }

    .funeral-services {
      background-color: #343a40;
      padding: 2rem 0;
    }

    .funeral-services h1,
    .funeral-services h2,
    .funeral-services h3 {
      color: white;
      text-align: center;
    }

    .funeral-services h1 {
      font-size: 4em;
      margin-top: 0.5em;
    }

    .funeral-services h2 {
      font-size: 2.5em;
      margin-top: 0.5em;
    }

    .funeral-services h3 {
      font-size: 1.5em;
      margin-top: 0.5em;
    }

    .card {
      margin-bottom: 2rem;
      transition: transform 0.2s, box-shadow 0.2s;
    }

    .card:hover {
      transform: scale(1.05);
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .btn-primary {
      background-color: #007bff;
      border: none;
      transition: background-color 0.3s, transform 0.3s;
    }

    .btn-primary:hover {
      background-color: #0056b3;
      transform: scale(1.05);
    }

    .btn-success {
      background-color: #28a745;
      border: none;
    }

    .carousel-control-prev,
    .carousel-control-next {
      filter: invert(1);
    }

    .carousel .carousel-inner .carousel-item {
      display: flex;
      justify-content: center;
    }

    .modal-header {
      background-color: #007bff;
      color: white;
    }

    .modal-content {
      border-radius: 10px;
    }

    .modal-body input,
    .modal-body textarea {
      border-radius: 5px;
    }

    .modal-body .form-label {
      font-weight: bold;
    }

    .container {
      margin-top: 2rem;
    }
  </style>
</head>

<body>
  <!--navbar-->
  <?php include '../components/header.php'; ?>

  <!--first section-->
  <section class="funeral-services">
    <?php
    // Get the service_provider_name from the query parameter
    $serviceProviderName = $_GET['service_provider_name'];
    // Use htmlspecialchars to prevent cross-site scripting (XSS) attacks
    $serviceProviderName = htmlspecialchars($serviceProviderName, ENT_QUOTES, 'UTF-8');
    ?>
    <h1><?php echo $serviceProviderName; ?></h1>
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
      echo '<h2>' . $motto . '</h2>';
      echo '<h3>Email: ' . $email . '</h3>';
    } else {
      echo "<p class='text-white text-center'>Motto and Email not found for the provider.</p>";
    }

    // Close the connection
    $conn->close();
    ?>

    <div class="accordion w-75 m-4 mx-auto" id="accordionPanelsStayOpenExample">
      <div class="accordion-item">
        <h2 class="accordion-header" id="panelsStayOpen-headingOne">
          <!-- Button goes here -->
        </h2>
      </div>
    </div>

    <h2>Services</h2>

    <div class="container">
      <div class="row">
        <?php
        session_start();
        // Step 1: Extract the service provider name from the URL
        $service_provider_name = $_GET['service_provider_name'];
        // Step 2: Retrieve the UserId from the session or generate a new one if not available
        if (isset($_SESSION['user_id'])) {
          $user_id = $_SESSION['user_id'];
        } else {
          // Generate a unique random user id
          $user_id = uniqid();
          $_SESSION['user_id'] = $user_id; // Store the user id in the session
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
            $sql_services = "SELECT * FROM services WHERE ProviderId = $provider_id";

            // Execute the query
            $result_services = $conn->query($sql_services);

            // Check if the query was successful
            if ($result_services->num_rows > 0) {
              // Display the service name and a button to select the service
              while ($row_service = $result_services->fetch_assoc()) {
                $service_id = $row_service['id'];
                $service_name = $row_service['ServiceName'];
                $service_description = $row_service['ServiceDescription'];
                $service_price = $row_service['ServicePrice'];

                echo '<div class="col-md-4">';
                echo '<div class="card">';
                echo '<div class="card-body">';
                echo '<h5 class="card-title">' . $service_name . '</h5>';
                echo '<p class="card-text">' . $service_description . '</p>';
                echo '<p class="card-text">Price: $' . $service_price . '</p>';
                echo '<form method="POST" action="">';
                echo '<input type="hidden" name="service_id" value="' . $service_id . '">';
                echo '<div class="form-check form-switch">';
                echo '<input class="form-check-input" type="checkbox" id="serviceSwitch' . $service_id . '" name="selected" value="1" onchange="this.form.submit()">';
                echo '<label class="form-check-label" for="serviceSwitch' . $service_id . '">Select Service</label>';
                echo '</div>';
                echo '</form>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
              }
            } else {
              echo "<p>No services found for the provider.</p>";
            }
          } else {
            echo "<p>No provider found with the specified name.</p>";
          }
        }

        // Close the connection
        $conn->close();
        ?>
      </div>
    </div>
  </section>

  <!--second section-->
  <section>
    <div class="container">
      <div class="row">
        <div class="col">
          <h2>Gallery</h2>
          <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
              <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
              <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
              <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="../images/companyPageImages/funeral.jpg" class="d-block w-100" alt="..." />
                <div class="carousel-caption d-none d-md-block">
                  <h5>Funeral Service</h5>
                  <p>Beautiful funeral services to honor your loved ones.</p>
                </div>
              </div>
              <div class="carousel-item">
                <img src="../images/companyPageImages/memorial.jpg" class="d-block w-100" alt="..." />
                <div class="carousel-caption d-none d-md-block">
                  <h5>Memorial Service</h5>
                  <p>Honoring the memory of your loved ones with dignity and respect.</p>
                </div>
              </div>
              <div class="carousel-item">
                <img src="../images/companyPageImages/cremation.jpg" class="d-block w-100" alt="..." />
                <div class="carousel-caption d-none d-md-block">
                  <h5>Cremation Service</h5>
                  <p>Providing compassionate cremation services to families in need.</p>
                </div>
              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
        </div>
        <div class="col">
          <div class="d-flex justify-content-between align-items-center">
            </button>
          </div>
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

            // Step 3: Fetch records from the reviews table with the same ProviderId
            $sql_reviews = "SELECT * FROM reviews WHERE ProviderId = $provider_id";

            // Execute the query
            $result_reviews = $conn->query($sql_reviews);

            // Check if the query was successful
            if ($result_reviews->num_rows > 0) {
              // Loop through and display the reviews
              while ($row_review = $result_reviews->fetch_assoc()) {
                $reviewer_name = $row_review['ReviewerName'];
                $rating = $row_review['Rating'];
                $comment = $row_review['Comment'];

                echo '<div class="card my-3">';
                echo '<div class="card-body">';
                echo '<h5 class="card-title">' . $reviewer_name . '</h5>';
                echo '<p class="card-text">Rating: ' . $rating . '/5</p>';
                echo '<p class="card-text">' . $comment . '</p>';
                echo '</div>';
                echo '</div>';
              }
            } else {
              echo "<p>No reviews found for the provider.</p>";
            }
          } else {
            echo "<p>No provider found with the specified name.</p>";
          }

          // Close the connection
          $conn->close();
          ?>
        </div>
      </div>
    </div>
  </section>

  <!--third section-->
  <section>
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-center">
          <h2>Leave a Review</h2>
          <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Submit a Review
          </button>
        </div>
      </div>
    </div>
  </section>

  <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Submit a Review</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" action="save_review.php">
          <div class="mb-3">
            <label for="reviewerName" class="form-label">Name</label>
            <input type="text" class="form-control" id="reviewerName" name="reviewerName" required>
          </div>
          <div class="mb-3">
            <label for="rating" class="form-label">Rating</label>
            <input type="number" class="form-control" id="rating" name="rating" min="1" max="5" required>
          </div>
          <div class="mb-3">
            <label for="servicedelivery" class="form-label">Service Delivery</label>
            <select class="form-control" id="servicedelivery" name="servicedelivery" required>
              <option value="Satisfactory">Satisfactory</option>
              <option value="Unsatisfactory">Unsatisfactory</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="comment" class="form-label">Comment</label>
            <textarea class="form-control" id="comment" name="comment" rows="3" required></textarea>
          </div>
          <button type="submit" class="btn btn-success">Submit Review</button>
        </form>
      </div>
    </div>
  </div>
</div>
        </div>
      </div>
    </div>
  </div>

  <!--footer-->
  <?php include('../components/footer.php'); ?>

  <!-- Add Bootstrap and jQuery scripts here -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>

</html>
