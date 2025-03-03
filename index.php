<?php
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
    <title>Travel Bliss</title>
    <link rel="stylesheet" href="css/styles.css">
    <style>
        .hero {
            background-image: url('/images/home2.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            width: 100%;
            min-height: 50vh;
            color: white;
            text-align: center;
            padding: 50px 20px;
            animation: fadeIn 2s ease-in-out;
        }
    </style>
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

<body class="animated">
    <section class="hero" style="background-image: url('images/bg2.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat; width: 100%; min-height: 50vh; color: white; text-align: center; padding: 50px 20px; animation: fadeIn 2s ease-in-out;">
        <h1>Welcome to Travel Bliss</h1>
        <p>Your adventure starts here. Explore the world with us.</p>
        <p class="slogan">Join us today and start your journey!</p>
        <a href="register.php" class="register-button">Create an Account</a>
    </section>

    <section class="packages">
        <div class="package">
            <img src="images/beach1.jpg" alt="Beach Paradise">
            <h2>Beach Paradise</h2>
            <p>Enjoy the sun and sand with our exclusive beach packages.</p>
            <a href="packages.php" class="book-button">Book Now</a>
        </div>
        <div class="package">
            <img src="images/mountain3.jpg" alt="Mountain Adventure">
            <h2>Mountain Adventure</h2>
            <p>Explore the mountains with our thrilling adventure tours.</p>
            <a href="packages.php" class="book-button">Book Now</a>
        </div>
        <div class="package">
            <img src="images/city1.jpg" alt="City Excursions">
            <h2>City Excursions</h2>
            <p>Discover the best cities around the world with our guided tours.</p>
            <a href="packages.php" class="book-button">Book Now</a>
        </div>
    </section>

    <script src="js/index.js"></script>

    <?php
    // Close connection
    $conn->close();
    ?>
</body>

</html>
