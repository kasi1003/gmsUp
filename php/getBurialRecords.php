<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "htdb";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get input from AJAX request
$searchInput = $_GET['searchInput'];

// Prepare and execute SQL query
$sql = "SELECT * FROM burial_records WHERE name = ? OR death_code = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $searchInput, $searchInput);
$stmt->execute();
$result = $stmt->get_result();

// Fetch data and store in an array
$records = array();
while ($row = $result->fetch_assoc()) {
    $records[] = $row;
}

// Return data as JSON
echo json_encode($records);

// Close database connection
$stmt->close();
$conn->close();
?>
