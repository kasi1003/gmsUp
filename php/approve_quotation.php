<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "htdb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the token from the URL
$token = isset($_GET['token']) ? $_GET['token'] : '';

if ($token) {
    // Validate the token and update the quotation status
    $result = $conn->query("SELECT id FROM quotations WHERE approval_token='$token'");

    if ($result->num_rows > 0) {
        // Token is valid, update the quotation status to approved
        $row = $result->fetch_assoc();
        $quotationId = $row['id'];

        $conn->query("UPDATE quotations SET status='approved' WHERE id='$quotationId'");

        echo "Quotation approved successfully.";
    } else {
        echo "Invalid approval link.";
    }
} else {
    echo "No approval token provided.";
}

$conn->close();
?>
