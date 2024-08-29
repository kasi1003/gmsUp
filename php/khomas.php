<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gms";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Start a session
session_start();

// Set UserId to PHPSESSID
$_SESSION['UserId'] = session_id();

// Function to generate a unique user ID
function generateUserId()
{
  return 'User_' . uniqid(); // Example format: User_randomUniqueId
}

// Retrieve the region parameter from the URL
$region = $_GET["region"];

// Query the regions table for the region ID and iframe URL based on the region name
$sqlRegion = "SELECT region_id, iframe_url FROM regions WHERE name = ?";
$stmtRegion = $conn->prepare($sqlRegion);
$stmtRegion->bind_param("s", $region);
$stmtRegion->execute();
$resultRegion = $stmtRegion->get_result();

// Check if the region ID is found
if ($resultRegion->num_rows > 0) {
  $rowRegion = $resultRegion->fetch_assoc();
  $region_id = $rowRegion['region_id'];
  $iframe_url = $rowRegion['iframe_url'];
} else {
  echo "Region not found.";
  exit;
}

// Close the database connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?php echo $region; ?> Region</title>
  <link rel="stylesheet" href="../css/khomas.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" />
</head>

<body>
  <?php include '../components/header.php'; ?>

  <section class="topSection">
    <div class="card border-secondary bg-dark m-5 h-100" style="width: 85%;">
      <div class="card-header border-secondary">
        <h1 class="service-providers-header-text"><?php echo $region; ?> Region</h1>
        <p class="service-providers-subheading">
          Below you will find all cemeteries in <?php echo $region; ?> Region
        </p>
      </div>
      <div class="card-body text-secondary">
        <!-- Search input field -->
        <div class="row justify-content-center mb-4">
          <div class="col-md-6">
            <input type="text" id="searchInput" class="form-control" onkeyup="searchCemeteries()" placeholder="Search for cemeteries...">
          </div>
        </div>

        <!-- Embed the iframe dynamically based on the region -->
        <h2>View Cemeteries</h2>
        <iframe src="<?php echo $iframe_url; ?>" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>

        <?php
        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }

        // Query the towns table for towns belonging to the selected region
        $sqlTowns = "SELECT town_id, name FROM towns WHERE region_id = ?";
        $stmtTowns = $conn->prepare($sqlTowns);
        $stmtTowns->bind_param("i", $region_id);
        $stmtTowns->execute();
        $resultTowns = $stmtTowns->get_result();

        // Check if there are towns to display
        if ($resultTowns->num_rows > 0) {
          // Output the list of towns in a top-down layout
          echo '<div class="towns-container">';
          while ($rowTown = $resultTowns->fetch_assoc()) {
            echo '<div class="town">';
            echo '<h2>' . $rowTown['name'] . '</h2>';

            // Query the cemetery table for cemeteries belonging to the current town
            $sqlCemeteries = "SELECT CemeteryName FROM cemetery WHERE Town = ?";
            $stmtCemeteries = $conn->prepare($sqlCemeteries);
            $stmtCemeteries->bind_param("i", $rowTown['town_id']); // Assuming town_id is an integer
            $stmtCemeteries->execute();
            $resultCemeteries = $stmtCemeteries->get_result();

            // Check if there are cemeteries to display
            if ($resultCemeteries->num_rows > 0) {
              // Output the list of cemeteries with clickable buttons
              echo '<div class="cemeteries-container">';
              while ($rowCemetery = $resultCemeteries->fetch_assoc()) {
                echo '<button class="cemetery-button" onclick="navigateToCemetery(\'' . $rowCemetery['CemeteryName'] . '\')">' . $rowCemetery['CemeteryName'] . '</button>';
              }
              echo '</div>';
            } else {
              // No cemeteries found for the current town
              echo '<p>No cemeteries found for ' . $rowTown['name'] . '</p>';
            }

            echo '</div>'; // Close town div
          }
          echo '</div>'; // Close towns-container div
        } else {
          // No towns found for the selected region
          echo '<p>No towns found for the selected region.</p>';
        }

        // Close the database connection
        $conn->close();
        ?>

        <p id="noCemeteriesFound" style="display: none;">No cemeteries found</p>

        <script>
          function navigateToCemetery(cemeteryName) {
            // Redirect to cemeteryMap.php with the cemetery_name parameter
            window.location.href = 'cemeteryMap.php?cemetery_name=' + encodeURIComponent(cemeteryName);
          }

          function searchCemeteries() {
            var input, filter, ul, li, a, i, txtValue;
            input = document.getElementById('searchInput');
            filter = input.value.toUpperCase();
            ul = document.getElementsByClassName('cemeteries-container');
            var noMatch = true;
            for (i = 0; i < ul.length; i++) {
              li = ul[i].getElementsByTagName('button');
              for (var j = 0; j < li.length; j++) {
                a = li[j].textContent || li[j].innerText;
                if (a.toUpperCase().startsWith(filter)) {
                  li[j].style.display = '';
                  noMatch = false;
                } else {
                  li[j].style.display = 'none';
                }
              }
            }
            var noCemeteries = document.getElementById('noCemeteriesFound');
            if (noMatch) {
              noCemeteries.style.display = 'block';
            } else {
              noCemeteries.style.display = 'none';
            }
          }
        </script>
      </div>
    </div>
  </section>

  <?php include '../components/footer.php'; ?>

  <script src="../js/khomas.js"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"></script>
</body>

</html>
