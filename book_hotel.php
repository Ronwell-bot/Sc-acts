<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    die(json_encode(['success' => false, 'message' => 'User not logged in']));
}

$servername = "127.0.0.1";
$username = "root";
$password = "weneklek";
$dbname = "travel_bliss";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    error_log("Connection failed: " . $conn->connect_error);
    die(json_encode(['success' => false, 'message' => 'Connection failed: ' . $conn->connect_error]));
}

// Get the JSON data from the request
$data = json_decode(file_get_contents('php://input'), true);

$hotelID = $data['hotelID'];
$hotelName = $data['hotelName'];
$hotelLocation = $data['hotelLocation'];
$userID = $_SESSION['user_id']; 
$pricePerNight = floatval($data['pricePerNight']); 

// Insert booking into the database
$sql = "INSERT INTO Bookings (UserID, HotelID, HotelName, HotelLocation, PricePerNight) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iissd", $userID, $hotelID, $hotelName, $hotelLocation, $pricePerNight);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Error: ' . $stmt->error]);
}

$stmt->close();
$conn->close();
?>