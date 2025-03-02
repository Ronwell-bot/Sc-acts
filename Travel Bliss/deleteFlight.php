<?php
// Database connection
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "travel_bliss";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM Flights WHERE FlightID = $id";
    if ($conn->query($sql) === TRUE) {
        header("Location: viewData.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close connection
$conn->close();
?>
