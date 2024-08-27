<?php
header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "htdb (1)";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle AJAX request
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['fetch'])) {
    // Your SQL query
    $sql = "SELECT Name, Email, ContactNumber, TotalBurials, SuccessfulBurials, UnsuccessfulBurials FROM service_providers";

    // Execute the query
    $result = $conn->query($sql);

    // Fetch results
    $providers = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $providers[] = $row;
        }
    }

    // Return results as JSON
    echo json_encode($providers);

    // Close connection
    $conn->close();

    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/serviceProvidersPage.css" />
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
</head>

<body>
    <?php include '../components/header.php'; ?>

    <!-- Home landing page -->
    <section class="top-container">
        <div class="card border-secondary bg-dark mb-3" style="width: 98%; margin: 30px;">
            <div class="card-header border-secondary">
                <h1 class="service-providers-header-text text-light" style="display: flex; justify-content: center;">Service Providers</h1>
                <p class="service-providers-subheading text-light" style="display: flex; justify-content: center;">
                    Select your Service Provider to assist.
                </p>
            </div>
            <div class="card-body text-secondary">
                <!-- Service providers details -->
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="basic-addon1" />
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-dark">
                        <thead>
                            <tr>
                                <th scope="col">Ranking</th>
                                <th scope="col">Company Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Contact Number</th>
                                <th scope="col">Total Conducted Burials</th>
                                <th scope="col">Unsatisfied Burials</th>
                                <th scope="col">Satisfied Burials</th>
                            </tr>
                        </thead>
                        <tbody id="serviceProvidersTableBody">
                            <!-- Data will be loaded here by JS -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="text-center text-lg-start text-white" style="background-color: #1c2331">
        <!-- Section: Social media -->
        <section class="d-flex justify-content-between p-4" style="background-color: #6351ce">
            <!-- Left -->
            <div class="me-5">
                <span>Get connected with us on social networks:</span>
            </div>
            <!-- Right -->
            <div>
                <a href="#" class="text-white me-4">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="#" class="text-white me-4">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="#" class="text-white me-4">
                    <i class="fab fa-google"></i>
                </a>
                <a href="#" class="text-white me-4">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="#" class="text-white me-4">
                    <i class="fab fa-linkedin"></i>
                </a>
                <a href="#" class="text-white me-4">
                    <i class="fab fa-github"></i>
                </a>
            </div>
        </section>
        <!-- Section: Links -->
        <section class="">
            <div class="container text-center text-md-start mt-5">
                <!-- Grid row -->
                <div class="row mt-3">
                    <!-- Grid column -->
                    <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                        <h6 class="text-uppercase fw-bold">Company name</h6>
                        <hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background-color: #7c4dff; height: 2px" />
                        <p>
                            Here you can use rows and columns to organize your footer
                            content. Lorem ipsum dolor sit amet, consectetur adipisicing
                            elit.
                        </p>
                    </div>
                    <!-- Grid column -->
                    <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                        <h6 class="text-uppercase fw-bold">Products</h6>
                        <hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background-color: #7c4dff; height: 2px" />
                        <p>
                            <a href="#!" class="text-white">MDBootstrap</a>
                        </p>
                        <p>
                            <a href="#!" class="text-white">MDWordPress</a>
                        </p>
                        <p>
                            <a href="#!" class="text-white">BrandFlow</a>
                        </p>
                        <p>
                            <a href="#!" class="text-white">Bootstrap Angular</a>
                        </p>
                    </div>
                    <!-- Grid column -->
                    <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                        <h6 class="text-uppercase fw-bold">Useful links</h6>
                        <hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background-color: #7c4dff; height: 2px" />
                        <p>
                            <a href="#!" class="text-white">Your Account</a>
                        </p>
                        <p>
                            <a href="#!" class="text-white">Become an Affiliate</a>
                        </p>
                        <p>
                            <a href="#!" class="text-white">Shipping Rates</a>
                        </p>
                        <p>
                            <a href="#!" class="text-white">Help</a>
                        </p>
                    </div>
                    <!-- Grid column -->
                    <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                        <h6 class="text-uppercase fw-bold">Contact</h6>
                        <hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background-color: #7c4dff; height: 2px" />
                        <p><i class="fas fa-home mr-3"></i> New York, NY 10012, US</p>
                        <p><i class="fas fa-envelope mr-3"></i> info@example.com</p>
                        <p><i class="fas fa-phone mr-3"></i> + 01 234 567 88</p>
                        <p><i class="fas fa-print mr-3"></i> + 01 234 567 89</p>
                    </div>
                </div>
            </div>
        </section>
        <!-- Copyright -->
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2)">
            © 2020 Copyright:
            <a class="text-white" href="https://mdbootstrap.com/">MDBootstrap.com</a>
        </div>
    </footer>

    <script src="../js/serviceproviders.js"></script>
</body>
</html>
