<?php
session_start();
header('Content-Type: application/json');

$servername = "127.0.0.1";
$username = "root";
$password = "weneklek";
$dbname = "travel_bliss";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Connection failed: ' . $conn->connect_error]));
}

// Get the JSON data from the request
$data = json_decode(file_get_contents('php://input'), true);

// remove all characters except numbers and decimal point
$priceString = $data['price'];
$priceString = preg_replace('/[^0-9.]/', '', $priceString);

$price = floatval($priceString);

$flightNumber = $data['flightNumber'];
$departure = $data['departure'];
$arrival = $data['arrival'];
$departureTime = $data['departureTime'];
$arrivalTime = $data['arrivalTime'];
$seat = $data['seat'];
// $price = floatval($data['price']);  
$userId = $_SESSION['user_id']; 

// Insert booking into the database
$sql = "INSERT INTO Bookings (UserID, FlightNumber, Departure, Arrival, DepartureTime, ArrivalTime, Seat, Price) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("issssssd", $userId, $flightNumber, $departure, $arrival, $departureTime, $arrivalTime, $seat, $price);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Error: ' . $stmt->error]);
}

$stmt->close();
$conn->close();
?>