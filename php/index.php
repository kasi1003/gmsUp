<?php
// Start or resume the session
session_start();

// Check if the user is already logged in
if (!isset($_SESSION['UserId'])) {
    // If not logged in, generate a new user ID and store it in the session
    $_SESSION['UserId'] = uniqid();
}

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

// Return the service provider names along with the user ID as JSON
$response = array(
    'UserId' => $_SESSION['UserId'],
    'service_providers' => $providers
);
echo json_encode($response);
?>
