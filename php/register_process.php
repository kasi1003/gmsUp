<?php
session_start();

// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "htdb (1)";

try {
    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    // Set PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get form data and sanitize it
        $name = htmlspecialchars(trim($_POST['name']));
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT); // Hash the password
        $user_type = htmlspecialchars(trim($_POST['user_type']));

        // Additional fields based on user type
        $services = $description = $motto = $contact_number = $company_email = $region = $constituency = $classification = null;

        if ($user_type === 'service_provider') {
            $services = htmlspecialchars(trim($_POST['services']));
            $description = htmlspecialchars(trim($_POST['description']));
            $motto = htmlspecialchars(trim($_POST['motto']));
            $contact_number = htmlspecialchars(trim($_POST['contact_number']));
            $company_email = filter_var($_POST['company_email'], FILTER_SANITIZE_EMAIL);
        } elseif ($user_type === 'local_authority') {
            $region = htmlspecialchars(trim($_POST['region']));
            $constituency = htmlspecialchars(trim($_POST['constituency']));
            $classification = htmlspecialchars(trim($_POST['classification']));
            $contact_number = htmlspecialchars(trim($_POST['contact_number']));
        }

        // Check if the personal email already exists
        $checkEmailStmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE email = :email");
        $checkEmailStmt->bindParam(':email', $email);
        $checkEmailStmt->execute();
        $emailExists = $checkEmailStmt->fetchColumn();

        // Check if the company email already exists, if provided
        if ($company_email) {
            $checkCompanyEmailStmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE company_email = :company_email");
            $checkCompanyEmailStmt->bindParam(':company_email', $company_email);
            $checkCompanyEmailStmt->execute();
            $companyEmailExists = $checkCompanyEmailStmt->fetchColumn();
        } else {
            $companyEmailExists = false;
        }

        if ($emailExists) {
            $_SESSION['error'] = "The email address is already registered. Please use a different email.";
            header("Location: registration.php");
        } elseif ($companyEmailExists) {
            $_SESSION['error'] = "The company email address is already registered. Please use a different company email.";
            header("Location: registration.php");
        } else {
            // Insert user data into the database
            $sql = "INSERT INTO users (name, email, password, user_type, services, description, motto, contact_number, company_email, region, constituency, classification) VALUES (:name, :email, :password, :user_type, :services, :description, :motto, :contact_number, :company_email, :region, :constituency, :classification)";
            $stmt = $pdo->prepare($sql);

            // Bind parameters to the prepared statement
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':user_type', $user_type);
            $stmt->bindParam(':services', $services);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':motto', $motto);
            $stmt->bindParam(':contact_number', $contact_number);
            $stmt->bindParam(':company_email', $company_email);
            $stmt->bindParam(':region', $region);
            $stmt->bindParam(':constituency', $constituency);
            $stmt->bindParam(':classification', $classification);

            // Execute the statement
            if ($stmt->execute()) {
                $_SESSION['success'] = "Registration successful!";
                header("Location: success.php");
                exit();
            } else {
                $_SESSION['error'] = "Error: " . $stmt->errorCode();
                header("Location: registration.php");
            }
        }
    }
} catch (PDOException $e) {
    $_SESSION['error'] = "Connection failed: " . $e->getMessage();
    header("Location: registration.php");
}
?>
