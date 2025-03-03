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

// Read package data
$sql_packages = "SELECT * FROM Packages";
$result_packages = $conn->query($sql_packages);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Packages - Travel Bliss</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/packages.css">
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
        <h1>Packages</h1>
        <p>Explore our exclusive travel packages.</p>
        <div class="package-container">
        <div class="package">
                <h2>New York (Sample)</h2>
                <p>Date: 2024-01-15</p>
                <p>Place: New York, USA</p>
                <p>Details: Includes flight, hotel, and city tours.</p>
                <p class="price">$1800</p>
                <button class="view-button" onclick="toggleDetails(this)">View Details</button>
                <div class="details">
                    <p>Hotel: The Plaza Hotel</p>
                    <img src="images/ny1.jpg" alt="The Plaza Hotel">
                    <p>Food: Breakfast included</p>
                    <img src="images/nyb.jpg" alt="New York Food">
                    <p>Places: Statue of Liberty, Central Park, Times Square</p>
                    <img src="images/ny2.jpg" alt="New York Destination">
                    <p>Activities: Broadway Show, Helicopter Tour</p>
                </div>
                <a href='package_details.php?id=1' class='book-button'>Book Now</a>
            </div>
            <?php
            if ($result_packages->num_rows > 0) {
                while($row = $result_packages->fetch_assoc()) {
                    $formattedPrice = $row['Price'] > 0 ? '$' . number_format($row['Price'], 2) : 'Price Not Available';
                    echo "<div class='package'>
                            <h2>{$row['PackageName']}</h2>
                            <p>Date: {$row['StartDate']} to {$row['EndDate']}</p>
                            <p>Details: {$row['Description']}</p>
                            <p class='price'>{$formattedPrice}</p>
                            <button class='view-button' onclick='toggleDetails(this)'>View Details</button>
                            <div class='details'>
                                <p>Itinerary: {$row['Itinerary']}</p>
                                <img src='uploads/{$row['PackageImage']}' alt='Package Image'>
                            </div>
                            <a href='package_details.php?id={$row['PackageID']}' class='book-button'>Book Now</a>
                          </div>";
                }
            } else {
                echo "<p>No packages found</p>";
            }
            ?>
        </div>
    </section>
    <script>
        function toggleDetails(button) {
            const details = button.nextElementSibling;
            if (details.style.display === "none" || details.style.display === "") {
                details.style.display = "block";
            } else {
                details.style.display = "none";
            }
        }
    </script>
    <script src="/js/packages.js"></script>
    <?php
    // Close connection
    $conn->close();
    ?>
</body>

</html>
