<?php
// Database connection
$servername = "127.0.0.1";
$username = "root";
$password = "weneklek";
$dbname = "travel_bliss";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve flight data from query parameters
$flightNumber = $_GET['flightNumber'] ?? 'N/A';
$departure = $_GET['departure'] ?? 'N/A';
$arrival = $_GET['arrival'] ?? 'N/A';
$departureTime = $_GET['departureTime'] ?? 'N/A';
$arrivalTime = $_GET['arrivalTime'] ?? 'N/A';
$price = $_GET['price'] ?? 'N/A';
$airline = $_GET['airline'] ?? 'N/A';
$flightImage = $_GET['flightImage'] ?? 'N/A';

// Generate random seats
$rows = 10;
$cols = 4;
$seats = [];
for ($i = 1; $i <= $rows; $i++) {
    for ($j = 0; $j < $cols; $j++) {
        $seat = $i . chr(65 + $j); 
        $seats[] = $seat;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seat Selection - Travel Bliss</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/seat-selection.css">
</head>

<header>
    <nav>
        <a href="index.php">
            <img src="images/logoo.png" alt="Travel Bliss Logo" class="logo">
            <span class="logo-text">Travel Bliss</span>
        </a>
        <ul>
            <li><a href="flights.php">Flights</a></li>
            <li><a href="hotels.php">Hotels</a></li>
            <li><a href="packages.php">Packages</a></li>
            <li><a href="creator.php" class="create-button">Create Listing</a></li>
        </ul>
    </nav>
</header>

<body>
    <section class="seat-selection">
        <div class="seat-picker">
            <h1>Seat Selection</h1>
            <p>Select your seat for the flight.</p>
            <div class="seat-map">
                <ul>
                    <?php foreach ($seats as $seat): ?>
                        <li>Seat <?php echo $seat; ?> - Price: $<?php echo htmlspecialchars($price); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <a href="flights.php" class="back-button">Back</a>
        </div>
        <div class="ticket-info">
            <h2>Ticket Information</h2>
            <p>Flight: <?php echo htmlspecialchars($flightNumber); ?></p>
            <p>From: <?php echo htmlspecialchars($departure); ?></p>
            <p>To: <?php echo htmlspecialchars($arrival); ?></p>
            <p>Date: <?php echo htmlspecialchars($departureTime); ?></p>
            <p>Time: <?php echo htmlspecialchars($arrivalTime); ?></p>
            <p>Seat: <span id="selected-seat">None</span></p>
            <p>Price: $<?php echo htmlspecialchars($price); ?></p>
        </div>
    </section>
    <script src="js/seat-selection.js"></script>
    <?php
    // Close connection
    $conn->close();
    ?>
</body>

</html>
