<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "htdb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve the region parameter from the URL
$region = $_GET["region"];
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="../css/khomas.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
      integrity="sha512-BPxTfN7eBUceU3W5Fs5IxFh+0ObJmo4Qh/a9x9vN1oQwvEJrhzMQ8biJrbUlf7nWhHr58Hh6gPuGvz6ARu94Q=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
      integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
      crossorigin="anonymous"
    />
  </head>

  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
      <button
        class="navbar-toggler"
        type="button"
        data-toggle="collapse"
        data-target="#navbarNav"
        aria-controls="navbarNav"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="index.html">Home</a>
          </li>
          <li class="nav-item dropdown">
            <a
              class="nav-link dropdown-toggle"
              href="service-providers-page.html"
              id="navbarDropdownMenuLink"
              role="button"
              data-toggle="dropdown"
              aria-haspopup="true"
              aria-expanded="false"
            >
              Service Providers
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="avbobPage.html">AVBOB</a>
              <a class="dropdown-item" href="service-providers-page.html"
                >View More</a
              >
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="cemeteries.html">Buy a Grave</a>
          </li>
        </ul>
      </div>
    </nav>
    <!--home landing page-->
    <section class="topSection">
      <div
        class="card border-secondary bg-dark mb-3"
        style="width: 98%; margin: 30px;"
      >
        <div class="card-header border-secondary">
          <h1 class="service-providers-header-text"><?php echo $region; ?> Region</h1>
          <p class="service-providers-subheading">
            Bellow you will find all cemeteries in <?php echo $region; ?> Region
          </p>
        </div>
        <div class="card-body text-secondary">
          <!--service providers details, maybe use table instead that pulls from database-->
          <div class="input-group mb-3">
            
            <input
              type="text"
              class="form-control"
              placeholder="Search Cemetery"
              aria-label=""
              aria-describedby="basic-addon1"
            />
          </div>
          <table class="table table-hover table-dark">
            <thead>
              <tr>
                <th scope="col">Cemetery Name</th><!--should pull form CemeteryName column-->
                <th scope="col">Number of Sections</th><!--should pull form NumberOfSections column-->
                <th scope="col">Town</th><!--should pull form Town column-->
                <th scope="col">Total Graves</th><!--should pull form Total Graves column-->
                <th scope="col">Available Graves</th><!--should pull form Available Graves column-->
                <th scope="col">Location</th><!--should pull form Available Graves column-->


              </tr>
            </thead>
            <tbody id="display">
              <tr id="clickable-row" class="redirect-row" style="cursor: pointer">
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "htdb";

                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error)  {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Retrieve the region parameter from the URL
                $region = $_GET["region"];

                // Query the cemeteries table for rows matching the region
                $sql = "SELECT * FROM cemeteries WHERE Region = '$region'";
                $result = $conn->query($sql);

                // Check if there are rows to display
                if ($result->num_rows > 0) {
                // Loop through the rows and generate table rows
                while ($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<tr class="redirect-row" style="cursor: pointer" onclick="window.location.href=\'../php/cemeteryMap.php?cemetery_id=' . $row['CemeteryID'] . '&cemetery_name=' . urlencode($row['CemeteryName']) . '\';">';
                    echo '<td>' . $row['CemeteryName'] . '</td>';
                    echo '<td>' . $row['NumberOfSections'] . '</td>';
                    echo '<td>' . $row['Town'] . '</td>';
                    echo '<td>' . $row['TotalGraves'] . '</td>';
                    echo '<td>' . $row['AvailableGraves'] . '</td>';
                    echo'<td><a class="btn btn-primary" href="#" role="button"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M8 1a3 3 0 1 0 0 6 3 3 0 0 0 0-6zM4 4a4 4 0 1 1 4.5 3.969V13.5a.5.5 0 0 1-1 0V7.97A4 4 0 0 1 4 3.999zm2.493 8.574a.5.5 0 0 1-.411.575c-.712.118-1.28.295-1.655.493a1.319 1.319 0 0 0-.37.265.301.301 0 0 0-.057.09V14l.002.008a.147.147 0 0 0 .016.033.617.617 0 0 0 .145.15c.165.13.435.27.813.395.751.25 1.82.414 3.024.414s2.273-.163 3.024-.414c.378-.126.648-.265.813-.395a.619.619 0 0 0 .146-.15.148.148 0 0 0 .015-.033L12 14v-.004a.301.301 0 0 0-.057-.09 1.318 1.318 0 0 0-.37-.264c-.376-.198-.943-.375-1.655-.493a.5.5 0 1 1 .164-.986c.77.127 1.452.328 1.957.594C12.5 13 13 13.4 13 14c0 .426-.26.752-.544.977-.29.228-.68.413-1.116.558-.878.293-2.059.465-3.34.465-1.281 0-2.462-.172-3.34-.465-.436-.145-.826-.33-1.116-.558C3.26 14.752 3 14.426 3 14c0-.599.5-1 .961-1.243.505-.266 1.187-.467 1.957-.594a.5.5 0 0 1 .575.411z"/>
                  </svg></a>
                    </td>';
                    echo '</tr>';
                }
                } else {
                // No rows found
                    echo '<tr><td colspan="5">No data available</td></tr>';
                }

                // Close the database connection
                $conn->close();
                ?>

             
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </section>
    <script src="../js/khomas.js"></script>
    <script
      src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
      integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
      integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
      integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
