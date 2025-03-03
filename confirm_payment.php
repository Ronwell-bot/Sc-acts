<?php
session_start();
header('Content-Type: application/json');

require 'fpdf/fpdf.php'; // Include the FPDF library

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
$cardNumber = $data['cardNumber'];
$expiryDate = $data['expiryDate'];
$cvv = $data['cvv'];

// Here you would normally process the payment using a payment gateway API

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

// Send email with PDF attachment
$to = $user['Email'];
$subject = 'Booking Summary';
$body = 'Please find attached the summary of your bookings.';
$headers = "From: Travel Bliss <your_email@example.com>\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: multipart/mixed; boundary=\"boundary\"\r\n";

$message = "--boundary\r\n";
$message .= "Content-Type: text/plain; charset=UTF-8\r\n";
$message .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
$message .= $body . "\r\n\r\n";
$message .= "--boundary\r\n";
$message .= "Content-Type: application/pdf; name=\"booking_summary.pdf\"\r\n";
$message .= "Content-Transfer-Encoding: base64\r\n";
$message .= "Content-Disposition: attachment; filename=\"booking_summary.pdf\"\r\n\r\n";
$message .= chunk_split(base64_encode(file_get_contents($pdfFilePath))) . "\r\n";
$message .= "--boundary--";

// Send the email
if (mail($to, $subject, $message, $headers)) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to send email.']);
}

$conn->close();
?>