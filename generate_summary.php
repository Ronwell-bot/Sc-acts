<?php
session_start();
header('Content-Type: application/json');

require '/fpdf/fpdf.php'; // Include the FPDF library

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
$bookings = $data['bookings'];

// Fetch user details
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM Users WHERE UserID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();

// Generate PDF summary
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(40, 10, 'Booking Summary');
$pdf->Ln();

foreach ($bookings as $booking) {
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(40, 10, "Flight: {$booking['FlightNumber']}");
    $pdf->Ln();
    $pdf->Cell(40, 10, "Seat: {$booking['Seat']}");
    $pdf->Ln();
    $pdf->Cell(40, 10, "Price: \${$booking['Price']}");
    $pdf->Ln();
    $pdf->Ln();
}

$pdfFilePath = 'booking_summary.pdf';
$pdf->Output('F', $pdfFilePath);

echo json_encode(['success' => true, 'pdfUrl' => $pdfFilePath]);

$conn->close();
?>
