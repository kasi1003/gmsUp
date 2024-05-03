<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "htdb";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$fullName = $_GET['fullName'];
$deathNumber = $_GET['deathNumber'];

$sql = "SELECT * FROM grave WHERE BuriedPersonsName = '$fullName' AND DeathCode = '$deathNumber'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "ID: " . $row["id"]. " - Cemetery ID: " . $row["CemeteryID"]. " - Section Code: " . $row["SectionCode"]. " - Row ID: " . $row["RowID"]. " - Grave Number: " . $row["GraveNum"]. "<br>";
  }
} else {
  echo "0 results";
}
$conn->close();
?>
