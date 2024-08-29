<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "htdb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Start a session
session_start();

// Check if the user ID is already set in the session
if (!isset($_SESSION['UserId'])) {
    // If not set, generate a new user ID
    $_SESSION['UserId'] = generateUserId();
}

$userId = $_SESSION['UserId'];

// Function to generate a unique approval token
function generateApprovalToken() {
    return bin2hex(random_bytes(16));
}

// Function to generate a unique user ID
function generateUserId() {
    // Use a simple method to generate a unique user ID
    return 'User_' . uniqid(); // Example format: User_randomUniqueId
}

// Function to generate a unique code
function generateUniqueCode($region, $town, $localauthority, $cemetery, $section, $row, $graveNumber, $deceasedName, $receiptNumber, $burialDate) {
    return strtoupper(substr($region, 0, 3)) . '-' .
           strtoupper(substr($town, 0, 3)) . '-' .
           strtoupper(substr($localauthority, 0, 3)) . '-' .
           strtoupper(substr($cemetery, 0, 3)) . '-' .
           $section . '-' .
           $row . '-' .
           $graveNumber . '-' .
           strtoupper(substr($deceasedName, 0, 3)) . '-' .
           $receiptNumber . '-' .
           date('Ymd', strtotime($burialDate));
}

// Function to send email
function sendQuotationEmail($to, $subject, $message, $headers) {
    // Use the mail() function to send email
    return mail($to, $subject, $message, $headers);
}

