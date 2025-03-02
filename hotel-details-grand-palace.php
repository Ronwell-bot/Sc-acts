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
    <title>Grand Palace Hotel - Travel Bliss</title>
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
        <h1>Grand Palace Hotel</h1>
        <div class="hotel-images">
            <img src="/images/hotel1.jpg" alt="Hotel Image 1">
            <img src="/images/hotel2.jpg" alt="Hotel Image 2">
            <img src="/images/hotel3.jpg" alt="Hotel Image 3">
            <img src="/images/hotel4.jpg" alt="Hotel Image 4">
        </div>
        <div class="hotel-info">
            <p><strong>Room Type:</strong> Deluxe</p>
            <p><strong>Food:</strong> With Food</p>
            <p><strong>Inclusions:</strong> Pool, Spa, Free Wi-Fi</p>
            <p><strong>Address:</strong> 123 Royal Street, Metropolis</p>
            <p><strong>Description:</strong> This is a detailed description of the Grand Palace Hotel, its amenities,
                and services. It provides a comfortable stay with luxurious facilities.</p>
        </div>
        <div class="hotel-booking">
            <p><strong>Price:</strong> $200 per night</p>
            <a href="booking.php?hotel=grand-palace" class="book-button">Book Now</a>
        </div>
    </section>
    <script src="/js/hotel-details-grand-palace.js"></script>
    <?php
    // Close connection
    $conn->close();
    ?>
</body>

</html>