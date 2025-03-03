<?php
$servername = "127.0.0.1";
$username = "root";
$password = "weneklek";
$dbname = "travel_bliss";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$packageID = $_GET['id'];
$sql_package = "SELECT * FROM Packages WHERE PackageID = $packageID";
$result_package = $conn->query($sql_package);
$package = $result_package->fetch_assoc();

$sql_images = "SELECT ImageURL FROM PackageImages WHERE PackageID = $packageID";
$result_images = $conn->query($sql_images);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $package['PackageName']; ?> - Travel Bliss</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/package_details.css">
    <script src="js/package_details.js"></script>
    <style>
        .image-gallery {
            display: flex;
            overflow-x: scroll;
        }
        .image-gallery img {
            margin-right: 10px;
        }
    </style>
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
    <section>
        <h1><?php echo $package['PackageName']; ?></h1>
        <p>Date: <?php echo $package['StartDate']; ?> to <?php echo $package['EndDate']; ?></p>
        <p>Details: <?php echo $package['Description']; ?></p>
        <p>Itinerary: <?php echo $package['Itinerary']; ?></p>
        <img src="uploads/<?php echo $package['PackageImage']; ?>" alt="Package Image">
        <p class="price"><?php echo $package['Price'] > 0 ? '$' . number_format($package['Price'], 2) : 'Price Not Available'; ?></p>
        <button class="book-button" onclick="bookNow(
            <?php echo $packageID; ?>,
            '<?php echo $package['PackageName']; ?>',
            '<?php echo $package['Place']; ?>',
            '<?php echo $package['StartDate']; ?>',
            '<?php echo $package['EndDate']; ?>',
            <?php echo $package['Price']; ?>,
            '<?php echo $package['Description']; ?>'
        )">Book Now</button>
        <div class="image-gallery">
            <?php
            if ($result_images->num_rows > 0) {
                while($image = $result_images->fetch_assoc()) {
                    $imagePath = 'uploads/' . $image['ImageURL'];
                    if (file_exists($imagePath)) {
                        echo "<img src='{$imagePath}' alt='Package Image'>";
                    } else {
                        echo "<p>Image not found: {$imagePath}</p>";
                    }
                }
            } else {
                echo "<p>No images available for this package.</p>";
            }
            ?>
        </div>
    </section>
    <?php
    $conn->close();
    ?>
</body>
</html>
