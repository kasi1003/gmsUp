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

// Fetch funeral service providers from the database
$sql = "SELECT service_provider_name FROM service_providers";
$result = $conn->query($sql);

$providers = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $providers[] = $row['service_provider_name'];
    }
}

// Close the database connection
$conn->close();

// Return the service provider names as JSON
echo json_encode($providers);
?>