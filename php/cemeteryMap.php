<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../css/cemeteryMap.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
  <title>Document</title>
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
    </div>
  </nav>


  <section class="cemetery-map-section">
    <div class="card text-white bg-dark mb-3 border-secondary" style="width: 80%; margin: 2em; height: auto;">
        <div class="card-header border-secondary" style="font-size: 3em; display:width 80%; justify-content: center;">
            <?php
            if (isset($_GET['cemetery_name'])) {
                echo htmlspecialchars($_GET['cemetery_name']);
            } else {
                echo "Cemetery Name Not Found";
            }
            ?>
        </div>
        <div class="card-body" style="padding-bottom: 20em;">
            <div class="cemetery-svg-container">
                <?php
                // Assuming you have already connected to your database
                // Output the cemetery SVG map here
                ?>
            </div>
            
            <?php
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

// Assuming you have already connected to your database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "htdb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if cemetery_name is set in the URL
if (isset($_GET['cemetery_name'])) {
    $cemeteryName = $_GET['cemetery_name'];

    // Query the database to get the cemetery ID and SVG map based on the cemetery name
    $queryCemetery = "SELECT CemeteryID, SvgMap FROM cemetery WHERE CemeteryName = ?";
    $stmt = $conn->prepare($queryCemetery);
    $stmt->bind_param("s", $cemeteryName);
    $stmt->execute();
    $resultCemetery = $stmt->get_result();

    if ($resultCemetery->num_rows > 0) {
        $rowCemetery = $resultCemetery->fetch_assoc();
        $cemeteryID = $rowCemetery['CemeteryID'];
        $svgMap = $rowCemetery['SvgMap'];

        // Display the SVG map
        echo '<div class="svg-map-container" style="margin-top: 20px; margin-bottom: 20px;">';
        echo '<svg class="svg-map" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 100" style="width: 85%; height: auto; max-width: 85%; display: block; margin: 0 auto;">';
        echo $svgMap; // Assuming SvgMap contains the SVG data
        echo '</svg>';
        echo '</div>';

        // Query the grave_sections table to fetch sections with the same CemeteryID
        $querySections = "SELECT SectionCode, SectionType, SectionSvg FROM grave_sections WHERE CemeteryID = ?";
        $stmt = $conn->prepare($querySections);
        $stmt->bind_param("i", $cemeteryID);
        $stmt->execute();
        $resultSections = $stmt->get_result();

        echo '<h3 class="container-headr">Click a section to book your number of Grave sites</h3>';

        // Display each section's SVG in its own box along with available graves
        echo '<div class="section-box-container">';
        while ($rowSection = $resultSections->fetch_assoc()) {
            echo '<div class="section-box">';
            echo '<a href="cemeteriesBooking.php?selected_section=' . $rowSection['SectionCode'] . '">';
            echo '<p class="section-name">Section ' . substr($rowSection['SectionCode'], -1) . '</p>';
            echo '<p class="section-type">' . $rowSection['SectionType'] . '</p>';
            echo $rowSection['SectionSvg']; // Assuming SectionSvg contains the SVG data

            // Fetch the number of available graves for this section from the grave table
$sectionCode = $rowSection['SectionCode'];
$queryAvailableGraves = "SELECT COUNT(*) AS AvailableGraves FROM `grave` WHERE SectionCode = ? AND GraveStatus IS NULL";
$stmt = $conn->prepare($queryAvailableGraves);
$stmt->bind_param("s", $sectionCode);
$stmt->execute();
$resultAvailableGraves = $stmt->get_result();
$rowAvailableGraves = $resultAvailableGraves->fetch_assoc();

echo '<p class="available-graves">Available Graves: ' . $rowAvailableGraves['AvailableGraves'] . '</p>';


            echo '</a>';
            echo '</div>';
        }
        echo '</div>';
    } else {
        // No cemetery found for the given name
        echo '<p>No cemetery found for this name</p>';
    }
} else {
    // Cemetery name not set in the URL
    echo '<p>Cemetery name not found in the URL</p>';
}

// Close the database connection
$conn->close();
?>

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
                Here you can use rows and columns to organize your footer
                content. Lorem ipsum dolor sit amet, consectetur adipisicing
                elit.
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
        © 2020 Copyright:
        <a class="text-white" href="https://mdbootstrap.com/">MDBootstrap.com</a>
      </div>
      <!-- Copyright -->
    </footer>
    <!-- Footer -->
  </div>
  <!-- End of .container -->
  <script src="../js/cemeteryMap.js"></script>
  <script async src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap">
  </script>
  
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>