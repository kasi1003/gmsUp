<?php
// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "htdb";

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

        // Check if the email already exists
        $checkEmailStmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE email = :email");
        $checkEmailStmt->bindParam(':email', $email);
        $checkEmailStmt->execute();
        $emailExists = $checkEmailStmt->fetchColumn();

        if ($emailExists) {
            echo "The email address is already registered. Please use a different email.";
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
                echo "Registration successful!";
                // Redirect to a success page
                 header("Location: success.php");
                 exit();
            } else {
                echo "Error: " . $stmt->errorCode();
            }
        }
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
