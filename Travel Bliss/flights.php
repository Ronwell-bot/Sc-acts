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

// Read flight data
$sql = "SELECT * FROM Flights";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flights - Travel Bliss</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/flights.css">
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
    <section>
        <h1>Flights</h1>
        <p>Find the best flights for your next adventure.</p>
        <div class="flight-list">
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $formattedPrice = $row['Price'] > 0 ? '$' . number_format($row['Price'], 2) : 'Not Available';
                    echo "<div class='flight'>
                            <h2>{$row['FlightNumber']}</h2>
                            <img src='uploads/{$row['FlightImage']}' alt='Flight Image' class='plane-image'>
                            <p>From: {$row['Departure']}</p>
                            <p>To: {$row['Arrival']}</p>
                            <p>Price: {$formattedPrice}</p>
                            <p>Departure Time: {$row['DepartureTime']}</p>
                            <p>Arrival Time: {$row['ArrivalTime']}</p>
                            <p>Airline: {$row['Airline']}</p>
                            <a href='seat-selection.php' class='buy-ticket-button'>Buy Ticket</a>
                          </div>";
                }
            } else {
                echo "<p>No flights available</p>";
            }
            ?>
        </div>
    </section>
    <script src="js/flights.js"></script>
    <?php
    // Close connection
    $conn->close();
    ?>
</body>

</html>