<?php
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
  }
?>