<?php
// Assuming you have a database connection established

// Function to fetch grave data from the database
function fetchGraveData() {
    // Replace the following with your database connection code
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'htdb';

    // Create a connection
    $conn = new mysqli($host, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }

    // Fetch the data
    $sql = 'SELECT section_code, available_graves FROM oponganda';
    $result = $conn->query($sql);

    $data = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }

    // Close the connection
    $conn->close();

    return $data;
}

// Fetch the data
$graveData = fetchGraveData();

// Output the data as JSON
header('Content-Type: application/json');
echo json_encode($graveData);
?>
