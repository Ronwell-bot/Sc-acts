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
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sunset Inn - Travel Bliss</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/hotel-details.css">
</head>

<body>
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

    <section class="hotel-details">
        <h1>Sunset Inn</h1>
        <div class="hotel-images">
            <img src="/images/hotel2.jpg" alt="Hotel Image 1">
            <img src="/images/hotel3.jpg" alt="Hotel Image 2">
            <img src="/images/hotel4.jpg" alt="Hotel Image 3">
            <img src="/images/hotel5.jpg" alt="Hotel Image 4">
        </div>
        <div class="hotel-info">
            <p><strong>Room Type:</strong> Standard</p>
            <p><strong>Food:</strong> Without Food</p>
            <p><strong>Inclusions:</strong> Free Parking, Gym</p>
            <p><strong>Address:</strong> 456 Sunset Avenue, Beach City</p>
            <p><strong>Description:</strong> This is a detailed description of the Sunset Inn, its amenities, and
                services. It provides a comfortable stay with essential facilities.</p>
        </div>
        <div class="hotel-booking">
            <p><strong>Price:</strong> $150 per night</p>
            <a href="booking.php?hotel=sunset-inn" class="book-button">Book Now</a>
        </div>
    </section>
    <script src="/js/hotel-details-sunset-inn.js"></script>
    <?php
    // Close connection
    $conn->close();
    ?>
</body>

</html>