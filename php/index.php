<?php
// Start or resume the session
session_start();

// Get the session ID
$user_id = session_id();

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
$sql = "SELECT Name FROM service_providers";
$result = $conn->query($sql);

$providers = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $providers[] = $row['Name'];
    }
}

// Close the database connection
$conn->close();

// Return the service provider names along with the user ID as JSON
$response = array(
    'UserId' => $user_id,
    'service_providers' => $providers
);
echo json_encode($response);

?>
