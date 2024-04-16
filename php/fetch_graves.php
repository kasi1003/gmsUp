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

// Check if the selected_row parameter is set in the GET request
if(isset($_GET['selected_row'])) {
    // Retrieve the selected row ID from the GET request
    $selectedRow = $_GET['selected_row'];
    
    // Perform your database query to fetch grave numbers based on the selected row
    $query = "SELECT GraveNum FROM grave WHERE RowID = '$selectedRow' AND GraveStatus IS NULL";
    
    // Execute the query
    $result = $conn->query($query);
    
    // Check if the query was successful
    if($result) {
        // Initialize variables for counting and formatting
        $counter = 0; // Counter for checkboxes
        $checklist = '<div class="grave-list">'; // Container for the checklist
        $checklist .= '<h4>Available Graves</h4>'; // Text before the checklist
        $checklist .= '<form id="graveForm" method="post"><div class="checkbox-group">'; // Start form and checkbox group
        
        // Fetch the results and format them as a checklist
        while($row = $result->fetch_assoc()) {
            // Display 5 checkboxes horizontally before moving to the next row
            if ($counter % 5 == 0 && $counter != 0) {
                $checklist .= '</div><div class="checkbox-group">'; // Close and start a new checkbox group
            }
            $checklist .= '<label class="checkbox-item"><input type="checkbox" name="selected_graves[]" value="' . $row['GraveNum'] . '"> ' . $row['GraveNum'] . '</label>'; // Checkbox
            $counter++; // Increment counter
        }
        
        // Close form, checkbox group, and container
        $checklist .= '</div></form></div>';
        
        echo $checklist; // Output the checklist
    } else {
        // If the query fails, return an error message
        echo '<div class="error-message">Failed to fetch grave data.</div>';
    }
} else {
    // If the selected_row parameter is not set, return an error message
    echo '<div class="error-message">No row selected.</div>';
}

// Close the database connection
$conn->close();
?>
