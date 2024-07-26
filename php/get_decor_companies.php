<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "htdb";

header('Content-Type: application/json'); // Ensure the response is in JSON format

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Prepare and execute the query
    $stmt = $pdo->prepare("SELECT * FROM decor_companies ORDER BY created_at DESC");
    $stmt->execute();

    // Fetch all companies
    $companies = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Output the results as JSON
    echo json_encode($companies, JSON_PRETTY_PRINT);

} catch (PDOException $e) {
    // Return a JSON formatted error message
    echo json_encode(["error" => "Database error: " . $e->getMessage()]);
}
?>
