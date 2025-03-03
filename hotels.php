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

// Read hotel data
$sql = "SELECT * FROM Hotels";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotels - Travel Bliss</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/hotels.css">
</head>

<header>
    <nav>
        <a href="index.php">
            <!-- <img src="images/logoo.png" alt="Travel Bliss Logo" class="logo"> -->
            <span class="logo-text">Travel Bliss</span>
        </a>
        <ul>
            <li><a href="flights.php">Flights</a></li>
            <li><a href="hotels.php">Hotels</a></li>
            <li><a href="packages.php">Packages</a></li>
            <li><a href="creator.php" class="create-button">Create Listing</a></li>
            <li><a href="account.php" class="account-button">My Account</a></li>
        </ul>
    </nav>
</header>

<body>
    <section>
        <h1>Hotels</h1>
        <p>Find the best hotels for your stay.</p>
        <div class="hotel-grid">
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $formattedPrice = $row['PricePerNight'] > 0 ? '$' . number_format($row['PricePerNight'], 2) : 'Price Not Available';
                    echo "<div class='hotel-box'>
                            <img src='uploads/{$row['HotelImage']}' alt='{$row['HotelName']}' class='hotel-image'>
                            <h2>{$row['HotelName']}</h2>
                            <p>Location: {$row['Location']}</p>
                            <p>Price per Night: {$formattedPrice}</p>
                            <p>Check-in Time: {$row['CheckInTime']}</p>
                            <p>Check-out Time: {$row['CheckOutTime']}</p>
                            <p>Amenities: {$row['Amenities']}</p>
                            <a href='hotel-details.php?id={$row['HotelID']}' class='view-button'>View</a>
                          </div>";
                }
            } else {
                echo "<p>No hotels available</p>";
            }
            ?>
        </div>
    </section>
    <script src="js/hotels.js"></script>
    <?php
    // Close connection
    $conn->close();
    ?>
</body>

</html>
