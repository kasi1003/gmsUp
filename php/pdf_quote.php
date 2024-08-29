<?php
// Start output buffering
ob_start();

// Include the main TCPDF library (search for installation path).
require_once('../tcpdf/tcpdf.php');




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

session_start();

// Step 2: Retrieve the UserId from the session or generate a new one if not available
// Step 1: Retrieve the UserId from the session
if (isset($_SESSION['UserId'])) {
    $user_id = $_SESSION['UserId'];
} else {
    // Handle the case if UserId is not set
    // You might want to generate a new UserId or handle it differently based on your application logic
    die("UserId not found in session");
}

// Include TCPDF library
require_once('../tcpdf/tcpdf.php');
// Create new PDF instance
$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

// Set document information
$pdf->SetCreator('Your Company Name');
$pdf->SetAuthor('Your Name');
$pdf->SetTitle('Quotation');
$pdf->SetSubject('Quotation');

// Add a page
$pdf->AddPage();

// Set font
$pdf->SetFont('helvetica', '', 9);


// Start building HTML content
$html = '';
$html .= '<h1 style="color: #1788C6;">Quotation #' . '' . '</h1>';

// Add line with color #1788C6
$html .= '<div style="position: relative; width: 50%; border-top: 2px solid #1788C6;"></div>';

// Add company logo
$html .= '<img src="assets/img/logos.jpg" alt="Logo" style="width: 300px; margin-bottom: 200px, border-bottom:10px;">';
$html .= '<div><br></div>';
$html .= '<div><br></div>';

// Start building HTML content
$html = '<div></div>';


// Query to retrieve data from the orders table
$queryOrders = "SELECT CemeteryID, SectionCode, RowID, GraveNum, BuyerName, Email
                FROM orders
                WHERE UserId = ?";
$stmtOrders = $conn->prepare($queryOrders);
$stmtOrders->bind_param("s", $user_id);
$stmtOrders->execute();
$resultOrders = $stmtOrders->get_result();

// Store HTML content in a variable
$html .= "<h2>Ordered Graves</h2>";
$html .= "<table>";
$html .= '<tr style="background-color: #007bff; color: #ffffff;">';
$html .= '<th>CemeteryID</th><th>SectionCode</th><th>RowID</th><th>GraveNum</th><th>BuyerName</th><th>Email</th>';
$html .= '</tr>';
while ($rowOrders = $resultOrders->fetch_assoc()) {
    $html .= "<tr>";
    $html .= "<td>" . $rowOrders['CemeteryID'] . "</td>";
    $html .= "<td>" . $rowOrders['SectionCode'] . "</td>";
    $html .= "<td>" . $rowOrders['RowID'] . "</td>";
    $html .= "<td>" . $rowOrders['GraveNum'] . "</td>";
    $html .= "<td>" . $rowOrders['BuyerName'] . "</td>";
    $html .= "<td>" . $rowOrders['Email'] . "</td>";
    $html .= "</tr>";
}
$html .= "</table>";

// Query to retrieve data from the ordered_services table
$queryOrderedServices = "SELECT os.ServiceId, s.ServiceName, s.Price, s.ProviderId
                         FROM ordered_services os
                         INNER JOIN services s ON os.ServiceId = s.id
                         WHERE os.UserId = ?";

$stmtOrderedServices = $conn->prepare($queryOrderedServices);
$stmtOrderedServices->bind_param("s", $user_id);
$stmtOrderedServices->execute();
$resultOrderedServices = $stmtOrderedServices->get_result();

// Store HTML content in a variable
$html .= "<h2>Ordered Services</h2>";
$html .= "<table>";
$html .= '<tr style="background-color: #007bff; color: #ffffff;">';
$html .= '<th>ServiceName</th><th>Price</th><th>ProviderId</th>';
$html .= '</tr>';
while ($rowOrderedServices = $resultOrderedServices->fetch_assoc()) {
    $html .= "<tr>";
    $html .= "<td>" . $rowOrderedServices['ServiceName'] . "</td>";
    $html .= "<td>" . $rowOrderedServices['Price'] . "</td>";
    $html .= "<td>" . $rowOrderedServices['ProviderId'] . "</td>";
    $html .= "</tr>";
}
$html .= "</table>";// Output the PDF content
// Create new PDF instance
$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

// Set document information
$pdf->SetCreator('Your Company Name');
$pdf->SetAuthor('Your Name');
$pdf->SetTitle('Quotation');
$pdf->SetSubject('Quotation');

// Add a page
$pdf->AddPage();

// Set font
$pdf->SetFont('helvetica', '', 9);

// Write HTML content to PDF
$pdf->writeHTML($html, true, false, true, false, '');

// Close and output PDF document
$pdf->Output('quotation.pdf', 'I');

// Function to generate a unique quotation number
function generateQuotationNumber()
{
    $date = date('Ymd'); // Current date in YYYYMMDD format
    $randomNumber = mt_rand(1000, 9999); // Random 4-digit number
    return $date . $randomNumber;
}
