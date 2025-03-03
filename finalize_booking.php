<?php
$servername = "127.0.0.1";
$username = "root";
$password = "weneklek";
$dbname = "travel_bliss";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(["success" => false, "message" => "Connection failed: " . $conn->connect_error]));
}

$data = json_decode(file_get_contents("php://input"), true);
$packageID = $data['packageID'];
$packageName = $data['packageName'];
$place = $data['place'];
$startDate = $data['startDate'];
$endDate = $data['endDate'];
$price = $data['price'];
$details = $data['details'];
$userID = 7; // Assuming a logged-in user with ID 7 for this example

$sql_booking = "INSERT INTO Bookings (UserID, PackageID, PackageName, Place, StartDate, EndDate, Price, Details, Status) 
                VALUES ($userID, $packageID, '$packageName', '$place', '$startDate', '$endDate', $price, '$details', 'Confirmed')";
if ($conn->query($sql_booking) === TRUE) {
    echo json_encode(["success" => true, "message" => "Booking successful!"]);
} else {
    echo json_encode(["success" => false, "message" => "Error: " . $sql_booking . "<br>" . $conn->error]);
}

$conn->close();
?>
