<?php
// Start output buffering
ob_start();

// Include the main TCPDF library (search for installation path).
require_once('../tcpdf/tcpdf.php');

// Start the session
session_start();

// Function to retrieve the user ID from the session
function getUserIdFromSession() {
    // Check if the user ID is set in the session
    if (isset($_SESSION['UserId'])) {
        // Retrieve the user ID from the session
        return $_SESSION['UserId'];
    } else {
        // Handle the case when UserId is not set
        // You may choose to handle this case based on your application's logic
        // For example, you can redirect the user to the login page
        // Terminate script execution and display an error message
        die("User ID not found.");
    }
}

// Retrieve the user ID from the session
$user_id = getUserIdFromSession();

// Database connection parameters
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

// Create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('TCPDF Example 001');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// Set default footer data
$pdf->setFooterData(array(0, 64, 0), array(0, 64, 128));

// Set header and footer fonts
$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// Set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// Set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// Set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// Set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// Set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
    require_once(dirname(__FILE__) . '/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// Set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
$pdf->SetFont('dejavusans', '', 14, '', true);

// Add a page
$pdf->AddPage();

// Fetch orders data from the database
$query = "SELECT * FROM orders WHERE UserId = '$user_id'"; // Using correct column name 'UserId'
$result = mysqli_query($conn, $query);

// Initialize HTML content
$html = '<h1 style="text-align: center; color: #5482C4; font-size: 30px;">Quotation</h1>';

// Start the first column
$html .= '<div style="column-count: 2; column-gap: 20px;">';

// Retrieve company information (hardcoded)
$companyInfo = '<div style="margin-bottom: 10px; font-size: 10px;">'; // Larger font size and margin for the company name
$companyInfo .= '<div style="font-size: 12px;">G Mobility Investment Technology CC</div>'; // Larger font size for the company name
$companyInfo .= '<div>P.O.Box 51421, Backbrecht</div>';
$companyInfo .= '<div>+264 85 663 1980</div>';
$companyInfo .= '<div>3794 Independence Avenue, Windhoek</div>';
$companyInfo .= '<div>GMS@gmobility.co.na</div>';
$companyInfo .= '</div>'; // End the larger font size and margin section

// Append company information to the HTML content
$html .= '<div>' . $companyInfo . '</div>';

// Close the first column
$html .= '</div>';

// Start the second column
$html .= '<div style="column-count: 2; column-gap: 10px;">';

// Fetch buyer information from the orders table
$buyerInfoQuery = "SELECT BuyerName, IdNumber, PhoneNumber FROM orders WHERE UserId = '$user_id' LIMIT 1";
$buyerInfoResult = mysqli_query($conn, $buyerInfoQuery);

// Initialize HTML content for buyer information
$buyerInfoHTML = '<div style="font-size: 10px;">'; // Adjust margin and font size as needed

// Check if buyer information is retrieved successfully
if ($buyerInfoResult && mysqli_num_rows($buyerInfoResult) > 0) {
    // Fetch buyer information
    $buyerData = mysqli_fetch_assoc($buyerInfoResult);

    // Format buyer information
    $buyerInfoHTML .= '<div style="font-weight: bold;">Buyer Information:</div>';
    $buyerInfoHTML .= '<div>Name: ' . $buyerData['BuyerName'] . '</div>';
    $buyerInfoHTML .= '<div>ID Number: ' . $buyerData['IdNumber'] . '</div>';
    $buyerInfoHTML .= '<div>Phone Number: ' . $buyerData['PhoneNumber'] . '</div>';
} else {
    // Handle case when buyer information is not found
    $buyerInfoHTML .= '<div>No buyer information found.</div>';
}

$buyerInfoHTML .= '</div>'; // End buyer information section

// Append buyer information HTML to the main HTML content
$html .= '<div style="margin-left: auto;">' . $buyerInfoHTML . '</div>';

// Close the second column
$html .= '</div>';

// Check if there are any orders for the user
if ($result && mysqli_num_rows($result) > 0) {
    // Initialize HTML content for orders table
    $htmlOrders = '<table border="1" cellpadding="5" cellspacing="0" style="margin-top: 20px;">'; // Adjust margin-top as needed
    $htmlOrders .= '<tr style="background-color: #5482C4; color: white;">';
    $htmlOrders .= '<th style="text-align: center; width: 70%;">Description</th>';
    $htmlOrders .= '<th style="text-align: center; width: 30%;">Amount</th>';
    $htmlOrders .= '</tr>';

    // Loop through each order and add it to the HTML content
    while ($row = mysqli_fetch_assoc($result)) {
        // Fetch cemetery name from the cemetery table
        $cemeteryID = $row['CemeteryID'];
        $cemeteryQuery = "SELECT CemeteryName FROM cemetery WHERE CemeteryID = '$cemeteryID'";
        $cemeteryResult = mysqli_query($conn, $cemeteryQuery);
        $cemeteryData = mysqli_fetch_assoc($cemeteryResult);
        $cemeteryName = $cemeteryData['CemeteryName'];

        // Build the description string
        $description = "-Grave purchase from $cemeteryName cemetery, Area: {$row['RowID']}, Grave Number: {$row['GraveNum']}";

        // Add the order row to the HTML content
        $htmlOrders .= '<tr>';
        $htmlOrders .= '<td style="width: 70%; font-size: 10px;">' . $description . '</td>'; // Adjust width for description column
        $htmlOrders .= '<td style="width: 30%; font-size: 10px;">Dummy Amount</td>'; // Adjust width for amount column
        $htmlOrders .= '</tr>';
    }

    // Close the orders table
    $htmlOrders .= '</table>';

    // Append orders table HTML to the main HTML content
    $html .= $htmlOrders;

    // Get the latest order
    mysqli_data_seek($result, 0); // Reset the result pointer
    $latestOrder = mysqli_fetch_assoc($result);

    // Calculate expiration date using the latest order's created date
    $createdAt = new DateTime($latestOrder['created_at']); // Assuming 'created_at' is in datetime format
    $expirationDate = $createdAt->modify('+2 days')->format('Y-m-d'); // Add 2 days to the latest order's created date

    // Add expiration date information to the HTML content
    $html .= '<p style="font-size: 10px; text-align: center;">Quotation expires on: ' . $expirationDate . '</p>';

    $subtotal_formatted = number_format($subtotal, 2);
$vat_total_formatted = number_format($vat_total, 2);
$grand_total_formatted = number_format($grand_total, 2);

$html .= '<p style="font-size: 15px; text-align: right; padding-right: 20px;">Sub Total: N$' . $subtotal_formatted . '</p>'; // Display Subtotal
$html .= '<p style="font-size: 15px; text-align: right; padding-right: 20px;">VAT 15%: N$' . $vat_total_formatted . '</p>'; // Display VAT total
$html .= '<p style="font-size: 15px; text-align: right; padding-right: 20px; font-weight: bold;">Total: N$' . $grand_total_formatted . '</p>'; // Display Grand Total



}

// Print HTML content to PDF
$pdf->writeHTML($html, true, false, true, false, '');







// Close PDF document
$pdfContent = $pdf->Output('GMS-Quotation.pdf', 'S');

// Clear output buffer
ob_end_clean();

// Send PDF file to browser
header('Content-Type: application/pdf');
echo $pdfContent;
?>
