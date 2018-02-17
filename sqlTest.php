<!DOCTYPE html>
<html lang="en">
<head>

</head>
<body>

<?php
$servername = "localhost";
$username = "kingcolb";
$password = "euo9vSff";
$dbname = "schema2";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT name,lat,lng FROM bars ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "NAME: " . $row["name"] . "  DESCRIPTION: " . $row["lng"] . "<br>";
    }
} else {
    echo "0 results";
}
$conn->close();
?>




</body>
</html>