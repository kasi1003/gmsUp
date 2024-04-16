<?php
// Connect to your database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "htdb";
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$searchTerm = $_GET['search'];

// Query to search for cemetery names matching the search term
$query = "SELECT CemeteryName FROM cemetery WHERE CemeteryName LIKE '%$searchTerm%'";
$result = $conn->query($query);

$cemeteries = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $cemeteries[] = $row['CemeteryName'];
    }
}

// Return the results as JSON
echo json_encode($cemeteries);

$conn->close();
?>
