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

if (isset($_GET['id']) && isset($_GET['type'])) {
    $id = $_GET['id'];
    $type = $_GET['type'];
    if ($type == 'user') {
        $sql = "DELETE FROM Users WHERE UserID = $id";
    } elseif ($type == 'flight') {
        $sql = "DELETE FROM Flights WHERE FlightID = $id";
    } elseif ($type == 'hotel') {
        $sql = "DELETE FROM Hotels WHERE HotelID = $id";
    } elseif ($type == 'package') {
        $sql = "DELETE FROM Packages WHERE PackageID = $id";
    }

    if ($conn->query($sql) === TRUE) {
        header("Location: viewData.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close connection
$conn->close();
?>
