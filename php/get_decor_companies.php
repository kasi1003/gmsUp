<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "htdb";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->prepare("SELECT * FROM decor_companies ORDER BY created_at DESC");
    $stmt->execute();
    $companies = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($companies);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
