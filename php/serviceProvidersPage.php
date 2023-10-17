<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "htdb";

// Create a new connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch service provider data from the database
$sql = "SELECT service_provider_name, total_burials, successful_burials, unsuccessful_burials FROM service_providers";
$result = $conn->query($sql);

$providers = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $providers[] = $row;
    }
}

// Close the database connection
$conn->close();
echo json_encode($providers);

?>
