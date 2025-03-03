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

// Get hotel ID from URL
$hotelID = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch hotel data
$sql = "SELECT * FROM Hotels WHERE HotelID = $hotelID";
$result = $conn->query($sql);
$hotel = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Details - Travel Bliss</title>
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
                <li><a href="account.php" class="account-button">My Account</a></li>
            </ul>
        </nav>
    </header>

    <section class="hotel-details">
        <?php if ($hotel): ?>
            <h1><?php echo $hotel['HotelName']; ?></h1>
            <div class="hotel-images">
                <img src="uploads/<?php echo $hotel['HotelImage']; ?>" alt="<?php echo $hotel['HotelName']; ?>">
            </div>
            <div class="hotel-info">
                <p><strong>Location:</strong> <?php echo $hotel['Location']; ?></p>
                <p><strong>Price per Night:</strong> $<?php echo number_format($hotel['PricePerNight'], 2); ?></p>
                <p><strong>Check-in Time:</strong> <?php echo $hotel['CheckInTime']; ?></p>
                <p><strong>Check-out Time:</strong> <?php echo $hotel['CheckOutTime']; ?></p>
                <p><strong>Amenities:</strong> <?php echo $hotel['Amenities']; ?></p>
                <p><strong>Description:</strong> This is a sample detailed description of the hotel, its amenities, and services. It provides a comfortable stay with luxurious facilities.</p>
            </div>
            <div class="hotel-booking">
                <p><strong>Price:</strong> $<?php echo number_format($hotel['PricePerNight'], 2); ?> per night rate</p>
                <button class="book-button" onclick="bookHotel(<?php echo $hotelID; ?>, '<?php echo addslashes($hotel['HotelName']); ?>', '<?php echo addslashes($hotel['Location']); ?>', <?php echo $hotel['PricePerNight']; ?>)">Book Now</button>
            </div>
        <?php else: ?>
            <p>Hotel not found.</p>
        <?php endif; ?>
    </section>
    <script src="js/hotel-details.js"></script>
    <?php
    // Close connection
    $conn->close();
    ?>
</body>

</html>