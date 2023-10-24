<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/cemeteryMap.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-BPxTfN7eBUceU3W5Fs5IxFh+0ObJmo4Qh/a9x9vN1oQwvEJrhzMQ8biJrbUlf7nWhHr58Hh6gPuGvz6ARu94Q=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
    <title>Document</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="../html/index.html">Home</a>

                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Service Providers
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink" id="serviceProvidersDropdown">
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../php/quotation.php">Quotation Feedback</a>
                </li>

            </ul>
        </div>
    </nav>


    <section class="cemetery-map-section">
        <div class="card text-center w-100 bg-dark border-secondary m-4">
            <div class="card-header border-secondary bg-dark">
                <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Cemetery Table</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Simple Map</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Google Maps</a>
                    </li>

                </ul>
            </div>
            <div class="card-body">
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "htdb";

                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Step 1: Retrieve CemeteryName from the URL
                $cemeteryName = mysqli_real_escape_string($conn, $_GET["cemeteryName"]); // Get the CemeteryName from the URL
                
                // Query the cemeteries table for CemeteryID based on CemeteryName
                $sql = "SELECT CemeteryID FROM cemeteries WHERE CemeteryName = '$cemeteryName'";
                $result = $conn->query($sql);

                // Check if there is a result
                if ($result->num_rows > 0) {
                    // Fetch the CemeteryID from the result
                    $row = $result->fetch_assoc();
                    $cemeteryID = $row['CemeteryID'];
                } else {
                    // Set a default ID or error handling if the CemeteryName is not found
                    $cemeteryID = -1; // You can set a default value or handle the error as needed
                }

                $conn->close();
                ?>

                <h3 class="card-title" style="color: white;">
                    <?php echo $cemeteryName; ?>
                </h3>

                <?php
                // Step 3: Fetch sections based on CemeteryID
                $conn = new mysqli($servername, $username, $password, $dbname);
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT SectionCode, AvailableGraves FROM sections WHERE CemeteryID = $cemeteryID";
                $result = $conn->query($sql);

                // Step 4: Create the table with column names
                if ($result->num_rows > 0) {
                    echo '<div class="table-responsive">';
                    echo '<table class="table table-hover table-dark">';
                    echo '<thead><tr>';
                    while ($row = $result->fetch_assoc()) {
                        echo '<th>' . $row['SectionCode'] . '</th>';
                    }
                    echo '</tr></thead><tbody>';

                    // Step 5: Populate the table with AvailableGraves
                    $result->data_seek(0);
                    echo '<tr>';
                    while ($row = $result->fetch_assoc()) {
                        echo '<td>' . $row['AvailableGraves'] . '</td>';
                    }
                    echo '</tr></tbody></table></div>';
                } else {
                    echo '<div style="color: white;">No sections found for this cemetery.</div>';
                }

                $conn->close();
                ?>
            </div>

        </div>



    </section>
    <script src="../js/cemeteryMap.js"></script>
    <script async src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap">
    </script>
    <script>
        (g => { var h, a, k, p = "The Google Maps JavaScript API", c = "google", l = "importLibrary", q = "__ib__", m = document, b = window; b = b[c] || (b[c] = {}); var d = b.maps || (b.maps = {}), r = new Set, e = new URLSearchParams, u = () => h || (h = new Promise(async (f, n) => { await (a = m.createElement("script")); e.set("libraries", [...r] + ""); for (k in g) e.set(k.replace(/[A-Z]/g, t => "_" + t[0].toLowerCase()), g[k]); e.set("callback", c + ".maps." + q); a.src = `https://maps.${c}apis.com/maps/api/js?` + e; d[q] = f; a.onerror = () => h = n(Error(p + " could not load.")); a.nonce = m.querySelector("script[nonce]")?.nonce || ""; m.head.append(a) })); d[l] ? console.warn(p + " only loads once. Ignoring:", g) : d[l] = (f, ...n) => r.add(f) && u().then(() => d[l](f, ...n)) })({
            key: "YOUR_API_KEY",
            v: "weekly",
            // Use the 'v' parameter to indicate the version to use (weekly, beta, alpha, etc.).
            // Add other bootstrap parameters as needed, using camel case.
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
</body>

</html>