<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/cemeteriesBooking.css" />
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
    <title>Heavenly Tomb|Buy Graves</title>
  </head>

  <body>
  <?php
  include '../components/header.php'; // or include_once if you want to ensure it's included only once
  ?>

    
    <?php
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
if(isset($_GET['selected_section'])) {
  $sectionCode = $conn->real_escape_string($_GET['selected_section']);
  // Fetch rows data based on SectionCode
  $sql = "SELECT DISTINCT RowID FROM `rows` WHERE SectionCode = '$sectionCode'";
  $result = $conn->query($sql);
  if (!$result) {
    die("Error fetching rows: " . $conn->error);
  }
}

// Fetch GraveNum based on selected RowID
if(isset($_GET['selected_row'])) {
    $selectedRow = $_GET['selected_row'];
    $graveQuery = "SELECT GraveNum FROM grave WHERE RowID = '$selectedRow'";
    // Execute query and fetch results
    $graveResult = $conn->query($graveQuery);
    if ($graveResult && $graveResult->num_rows > 0) {
        while($graveRow = $graveResult->fetch_assoc()) {
            echo "<li>" . $graveRow['GraveNum'] . "</li>";
        }
    } else {
        echo "<li>No graves available</li>";
    }
}
// Fetch SectionCode from URL (assuming it's passed as a query parameter)
if(isset($_GET['selected_section'])) {
  $sectionCode = $conn->real_escape_string($_GET['selected_section']);
  
  // Fetch section data including SVG based on SectionCode
  $sectionQuery = "SELECT SectionSvg FROM grave_sections WHERE SectionCode = '$sectionCode'";
  $sectionResult = $conn->query($sectionQuery);
  if (!$sectionResult) {
    die("Error fetching section data: " . $conn->error);
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
    <div class="card text-white bg-dark mb-3 border-secondary" style="max-width: 90%">
        <div class="card-header border-secondary" style="font-size: 2em">
            Payment For Graves
        </div>
        <div class="card-body">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="wrapper">
                    <h4>Account</h4>
                    <!-- Display the SectionCode if available in the URL -->
                
                    <?php if(isset($sectionCode)): ?>
                    
                    <?php endif; ?>
                    <!-- Other input fields -->
                    <div class="input-group">
                        <div class="input-box">
                            <input type="text" name="buyerName" placeholder="Full Name" required class="name" />
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
                            <input type="email" name="email" placeholder="Email Address (Optional)" class="name" />
                            <i class="fa fa-envelope icon"></i>
                        </div>
                    </div>
                    <div class="input-group">
                        <div class="input-box">
                            <input type="tel" name="phoneNumber" placeholder="Phone Number" required class="name" />
                            <i class="fa fa-phone icon"></i>
                        </div>
                    </div>
                    <h4>Account</h4>
                    <!-- Dropdown select for RowID -->
                    <div class="input-group">
                        <div class="input-box">
                            <select name="rowID" required>
                                <option value="">Select Row</option>
                                <?php if ($result && $result->num_rows > 0): ?>
                                    <?php while($row = $result->fetch_assoc()): ?>
                                        <option value="<?php echo $row['RowID']; ?>"><?php echo $row['RowID']; ?></option>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <option value="">No rows available</option>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>
                    <!-- Display GraveNum results -->
                    <ul>
                        <?php if(isset($graveResult)): ?>
                            <?php if ($graveResult->num_rows > 0): ?>
                                <?php while($graveRow = $graveResult->fetch_assoc()): ?>
                                    <li><?php echo $graveRow['GraveNum']; ?></li>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <li>No graves available</li>
                            <?php endif; ?>
                        <?php else: ?>
                            <li>Error fetching graves</li>
                        <?php endif; ?>
                    </ul>
                    <!-- Replace this with your existing input fields -->
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
    <?php if(!empty($sectionSvg)): ?>
                        <div class="svg-container">
                            <?php echo $sectionSvg; ?>
                        </div>
                    <?php endif; ?>
</section>






    <div>
    <!-- Footer -->
    <?php
    include '../components/footer.php'; // or include_once if you want to ensure it's included only once
    ?>
    <!-- Footer -->
  </div>
  <!-- End of .container -->

    <script src="../js/cemeteriesBooking.js"></script>
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
