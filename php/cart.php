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


<body>
    <?php
    include '../components/header.php';
    include '../components/db.php';
    session_start();

    if (isset($_SESSION['UserId'])) {
        $user_id = $_SESSION['UserId'];
    } else {
        // Set UserId to PHPSESSID
        // Set UserId to PHPSESSID if not already set
        $_SESSION['UserId'] = session_id();
        $user_id = $_SESSION['UserId'];

        // Function to generate a unique user ID
        function generateUserId()
        {
            // Use a simple method to generate a unique user ID
            return 'User_' . uniqid(); // Example format: User_randomUniqueId
        }
    }
    ?>


    <section class="top-container pr-4">

        <div style="display: flex; flex-direction: column; width: 100%" style="display: flex; justify-content: center;">
            <h1 class="service-providers-header-text pt-3 text-light" style="display: flex; justify-content: center;">
                Cart</h1>
            <div class="card border-secondary bg-dark mb-3" style="width: 98%; height: 45%; margin-left: 1.5rem;">
                <div class="card-header border-secondary">
                    <h1 class="service-providers-header-text text-light">
                        Graves Ordered</h1>
                </div>

                <div class="card-body text-secondary">
                    <?php


                    // Database connection details
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

                    // Your SQL query to get ServiceIds from ordered_services
                    $sql = "SELECT ServiceId FROM ordered_services WHERE UserId = '$user_id'";
                    $result = $conn->query($sql);

                    // Check if there are any results
                    if ($result->num_rows > 0) {
                        // Array to hold services data
                        $services_data = [];

                        while ($row = $result->fetch_assoc()) {
                            $service_id = $row['ServiceId'];

                            // Query to get details from services table
                            $sql_service = "SELECT ServiceName, Description, Price, ProviderId FROM services WHERE id = '$service_id'";
                            $result_service = $conn->query($sql_service);

                            if ($result_service->num_rows > 0) {
                                $service = $result_service->fetch_assoc();

                                // Query to get provider name from service_providers table
                                $provider_id = $service['ProviderId'];
                                $sql_provider = "SELECT Name FROM service_providers WHERE id = '$provider_id'";
                                $result_provider = $conn->query($sql_provider);

                                if ($result_provider->num_rows > 0) {
                                    $provider = $result_provider->fetch_assoc();
                                    $service['ProviderName'] = $provider['Name'];
                                } else {
                                    $service['ProviderName'] = 'Unknown Provider';
                                }

                                $services_data[] = $service;
                            }
                        }

                        // Output table header
                        echo '
    <table class="table table-dark">
        <thead>
            <tr>
                <th scope="col">Service Name</th>
                <th scope="col">Description</th>
                <th scope="col">Price</th>
                <th scope="col">Provider Name</th>
            </tr>
        </thead>
        <tbody>
    ';

                        // Loop through each service data and output table rows
                        foreach ($services_data as $service) {
                            echo '
        <tr>
            <td>' . $service['ServiceName'] . '</td>
            <td>' . $service['Description'] . '</td>
            <td>' . $service['Price'] . '</td>
            <td>' . $service['ProviderName'] . '</td>
        </tr>
        ';
                        }

                        // Close table body and table
                        echo '
        </tbody>
    </table>
    ';
                    } else {
                        // If no results found
                        echo "No services found for this user.";
                    }

                    // Close connection
                    $conn->close();
                    ?>

                </div>
            </div>
            <div class="card border-secondary bg-dark mb-3" style="width: 98%; height: 45%; margin-left: 1.5rem;">
                <div class="card-header border-secondary">
                    <h1 class="service-providers-header-text text-light">
                        Services Ordered</h1>
                </div>

                <div class="card-body text-secondary">
                    <div class="table-responsive">
                        <table class="table table-dark">
                            <thead>
                                <tr>
                                    <th scope="col">Service Provider Name</th>
                                    <th scope="col">Service Name</th>
                                    <th scope="col">Service Description</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>

                                </tr>
                            </tbody>
                        </table>


                    </div>
                </div>
            </div>
        </div>



    </section>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="../js/serviceProvidersPage.js"></script>

</body>

</html>