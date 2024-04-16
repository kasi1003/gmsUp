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
  <?php
  include '../components/header.php'; // or include_once if you want to ensure it's included only once
  ?>


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

// Set UserId to PHPSESSID
$_SESSION['UserId'] = session_id();

// Now $_SESSION['UserId'] holds the same value as PHPSESSID

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
    <?php
    include '../components/footer.php'; // or include_once if you want to ensure it's included only once
    ?>
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