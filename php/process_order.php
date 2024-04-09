<?php
session_start(); // Start the session

// Check if the session's UserId is set
if (!isset($_SESSION['UserId'])) {
    // If not set, generate a new user ID and assign it to the session
    $_SESSION['UserId'] = generateUserId();
}

// Function to generate a unique user ID
function generateUserId() {
    // Use a simple method to generate a unique user ID
    return 'User_' . uniqid(); // Example format: User_randomUniqueId
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "htdb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Connected successfully"; // Add this line to confirm successful connection
}

// Check if the form data is received
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the form
    $cemeteryID = $_POST['cemeteryID'];
    $sectionCode = $_POST['sectionCode'];
    $rowID = $_POST['rowID']; // Modified to retrieve from form data
    $selectedGraves = explode(",", $_POST['graveNums']); // Modified to retrieve from form data
    $buyerName = $_POST['buyerName'];
    $email = $_POST['email'];
    $idNumber = $_POST['idNumber'];
    $phoneNumber = $_POST['phoneNumber'];
    $userId = $_SESSION['UserId']; // Retrieve UserId from session

    // Additional processing or validation can be performed here
    
    // Prepare and execute SQL insert statement for each selected grave number
    foreach ($selectedGraves as $graveNum) {
        // Prepare SQL statement for inserting order
        $sql = "INSERT INTO orders (CemeteryID, SectionCode, RowID, GraveNum, BuyerName, Email, IdNumber, PhoneNumber, UserId, created_at, updated_at) 
                VALUES ('$cemeteryID', '$sectionCode', '$rowID', '$graveNum', '$buyerName', '$email', '$idNumber', '$phoneNumber', '$userId', NOW(), NOW())";

        // Execute SQL statement for inserting order
        if ($conn->query($sql) !== TRUE) {
            $error_message = "Error: " . $sql . "<br>" . $conn->error;
            echo $error_message;
            error_log($error_message); // Log the error to the server error log
        } else {
            // Update the grave status to 0 for the inserted grave
            $updateSql = "UPDATE grave SET GraveStatus = 0 WHERE RowID = '$rowID' AND GraveNum = '$graveNum'";
            if ($conn->query($updateSql) !== TRUE) {
                $error_message = "Error updating grave status: " . $conn->error;
                echo $error_message;
                error_log($error_message); // Log the error to the server error log
            }
        }
    }

    echo "Orders created successfully";
} else {
    // If the form data is not received, output an error message
    echo "Form data not received";
}

// Close the database connection
$conn->close();
?>
