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
                <!-- Example seat map -->
                <div class="row">
                    <div class="seat">1A</div>
                    <div class="seat">1B</div>
                    <div class="seat">1C</div>
                    <div class="seat">1D</div>
                </div>
                <div class="row">
                    <div class="seat">2A</div>
                    <div class="seat">2B</div>
                    <div class="seat">2C</div>
                    <div class="seat">2D</div>
                </div>
                <!-- Add more rows as needed -->
            </div>
            <button class="finalize-booking-button">Finalize Booking</button>
            <a href="flights.php" class="back-button">Back</a>
        </div>
        <div class="ticket-info">
            <h2>Ticket Information</h2>
            <p>Flight: Flight 1</p>
            <p>From: New York</p>
            <p>To: Los Angeles</p>
            <p>Date: 2023-10-15</p>
            <p>Time: 10:00 AM</p>
            <p>Seat: <span id="selected-seat">None</span></p>
            <p>Price: $300</p>
        </div>
    </section>
    <script src="/js/seat-selection.js"></script>
    <?php
    // Close connection
    $conn->close();
    ?>
</body>

</html>
