<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Heavenly Tomb | AVBOB</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
  <link rel="stylesheet" href="../css/companyPage.css" />
  <style>
    body {
      background: #f8f9fa;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .text-white {
      color: #495057 !important;
    }
    .card {
      border: none;
      border-radius: 15px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    .card-body {
      padding: 20px;
    }
    .carousel-item {
      padding: 20px;
    }
    .carousel-control-prev-icon,
    .carousel-control-next-icon {
      background-color: #495057;
      border-radius: 50%;
    }
    .btn-primary {
      background-color: #007bff;
      border: none;
      border-radius: 50px;
      padding: 10px 20px;
    }
    .btn-primary:hover {
      background-color: #0056b3;
    }
    #addReviewModal .modal-content {
      border-radius: 15px;
    }
    .form-control {
      border-radius: 50px;
    }
    footer {
      background-color: #343a40;
      color: #fff;
      padding: 20px 0;
    }
  </style>
</head>

<body>
  <!-- Navbar -->
  <?php include '../components/header.php'; ?>

  <!-- Main content -->
  <main class="container mt-5">
    <section id="funeral-services">
      <?php
      session_start();

      function getQueryParam($paramName) {
        return htmlspecialchars($_GET[$paramName] ?? '', ENT_QUOTES, 'UTF-8');
      }

      $servername = "localhost";
      $username = "root";
      $password = "";
      $database = "htdb";

      $conn = new mysqli($servername, $username, $password, $database);

      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }

      $serviceProviderName = getQueryParam('service_provider_name');

      $sql_info = "SELECT Motto, Email FROM service_providers WHERE name = ?";
      if ($stmt = $conn->prepare($sql_info)) {
        $stmt->bind_param("s", $serviceProviderName);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
          $stmt->bind_result($motto, $email);
          $stmt->fetch();

          echo '<h1 class="text-center text-white">' . $serviceProviderName . '</h1>';
          echo '<h2 class="text-center text-white">' . $motto . '</h2>';
          echo '<h3 class="text-center text-white">Email: ' . $email . '</h3>';
        } else {
          echo "Motto and Email not found for the provider.";
        }

        $stmt->close();
      } else {
        echo "Error fetching provider details: " . $conn->error;
      }

      $sql_services = "SELECT id, ServiceName, Description, Price FROM services WHERE ProviderId = (SELECT id FROM service_providers WHERE Name = ?)";
      if ($stmt = $conn->prepare($sql_services)) {
        $stmt->bind_param("s", $serviceProviderName);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
          echo '<div class="row">';
          while ($row = $result->fetch_assoc()) {
            echo '<div class="col-md-4 mb-4">';
            echo '<div class="card h-100">';
            echo '<div class="card-body">';
            echo '<h5 class="card-title">' . $row['ServiceName'] . '</h5>';
            echo '<p class="card-text">' . $row['Description'] . '</p>';
            echo '<p class="card-text">Price: ' . $row['Price'] . '</p>';
            echo '<button class="btn btn-primary select-service" data-service-id="' . $row['id'] . '">Select</button>';
            echo '</div></div></div>';
          }
          echo '</div>';
        } else {
          echo "No services found for the provider.";
        }

        $stmt->close();
      } else {
        echo "Error fetching services: " . $conn->error;
      }

      $conn->close();
      ?>
    </section>

    <!-- Reviews Carousel -->
    <section id="reviews" class="mt-5">
      <h2 class="text-center text-white mb-4">Reviews</h2>
      <div id="carouselReviews" class="carousel carousel-dark slide" data-bs-ride="carousel">
        <div class="carousel-inner">
          <?php
          $conn = new mysqli($servername, $username, $password, $database);
          if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
          }

          $sql_reviews = "SELECT Name, Review FROM reviews WHERE ProviderId = (SELECT id FROM service_providers WHERE Name = ?)";
          if ($stmt = $conn->prepare($sql_reviews)) {
            $stmt->bind_param("s", $serviceProviderName);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
              $reviews = $result->fetch_all(MYSQLI_ASSOC);
              foreach (array_chunk($reviews, 3) as $chunk) {
                echo '<div class="carousel-item ' . ($chunk === reset($chunk) ? 'active' : '') . '">';
                echo '<div class="card-group">';
                foreach ($chunk as $review) {
                  echo '<div class="card">';
                  echo '<div class="card-body">';
                  echo '<h5 class="card-title">' . htmlspecialchars($review['Name']) . '</h5>';
                  echo '<p class="card-text">' . htmlspecialchars($review['Review']) . '</p>';
                  echo '</div></div>';
                }
                echo '</div></div>';
              }
            } else {
              echo '<div class="carousel-item active"><p>No reviews found for the provider.</p></div>';
            }

            $stmt->close();
          } else {
            echo "Error fetching reviews: " . $conn->error;
          }

          $conn->close();
          ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselReviews" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselReviews" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>

      <!-- Add Review Modal -->
      <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#addReviewModal">
        Add Review
      </button>
      <div class="modal fade" id="addReviewModal" tabindex="-1" aria-labelledby="addReviewModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="addReviewModalLabel">Add Review</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="../php/add_review.php" method="POST">
                <div class="mb-3">
                  <label for="reviewerName" class="form-label">Your Name</label>
                  <input type="text" class="form-control" id="reviewerName" name="reviewer_name" required>
                </div>
                <div class="mb-3">
                  <label for="reviewMessage" class="form-label">Review Message</label>
                  <textarea class="form-control" id="reviewMessage" name="review_message" rows="3" required></textarea>
                </div>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit Review</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Confirmation and View Quotation Buttons -->
    <div class="text-center mt-5">
      <button id="confirmButton" class="btn btn-primary">Confirm Selection</button>
      <a href="pdf_quote.php" class="btn btn-primary">View Quotation</a>
    </div>
  </main>

  <!-- Footer -->
  <?php include '../components/footer.php'; ?>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-dZ7JN/XmB5VNZc/MgNz0Oz1mFZD3Z3B2+VTPS+tLl4Z4oJNj8F8HucDLHNEpOGfD" crossorigin="anonymous"></script>
  <script src="../js/companyPage.js"></script>
</body>

</html>
