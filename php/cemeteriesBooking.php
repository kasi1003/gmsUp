<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/cemeteriesBooking.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-BPxTfN7eBUceU3W5Fs5IxFh+0ObJmo4Qh/a9x9vN1oQwvEJrhzMQ8biJrbUlf7nWhHr58Hh6gPuGvz6ARu94Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
    <title>Heavenly Tomb|Buy Graves</title>
</head>

<body>
    <?php
    include '../components/header.php'; // or include_once if you want to ensure it's included only once
    ?>


    <?php

    // Start a session
    session_start();

    // Check if UserId is already set in the session
    if (!isset($_SESSION['UserId'])) {
        // If UserId is not set, generate a new one
        $_SESSION['UserId'] = generateUserId();
    }

    // Function to generate a unique user ID
    function generateUserId()
    {
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
    }
    // Fetch SectionCode from URL (assuming it's passed as a query parameter)
    if (isset($_GET['selected_section'])) {
        $sectionCode = $conn->real_escape_string($_GET['selected_section']);
        // Fetch rows data based on SectionCode
        $sql = "SELECT DISTINCT RowID FROM `rows` WHERE SectionCode = '$sectionCode'";
        $result = $conn->query($sql);
        if (!$result) {
            die("Error fetching rows: " . $conn->error);
        }
    }

    // Fetch SectionCode from URL (assuming it's passed as a query parameter)
    if (isset($_GET['selected_section'])) {
        $sectionCode = $conn->real_escape_string($_GET['selected_section']);

        // Fetch section data including SVG based on SectionCode
        $sectionQuery = "SELECT SectionSvg FROM grave_sections WHERE SectionCode = '$sectionCode'";
        $sectionResult = $conn->query($sectionQuery);
        if (!$sectionResult) {
            die("Error fetching section data: " . $conn->error);
        }

        // Fetch SectionCode from URL (assuming it's passed as a query parameter)
        if (isset($_GET['selected_section'])) {
            $sectionCode = $conn->real_escape_string($_GET['selected_section']);

            // Fetch cemeteryID from the database based on sectionCode
            $cemeteryQuery = "SELECT CemeteryID FROM grave_sections WHERE SectionCode = '$sectionCode'";
            $cemeteryResult = $conn->query($cemeteryQuery);
            if ($cemeteryResult && $cemeteryResult->num_rows > 0) {
                $cemeteryData = $cemeteryResult->fetch_assoc();
                $cemeteryID = $cemeteryData['CemeteryID'];
            } else {
                // Handle the case when cemeteryID is not found
                $cemeteryID = ""; // Assign a default value or display an error message
            }
        }

        // Extract SVG data
        $sectionSvg = '';
        if ($sectionResult->num_rows > 0) {
            $sectionData = $sectionResult->fetch_assoc();
            $sectionSvg = $sectionData['SectionSvg'];
        }
    }
    ?>

    <section class="grave-booking-landing">
        <div class="card-body card-body-custom">
            <div class="card-header border-secondary" style="font-size: 2em">
                Grave selection
            </div>
            <div class="card-body">
                <div class="wrapper">
                    <h4>Buyer information</h4>
                    <!-- Display the SectionCode if available in the URL -->
                    <?php if (isset($sectionCode)) : ?>
                        <form id="graveForm">
                            <!-- Other input fields -->
                            <div class="input-group">
                                <div class="input-box">
                                    <input type="text" id="BuyerName" name="buyerName" placeholder="Full Name" required class="name" />
                                    <i class="fa fa-user icon"></i>
                                </div>
                            </div>
                            <div class="input-group">
                                <div class="input-box">
                                    <input id="idNumber" name="idNumber" type="text" placeholder="ID Number" required class="name" />
                                    <i class="fa fa-user icon"></i>
                                </div>
                            </div>
                            <div class="input-group">
                                <div class="input-box">
                                    <input type="email" id="Email" name="email" placeholder="Email Address (Optional)" class="name" />
                                    <i class="fa fa-envelope icon"></i>
                                </div>
                            </div>
                            <div class="input-group">
                                <div class="input-box">
                                    <input type="tel" id="PhoneNumber" name="phoneNumber" placeholder="Phone Number" required class="name" />
                                    <i class="fa fa-phone icon"></i>
                                </div>
                            </div>
                            <!-- Add hidden input fields for cemeteryID and sectionCode -->
                            <input type="hidden" name="cemeteryID" id="cemeteryID" value="<?php echo $cemeteryID; ?>">
                            <input type="hidden" name="sectionCode" value="<?php echo $sectionCode; ?>">
                            <input type="hidden" name="rowID" id="rowID" value="">
                            <input type="hidden" name="graveNums" id="graveNums" value="">
                        </form>

                        <h4>Rows</h4>
                        <div class="input-group" style="display: flex; flex-wrap: wrap;">
                            <div class="input-box" style="flex: 1;">
                                <?php if ($result && $result->num_rows > 0) : ?>
                                    <?php $counter = 0; ?>
                                    <div class="row-buttons-container">
                                        <?php while ($row = $result->fetch_assoc()) : ?>
                                            <!-- Use JavaScript to prevent default form submission and fetch grave numbers -->
                                            <div class="row-button">
                                                <button type="button" onclick="fetchGraves('<?php echo $row['RowID']; ?>')" class="btn btn-primary" data-row-id="<?php echo $row['RowID']; ?>">
                                                    <?php echo substr($row['RowID'], -1); ?>
                                                </button>
                                            </div>
                                            <?php
                                            $counter++;
                                            if ($counter % 3 == 0) : // Check if three buttons have been added 
                                            ?>
                                    </div>
                                    <div class="row-buttons-container"> <!-- Start a new row -->
                                    <?php endif; ?>
                                <?php endwhile; ?>
                                    </div>
                                <?php else : ?>
                                    <p>No rows available</p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <!-- Box to display graves -->
                        <div class="grave-box" id="grave-box">
                            <h4>Available Graves</h4>
                            <!-- The content will be dynamically updated here -->
                        </div>
                        <!-- Submit button -->
                        <button type="button" onclick="submitOrder()" class="btn btn-primary">Submit Order</button>
                    <?php endif; ?>
                </div>
            </div>

            <button type="button" onclick="navigateToServiceProvidersPage()" class="btn btn-primary">Continue</button>
            <button type="button" onclick="navigateQuotation()" class="btn btn-primary">Quotation</button>
            <script>
                // Function to navigate to serviceProvidersPage.php
                function navigateToServiceProvidersPage() {
                    // Redirect to serviceProvidersPage.php
                    window.location.href = "../php/serviceProvidersPage.php";
                }

                function navigateQuotation() {
                    // Redirect to servicequotationPage.php
                    window.location.href = "quotations.php";
                }
            </script>

        </div>
        <?php if (!empty($sectionSvg)) : ?>
            <div class="svg-container">
                <h4>Cemetery section map</h4>
                <?php echo $sectionSvg; ?>
            </div>
        <?php endif; ?>



    </section>



    <!-- Script to handle asynchronous request and update the grave-box content -->
    <script>
        // Function to fetch graves and highlight the selected row button
        function fetchGraves(rowID) {
            // Remove the highlighted class from all buttons
            const buttons = document.querySelectorAll('.row-button button');
            buttons.forEach(button => {
                button.classList.remove('highlighted-button');
            });

            // Add the highlighted class to the last pressed button
            const lastPressedButton = document.querySelector(`button[data-row-id='${rowID}']`);
            if (lastPressedButton) {
                lastPressedButton.classList.add('highlighted-button');
            }

            // Store the last selected row ID in local storage
            localStorage.setItem('lastSelectedRow', rowID);

            // Add the selected rowID to the form data
            document.getElementById('rowID').value = rowID;

            // Clear any previous selection of grave numbers
            document.getElementById('graveNums').value = '';

            // Make an AJAX request to fetch available graves for the selected row
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // Update the HTML content of the grave box with the fetched data
                    document.getElementById("grave-box").innerHTML = this.responseText;

                    // Add event listeners to checkboxes to capture selected grave numbers
                    const checkboxes = document.querySelectorAll('.checkbox-item input[type="checkbox"]');
                    checkboxes.forEach(checkbox => {
                        checkbox.addEventListener('change', function() {
                            updateSelectedGraveNums();
                        });
                    });
                }
            };
            xhttp.open("GET", "fetch_graves.php?selected_row=" + rowID, true);
            xhttp.send();
        }

        // Function to update the selected grave numbers
        function updateSelectedGraveNums() {
            const selectedGraveNums = [];
            const checkboxes = document.querySelectorAll('.checkbox-item input[type="checkbox"]:checked');
            checkboxes.forEach(checkbox => {
                selectedGraveNums.push(checkbox.value);
            });
            document.getElementById('graveNums').value = selectedGraveNums.join(',');
        }


        // Function to handle form submission
        function submitOrder() {
            // Get the form containing selected graves
            const selectedGravesForm = document.getElementById('graveForm');

            // Log form data before sending
            console.log("Form data before sending:");
            const formData = new FormData(selectedGravesForm);
            for (var pair of formData.entries()) {
                console.log(pair[0] + ': ' + pair[1]);
            }

            // Extract the selected grave numbers
            const selectedGraveNums = [];
            const checkboxes = document.querySelectorAll('.checkbox-item input[type="checkbox"]:checked');
            checkboxes.forEach(checkbox => {
                selectedGraveNums.push(checkbox.value);
            });

            // Add selected grave numbers to the hidden input field
            document.getElementById('graveNums').value = selectedGraveNums.join(',');

            // Store the form data in local storage before sending
            storeFormDataInLocalStorage(selectedGravesForm);

            // Make an AJAX request to process the order
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // Handle the response from the server
                    // For example, display a success message to the user
                    alert("Order submitted successfully!");
                    // Clear local storage after successful submission
                    localStorage.removeItem('selectedGraves');
                    // Reload the page after a delay of 2 seconds (2000 milliseconds)
                    setTimeout(function() {
                        window.location.reload();
                    }, 2000);
                }
            };
            xhttp.open("POST", "process_order.php", true);
            xhttp.send(formData); // Send form data object

            // Log form data after sending
            console.log("Form data after sending:");
            for (var pair of formData.entries()) {
                console.log(pair[0] + ': ' + pair[1]);
            }
        }

        // Function to populate form fields with data from local storage
        function populateFormFieldsFromLocalStorage(form) {
            const formData = new FormData(form);
            for (var pair of formData.entries()) {
                const storedValue = localStorage.getItem(pair[0]);
                if (storedValue) {
                    // Set the stored value to the form field
                    const inputField = form.querySelector(`[name='${pair[0]}']`);
                    if (inputField) {
                        inputField.value = storedValue;
                    }
                }
            }
        }

        // Function to store form data in local storage
        function storeFormDataInLocalStorage(form) {
            const formData = new FormData(form);
            for (var pair of formData.entries()) {
                localStorage.setItem(pair[0], pair[1]);
            }
        }

        // Function to handle page load
        function onPageLoad() {
            // Populate form fields with data from local storage
            const selectedGravesForm = document.getElementById('graveForm');
            populateFormFieldsFromLocalStorage(selectedGravesForm);

            // Store form data in local storage after populating the fields
            storeFormDataInLocalStorage(selectedGravesForm);

            // Retrieve the last selected row ID from local storage and highlight the corresponding button
            highlightLastSelectedRow();
        }

        // Call onPageLoad function when the page loads
        window.onload = onPageLoad;


        // Function to retrieve the last selected row ID from local storage and highlight the corresponding button
        function highlightLastSelectedRow() {
            const lastSelectedRow = localStorage.getItem('lastSelectedRow');
            if (lastSelectedRow) {
                fetchGraves(lastSelectedRow);
            }
        }


        // Call the function to highlight the last selected row when the page loads
        window.onload = highlightLastSelectedRow;
    </script>









    <div>
        <!-- Footer -->
        <?php
        include '../components/footer.php'; // or include_once if you want to ensure it's included only once
        ?>
        <!-- Footer -->
    </div>
    <!-- End of .container -->

    <script src="../js/cemeteriesBooking.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>