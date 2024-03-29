<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../css/cemeteryMap.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
  <title>Document</title>
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
    </div>
  </nav>


  <section class="cemetery-map-section">
    <div class="card text-white bg-dark mb-3 border-secondary" style="width: 50%; margin: 2em; height: auto;">
      <div class="card-header border-secondary" style="font-size: 3em; display:width flex; justify-content: center;">
        <?php
        if (isset($_GET['cemetery_name'])) {
          echo htmlspecialchars($_GET['cemetery_name']);
        } else {
          echo "Cemetery Name Not Found";
        }
        ?>
      </div>
      <div class="card-body" style="padding-bottom: 20em;">
        <h3 class="container-headr">
          Click a section to book your number of Grave sites
        </h3>
        <?php
        // Check if CemeteryID is set
        if (isset($_GET['cemetery_id'])) {
          // Get the CemeteryID value
          $cemeteryID = $_GET['cemetery_id'];

          // Use a switch statement for different CemeteryID values
          switch ($cemeteryID) {
            case 7:
              // SVG for CemeteryID 7
              echo '
        <div id="svgMap" style="width: 100%; height: 50em;">
          <svg xmlns="http://www.w3.org/2000/svg" version="1.1" baseProfile="tiny" width="100%" height="300px" viewBox="0 0 800 600">
            <a href="../html/cemeteriesBooking.html">
              <g>
                <g stroke="#000000" stroke-width=".98" fill="#FFFFFF">
                  <path class="cem-section-back" d="m131.4 338.51l-38.27 28.75-36.93 214.86 110.36 12.88 220-14.79-2.29-94.56 166.39 65.24 193.14 16.95-45.06-88.72-57.89-38.41-107.09-28.46-94.6-21.06-56.5-17.99-42.72-5.89-25.73-5.15-.26 17.61 5.41 3.57-5.41 5.75 2.75 28.66 7.44 42.87-9.25.32-8.58-33.19-3.17-36.85-5.02-3.58 6.55-7.89-1.2-19.73-172.07-21.19z" />

                  <path class="cem-section" id="s1" d="m79.61 460.58l93.94 1.05.16-30.36 2.87-29.19-45.65-1.07-38.77-3.48-12.55 63.05z" />

                  <path class="cem-section" id="s2" d="m65.94 542.38l109.36 1.27.1-79.74-96.64-.66-12.82 79.13z" />

                  <path class="cem-section" id="s3" d="m65.7 548.31l-5.08 32.1 115.07 12.04-.07-44.36-109.92.22z" />

                  <path class="cem-section" id="s4" d="m181.02 528.4l.66 63.58 199.43-15.18-3.66-27.21-22.06-4.47-6.18-39.53-31.17-19.37-24.23 5.59-4.41 11.72-1.65 13.75 1.63 7.12-108.36 4z" />

                  <path class="cem-section" id="s5" d="m221.58 387.52l-38.57 14.25-2 121.57 102.31-3.01-.01-18.84 5.52-11.71 9.39-7.14 11.01-2.03 7.75-.52-1.04-16.33-6.65.01-3.81-22.46-6-31.2-1.64-16.37-7.19-7.12-23.83 2.75-17.68.6-27.56-2.45z" />

                  <path class="cem-section" id="s6" d="m324.6 451.31l2.34 13.12-3.38 21.03 28.1 17.19 6.94 40.6 23.86 5.85-.2-67.77 88.08 33.68 22.08 10.71 15.39-25.02-50.2-24.27-39.13-11.21-42.52-7.14-51.36-6.77z" />

                  <path class="cem-section" id="s7" d="m509.4 501.6l-15.45 24.59 57.33 23.29 184.34 13.18-13.03-28.13-164.55-17.31-48.64-15.62z" />

                  <path class="cem-section" id="s8" d="m316.13 364.91l-.61 12.39 6.79 6.34-5.55 4.62 1.3 16.72 137.61 19.27 4.26.46 4.03-26.01-81.79-22.48-66.04-11.31z" />

                  <path class="cem-section" id="s9" d="m430.24 464.8l28.14 8.01 52.37 26.12 11.11 4.44 34.28 9.2-4.02-16.3 10.98-25.04-131.09-18.59-1.77 12.16z" />

                  <path class="cem-section" id="s10" d="m566.77 473.12l-12.07 23.36 4.56 17.51 162.44 17.83-28.05-47.2-126.88-11.5z" />

                  <path class="cem-section" id="s11" d="m319.84 409.08l7.95 39.64 95.56 12.45 3.11-16.84 146.54 22.62 111.01 12.26-47.09-35.22-167.91-42.23-3.11 28.7-146.06-21.38z" />

                  <path class="cem-section-back" d="m138.94 302.23l174.61 22.29 120.21 24.34 92.45 24.17 15.49-12.97-6.13-70.26-58.16-2.41-1.81-24.78 16.55-1.04 2.42-15.02 23.86-1 1.23-12.26-1.11-15.76-77.88-1-12.87-11.82-7.91 10.34-48.99 2.94-23.44-17.72-29.21-75.03-7.44-4.46-5.86-13.29 3.71-7.39.41-72.95-5.89-1.53-.03-12.51-18.24-8.11-186.14 22.51 14.21 46.42 7.42 87.83-11.72 105.2 30.26 35.27z" />

                  <path class="cem-section" id="s12" d="m119.27 107.03l50.19-.95-.04-33.68-52.62 1.55 2.47 33.08z" />

                  <path class="cem-section" id="s13" d="m172.4 106.16l72.88-1.66-.13-33.25-73.02.66.27 34.25z" />

                  <path class="cem-section" id="s14" d="m248.58 72.35l.1 33.02 54.96.21 3.09-5.86-.38-27.15-57.77-.22z" />

                  <path class="cem-section" id="s15" d="m248.2 70.07l58.23.38.02-29.96-58.57-.47.32 30.05z" />

                  <path class="cem-section" id="s16" d="m171.91 42.24l-.11 28.04 73.08-1.1-.01-38.44-37.04 5.32-18.72 2.8-17.2 3.38z" />

                  <path class="cem-section" id="s17" d="m108.75 49.03l7.07 22.96 53.65-1.29-1.37-29.85-32.88 4.92-26.47 3.26z" />

                  <path class="cem-section" id="s18" d="m101.57 29.6l4.61 13.21 46.78-5.39 31.89-4.16 18.63-2.48 16.5-2.47 21.7-2.46-.38-13.91-139.73 17.66z" />

                  <path class="cem-section" id="s19" d="m247.42 38.35l59.58.07-.08-9.55-6.44-2.86.09-12.08-15.78-7.06-38 4.75.63 26.73z" />

                  <path class="cem-section" id="s20" d="m124.02 164.61l-7 63.27 50.87.78 2.02-120.16-49.21 2.1 3.32 54.01z" />

                  <path class="cem-section" id="s21" d="m174.24 109.76l-1.57 91.36 73.87-.41-1.29-92.08-71.01 1.13z" />

                  <path class="cem-section" id="s22" d="m250.65 200.07l54.58-.47-1.95-91.13-54.79-.25 2.16 91.85z" />

                  <path class="cem-section" id="s23" d="m114.6 264.2l26.44 33.87 164.54 20.77.78-114.18-132.64-.2.07 26.48-55.97.46-3.22 32.8z" />

                  <path class="cem-section" id="s24" d="m311.26 129.3l1.42 128.53 175.67 0 .7-15.43 24.17-.88.79-18.91-76.28-2.63-8.2-8.33-6.58 6.58-53.59 5.5-29.17-22.72-28.93-71.71z" />

                  <path class="cem-section" id="s25" d="m313.08 264.45l.31 53.95 209.29 48.37 13.68-9.24-4.9-64.07-59.09-2.85-2.08-27.91-157.21 1.75z" />

                  <path class="cem-section" id="s26" d="m97.9 372.86l-5.1 20.35 42.01 4.16 42.55-2.1 43.34-13.34 25.83 2.81 47.88-3.42 3.81-16.18-163.06-19.71-37.26 27.43z" />

                </g>
              </g>
            </a>
          </svg>

        </div>';
              break;

              // Add more cases for other CemeteryID values if needed

            default:
              // No map for display for other CemeteryID values
              echo '<p>No map for display</p>';
              break;
          }
        } else {
          // No CemeteryID provided
          echo '<p>No CemeteryID provided</p>';
        }
        ?>
      </div>
    </div>

    <div class="card text-white bg-dark mb-3 border-secondary" style="width: 20%; margin: 2em; height: 42em;">
      <div class="card-header border-secondary" style="font-size: 2em; display:width flex; justify-content: center;">
        Section Table</div>
      <div class="card-body" style="padding-bottom: 20em;">
        <h3 class="container-headr">
          Click a section to book your number of Grave sites
        </h3>


        <div id="table-div" style="width: 100%; max-height: 22rem;overflow: auto;">
          <?php
          $servername = "localhost";
          $username = "root";
          $password = "";
          $dbname = "htdb";

          $conn = new mysqli($servername, $username, $password, $dbname);

          if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
          }

          // Check if cemetery_name is set in the URL
          if (isset($_GET['cemetery_name'])) {
            $cemeteryName = $_GET['cemetery_name'];

            // 2. Use the cemetery_name to get the CemeteryID from the cemetery table
            $queryCemeteryID = "SELECT CemeteryID FROM cemetery WHERE CemeteryName = '$cemeteryName'";
            $resultCemeteryID = $conn->query($queryCemeteryID);

            if ($resultCemeteryID->num_rows > 0) {
              $rowCemeteryID = $resultCemeteryID->fetch_assoc();
              $cemeteryID = $rowCemeteryID['CemeteryID'];

              // 3. Use CemeteryID to fetch data from grave_sections table
              $querySections = "SELECT SectionCode, AvailableGraves FROM grave_sections WHERE CemeteryID = '$cemeteryID'";
              $resultSections = $conn->query($querySections);

              if ($resultSections->num_rows > 0) {
                // Output the HTML table opening tags
                echo '<table class="table table-hover table-dark">
                  <thead>
                      <tr>
                          <th scope="col">Section</th>
                          <th scope="col">Available Graves</th>
                      </tr>
                  </thead>
                  <tbody>';

                // Loop through the rows and generate table rows
                while ($rowSection = $resultSections->fetch_assoc()) {
                  $cemeteryID = $rowCemeteryID['CemeteryID'];
                  $sectionID = $rowSection['SectionCode'];
              
                  echo '<tr class="redirect-row" data-cemetery-id="' . $cemeteryID . '" data-section-id="' . $sectionID . '" style="cursor: pointer;">';
                  echo '<td>' . $sectionID . '</td>';
                  echo '<td>' . $rowSection['AvailableGraves'] . '</td>';
                  echo '</tr>';
              }
              
              
              // Output the HTML table closing tags
              echo '</tbody></table>';
              } else {
                // No rows found in grave_sections table
                echo '<p>No data available</p>';
              }
            } else {
              // No CemeteryID found for the given cemetery_name
              echo '<p>No data available</p>';
            }
          } else {
            // Cemetery name not set in the URL
            echo '<p>Cemetery name not found in the URL</p>';
          }

          // Close the database connection
          $conn->close();
          ?>



        </div>


      </div>
  </section>
  <div>
    <!-- Footer -->
    <footer class="text-center text-lg-start text-white" style="background-color: #1c2331">
      <!-- Section: Social media -->
      <section class="d-flex justify-content-between p-4" style="background-color: #6351ce">
        <!-- Left -->
        <div class="me-5">
          <span>Get connected with us on social networks:</span>
        </div>
        <!-- Left -->

        <!-- Right -->
        <div>
          <a href="" class="text-white me-4">
            <i class="fab fa-facebook-f"></i>
          </a>
          <a href="" class="text-white me-4">
            <i class="fab fa-twitter"></i>
          </a>
          <a href="" class="text-white me-4">
            <i class="fab fa-google"></i>
          </a>
          <a href="" class="text-white me-4">
            <i class="fab fa-instagram"></i>
          </a>
          <a href="" class="text-white me-4">
            <i class="fab fa-linkedin"></i>
          </a>
          <a href="" class="text-white me-4">
            <i class="fab fa-github"></i>
          </a>
        </div>
        <!-- Right -->
      </section>
      <!-- Section: Social media -->

      <!-- Section: Links  -->
      <section class="">
        <div class="container text-center text-md-start mt-5">
          <!-- Grid row -->
          <div class="row mt-3">
            <!-- Grid column -->
            <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
              <!-- Content -->
              <h6 class="text-uppercase fw-bold">Company name</h6>
              <hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background-color: #7c4dff; height: 2px" />
              <p>
                Here you can use rows and columns to organize your footer
                content. Lorem ipsum dolor sit amet, consectetur adipisicing
                elit.
              </p>
            </div>
            <!-- Grid column -->

            <!-- Grid column -->
            <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
              <!-- Links -->
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

            <!-- Grid column -->
            <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
              <!-- Links -->
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

            <!-- Grid column -->
            <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
              <!-- Links -->
              <h6 class="text-uppercase fw-bold">Contact</h6>
              <hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background-color: #7c4dff; height: 2px" />
              <p><i class="fas fa-home mr-3"></i> New York, NY 10012, US</p>
              <p><i class="fas fa-envelope mr-3"></i> info@example.com</p>
              <p><i class="fas fa-phone mr-3"></i> + 01 234 567 88</p>
              <p><i class="fas fa-print mr-3"></i> + 01 234 567 89</p>
            </div>
            <!-- Grid column -->
          </div>
          <!-- Grid row -->
        </div>
      </section>
      <!-- Section: Links  -->

      <!-- Copyright -->
      <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2)">
        © 2020 Copyright:
        <a class="text-white" href="https://mdbootstrap.com/">MDBootstrap.com</a>
      </div>
      <!-- Copyright -->
    </footer>
    <!-- Footer -->
  </div>
  <!-- End of .container -->
  <script src="../js/cemeteryMap.js"></script>
  <script async src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap">
  </script>
  
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>