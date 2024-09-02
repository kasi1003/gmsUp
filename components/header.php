<nav class="navbar navbar-expand-lg navbar-dark ">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <?php
  // Assuming you have established a database connection already
  // Database connection parameters
  $servername = "localhost"; // Replace with your database server name
  $username = "root"; // Replace with your database username
  $password = ""; // Replace with your database password
  $dbname = "htdb"; // Replace with your database name

  // Create a new connection
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Check the connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Query to fetch the first 10 values from the Name column of service_providers table
  $query = "SELECT Name FROM service_providers LIMIT 10";

  // Execute the query
  $result = mysqli_query($conn, $query);

  // Check if the query was successful
  if ($result) {
    // Start building the dropdown menu
    echo '<div class="collapse navbar-collapse" id="navbarNav">';
    echo '<ul class="navbar-nav">';
    echo '<li class="nav-item">';
    echo '<a class="nav-link" href="../php/index.php">Home</a>';
    echo '</li>';
    echo '<li class="nav-item dropdown">';
    echo '<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Service Providers</a>';
    echo '<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink" id="serviceProvidersDropdown">';

    // Loop through the fetched results
    while ($row = mysqli_fetch_assoc($result)) {
      // Output each value as a dropdown item
      // Output each value as a dropdown item with a redirect link
      $serviceProviderName = $row['Name'];
      $redirectURL = "../php/companyPage.php?service_provider_name=" . urlencode($serviceProviderName);
      echo '<a class="dropdown-item" href="' . $redirectURL . '">' . $serviceProviderName . '</a>';
    }
    echo '<a class="dropdown-item" href="../php/serviceProvidersPage.php">View More</a>';

    // Close the dropdown menu
    echo '</div>';
    echo '</li>';
    echo '</ul>';
    echo '</div>';
  } else {
    // Display an error message if the query fails
    echo "Error: " . mysqli_error($conn);
  }

  // Close the database connection
  mysqli_close($conn);
  ?>
  

</nav>