// Email details
$companyEmail = "company@example.com"; 
$serviceproviderEmail = "CityOFWindhoek@example.com"; 

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['clientEmail'])) {
    $clientEmail = filter_var($_POST['clientEmail'], FILTER_SANITIZE_EMAIL);
    $region = filter_var($_POST['region'], FILTER_SANITIZE_STRING);
    $town = filter_var($_POST['town'], FILTER_SANITIZE_STRING);
    $localauthority = filter_var($_POST['localauthority'], FILTER_SANITIZE_STRING);
    $cemetery = filter_var($_POST['cemetery'], FILTER_SANITIZE_STRING);
    $section = filter_var($_POST['section'], FILTER_SANITIZE_STRING);
    $row = filter_var($_POST['row'], FILTER_SANITIZE_STRING);
    $graveNumber = filter_var($_POST['graveNumber'], FILTER_SANITIZE_STRING);
    $deceasedName = filter_var($_POST['deceasedName'], FILTER_SANITIZE_STRING);
    $receiptNumber = filter_var($_POST['receiptNumber'], FILTER_SANITIZE_STRING);
    $burialDate = filter_var($_POST['burialDate'], FILTER_SANITIZE_STRING);

    // Generate the unique code
    $uniqueCode = generateUniqueCode($region, $town, $localauthority, $cemetery, $section, $row, $graveNumber, $deceasedName, $receiptNumber, $burialDate);

    // Generate approval token
    $approvalToken = generateApprovalToken();

    // Get the quotation ID from your logic, assuming it's passed as a hidden form field
    $quotation_Id = filter_var($_POST['quotation_Id'], FILTER_SANITIZE_STRING);

    // Store the token in the database associated with the quotation
    $conn->query("UPDATE quotations SET approval_token='$approvalToken' WHERE id='$quotation_Id'");

    // Generate approval link
    $approvalLink = "http://yourdomain.com/approve_quotation.php?token=$approvalToken";

    // Prepare the email
    $subject = "Your Quotation";
    $message = "Dear Customer,\n\nPlease find attached your quotation.\n\nUnique Code: $uniqueCode\n\nTo approve the quotation, click the link below:\n$approvalLink\n\nBest Regards,\nYour Company";
    $headers = "From: no-reply@yourcompany.com";

    // Send the email to the client
    $clientEmailSent = sendQuotationEmail($clientEmail, $subject, $message, $headers);

    // Send the email to the company
    $companyEmailSent = sendQuotationEmail($companyEmail, $subject, $message, $headers);

    // Send the email to the service provider 
    $serviceproviderEmailSent = sendQuotationEmail($serviceproviderEmail, $subject, $message, $headers);

    if ($clientEmailSent && $companyEmailSent && $serviceproviderEmailSent) {
        $emailStatus = "Quotation sent to client, company, and service provider successfully.";
    } else {
        $emailStatus = "Failed to send quotation. Please try again.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Quotation</title>
    <link rel="stylesheet" href="../css/quote.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-BPxTfN7eBUceU3W5Fs5IxFh+0ObJmo4Qh/a9x9JvN1oQwvEJrhzMQ8biJrbUlf7nWhHr58Hh6gPuGvz6ARu94Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="index.html">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="service-providers-page.html" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Service Providers
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="avbobPage.html">AVBOB</a>
                        <a class="dropdown-item" href="service-providers-page.html">View More</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="cemeteries.html">Buy a Grave</a>
                </li>
            </ul>
            <?php
                if (isset($emailStatus)) {
                    echo '<p class="ml-auto text-white">' . $emailStatus . '</p>';
                }
            ?>
        </div>
    </nav>
    <!--home landing page-->
    <section class="topSection">
        <div class="card border-secondary bg-dark m-5 h-100" style="width: 85%;">
            <div class="card-header border-secondary">
                <h1 class="service-providers-header-text"></h1>
                <p class="service-providers-subheading">
                    Quotation
                </p>
            </div>
            <div class="card-body text-secondary">
                <!-- Display a form to collect the user's email and other details -->
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="clientEmail">Enter your email address to receive the quotation:</label>
                        <input type="email" class="form-control" id="clientEmail" name="clientEmail" required>
                    </div>
                    <div class="form-group">
                        <label for="region">Region:</label>
                        <input type="text" class="form-control" id="region" name="region" required>
                    </div>
                    <div class="form-group">
                        <label for="town">Town:</label>
                        <input type="text" class="form-control" id="town" name="town" required>
                    </div>
                    <div class="form-group">
                        <label for="localauthority">Local Authority:</label>
                        <input type="text" class="form-control" id="localauthority" name="localauthority" required>
                    </div>
                    <div class="form-group">
                        <label for="cemetery">Cemetery:</label>
                        <input type="text" class="form-control" id="cemetery" name="cemetery" required>
                    </div>
                    <div class="form-group">
                        <label for="section">Section:</label>
                        <input type="text" class="form-control" id="section" name="section" required>
                    </div>
                    <div class="form-group">
                        <label for="row">Row:</label>
                        <input type="text" class="form-control" id="row" name="row" required>
                    </div>
                    <div class="form-group">
                        <label for="graveNumber">Grave Number:</label>
                        <input type="text" class="form-control" id="graveNumber" name="graveNumber" required>
                    </div>
                    <div class="form-group">
                        <label for="deceasedName">Deceased Name:</label>
                        <input type="text" class="form-control" id="deceasedName" name="deceasedName" required>
                    </div>
                    <div class="form-group">
                        <label for="receiptNumber">Receipt Number:</label>
                        <input type="text" class="form-control" id="receiptNumber" name="receiptNumber" required>
                    </div>
                    <div class="form-group">
                        <label for="burialDate">Burial Date:</label>
                        <input type="date" class="form-control" id="burialDate" name="burialDate" required>
                    </div>
                    <input type="hidden" name="quotation_Id" value="<!-- Add the quotation ID here -->">
                    <button type="submit" class="btn btn-primary">Send Quotation</button>
                </form>

                <!-- JavaScript to handle the PDF download button -->
                <script>
                document.addEventListener("DOMContentLoaded", function() {
                    var downloadButton = document.querySelector(".btn-download-pdf");

                    downloadButton.addEventListener("click", function(event) {
                        event.preventDefault();

                        var xhttp = new XMLHttpRequest();
                        xhttp.onreadystatechange = function() {
                            if (this.readyState == 4 && this.status == 200) {
                                // Response from pdf_quote.php
                                var link = document.createElement('a');
                                link.href = 'pdf_quote.php?user_id=' + "<?php echo $userId; ?>";
                                link.download = 'quotation.pdf';
                                document.body.appendChild(link);
                                link.click();
                                document.body.removeChild(link);
                            }
                        };
                        xhttp.open("GET", "pdf_quote.php?user_id=" + "<?php echo $userId; ?>", true); // Include user ID in the URL
                        xhttp.send();
                    });
                });
                </script>

                <!-- Download button -->
                <a href="#" class="btn btn-primary btn-download-pdf">Download Quotation</a>
            </div>
        </div>
    </section>
</body>
</html>
