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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $listingType = $_POST['listing-type'];

    if ($listingType == 'flight') {
        $flightNumber = $_POST['flight-flight-number'];
        $departure = $_POST['flight-departure'];
        $arrival = $_POST['flight-arrival'];
        $departureTime = $_POST['flight-departure-time'];
        $arrivalTime = $_POST['flight-arrival-time'];
        $price = $_POST['flight-price'];
        $airline = $_POST['flight-airline'];
        $flightImage = $_FILES['flight-flight-image']['name'];

        // Ensure price is treated as a decimal
        $price = floatval($price);

        // Upload flight image
        if ($flightImage) {
            $target_dir = "uploads/";
            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0777, true);
            }
            $target_file = $target_dir . basename($flightImage);
            move_uploaded_file($_FILES['flight-flight-image']['tmp_name'], $target_file);
        }

        $sql = "INSERT INTO Flights (FlightNumber, Departure, Arrival, DepartureTime, ArrivalTime, Price, Airline, FlightImage)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        // Bind parameters
        $stmt->bind_param("sssssdss", $flightNumber, $departure, $arrival, $departureTime, $arrivalTime, $price, $airline, $flightImage);

        if ($stmt->execute() === TRUE) {
            $message = "New flight listing created successfully";
            $messageType = "success";
        } else {
            $message = "Error: " . $stmt->error;
            $messageType = "error";
        }

        $stmt->close();
    } elseif ($listingType == 'hotel') {
        $hotelName = $_POST['hotel-hotel-name'];
        $location = $_POST['hotel-location'];
        $pricePerNight = $_POST['hotel-price-per-night'];
        $checkInTime = $_POST['hotel-check-in-time'];
        $checkOutTime = $_POST['hotel-check-out-time'];
        $amenities = $_POST['hotel-amenities'];
        $hotelImage = $_FILES['hotel-hotel-image']['name'];

        // Ensure price is treated as a decimal
        $pricePerNight = floatval($pricePerNight);

        // Upload hotel image
        if ($hotelImage) {
            $target_dir = "uploads/";
            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0777, true);
            }
            $target_file = $target_dir . basename($hotelImage);
            move_uploaded_file($_FILES['hotel-hotel-image']['tmp_name'], $target_file);
        }

        $sql = "INSERT INTO Hotels (HotelName, Location, PricePerNight, CheckInTime, CheckOutTime, Amenities, HotelImage)
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        // Bind parameters
        $stmt->bind_param("ssdssss", $hotelName, $location, $pricePerNight, $checkInTime, $checkOutTime, $amenities, $hotelImage);

        if ($stmt->execute() === TRUE) {
            $message = "New hotel listing created successfully";
            $messageType = "success";
        } else {
            $message = "Error: " . $stmt->error;
            $messageType = "error";
        }

        $stmt->close();
    } elseif ($listingType == 'package') {
        $packageName = $_POST['package-package-name'];
        $description = $_POST['package-description'];
        $price = $_POST['package-price'];
        $startDate = $_POST['package-start-date'];
        $endDate = $_POST['package-end-date'];
        $itinerary = $_POST['package-itinerary'];
        $packageImage = $_FILES['package-package-image']['name'];

        // Ensure price is treated as a decimal
        $price = floatval($price);

        // Upload package image
        if ($packageImage) {
            $target_dir = "uploads/";
            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0777, true);
            }
            $target_file = $target_dir . basename($packageImage);
            move_uploaded_file($_FILES['package-package-image']['tmp_name'], $target_file);
        }

        $sql = "INSERT INTO Packages (PackageName, Description, Price, StartDate, EndDate, Itinerary, PackageImage)
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        // Bind parameters
        $stmt->bind_param("ssdssss", $packageName, $description, $price, $startDate, $endDate, $itinerary, $packageImage);

        if ($stmt->execute() === TRUE) {
            $message = "New package listing created successfully";
            $messageType = "success";
        } else {
            $message = "Error: " . $stmt->error;
            $messageType = "error";
        }

        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creator - Travel Bliss</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/creator.css">
    
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
            <li><a href="account.php" class="create-button">My Account</a></li>
        </ul>
    </nav>
</header>

<body>
    <section>
        <h1>Creator</h1>
        <p>Create your Travel Bliss listings here.</p>

        <?php if (isset($message)): ?>
            <div class="message <?php echo $messageType; ?>">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <div class="tabs">
            <ul>
                <li class="tab-link current" data-tab="flight">Flight</li>
                <li class="tab-link" data-tab="hotel">Hotel</li>
                <li class="tab-link" data-tab="package">Package</li>
            </ul>

            <form id="flight-form" class="tab-content current" action="creator.php" method="post" enctype="multipart/form-data">
                <h2>Flight Details</h2>
                <!-- Flight form fields here -->
                <label for="flight-flight-number">Flight Number:</label>
                <input type="text" id="flight-flight-number" name="flight-flight-number">

                <label for="flight-departure">Departure:</label>
                <input type="text" id="flight-departure" name="flight-departure">

                <label for="flight-arrival">Arrival:</label>
                <input type="text" id="flight-arrival" name="flight-arrival">

                <label for="flight-departure-time">Departure Time:</label>
                <input type="time" id="flight-departure-time" name="flight-departure-time">

                <label for="flight-arrival-time">Arrival Time:</label>
                <input type="time" id="flight-arrival-time" name="flight-arrival-time">

                <label for="flight-price">Price:</label>
                <input type="number" step="0.01" id="flight-price" name="flight-price" required>

                <label for="flight-flight-image">Flight Image:</label>
                <input type="file" id="flight-flight-image" name="flight-flight-image" accept="image/*">

                <label for="flight-airline">Airline:</label>
                <input type="text" id="flight-airline" name="flight-airline">
                <input type="hidden" name="listing-type" value="flight">
                <button type="submit">Create Listing</button>
            </form>

            <form id="hotel-form" class="tab-content" action="creator.php" method="post" enctype="multipart/form-data">
                <h2>Hotel Details</h2>
                <!-- Hotel form fields here -->
                <label for="hotel-hotel-name">Hotel Name:</label>
                <input type="text" id="hotel-hotel-name" name="hotel-hotel-name" required>

                <label for="hotel-location">Location:</label>
                <input type="text" id="hotel-location" name="hotel-location" required>

                <label for="hotel-price-per-night">Price per Night:</label>
                <input type="number" step="0.01" id="hotel-price-per-night" name="hotel-price-per-night" required>

                <label for="hotel-check-in-time">Check-in Time:</label>
                <input type="time" id="hotel-check-in-time" name="hotel-check-in-time" required>

                <label for="hotel-check-out-time">Check-out Time:</label>
                <input type="time" id="hotel-check-out-time" name="hotel-check-out-time" required>

                <label for="hotel-hotel-image">Hotel Image:</label>
                <input type="file" id="hotel-hotel-image" name="hotel-hotel-image" accept="image/*">

                <label for="hotel-amenities">Amenities:</label>
                <textarea id="hotel-amenities" name="hotel-amenities" required></textarea>
                <input type="hidden" name="listing-type" value="hotel">
                <button type="submit">Create Listing</button>
            </form>

            <form id="package-form" class="tab-content" action="creator.php" method="post" enctype="multipart/form-data">
                <h2>Package Details</h2>
                <!-- Package form fields here -->
                <label for="package-package-name">Package Name:</label>
                <input type="text" id="package-package-name" name="package-package-name" required>

                <label for="package-description">Description:</label>
                <textarea id="package-description" name="package-description" required></textarea>

                <label for="package-price">Price:</label>
                <input type="number" step="0.01" id="package-price" name="package-price" required>

                <label for="package-start-date">Start Date:</label>
                <input type="date" id="package-start-date" name="package-start-date" required>

                <label for="package-end-date">End Date:</label>
                <input type="date" id="package-end-date" name="package-end-date" required>

                <label for="package-package-image">Package Image:</label>
                <input type="file" id="package-package-image" name="package-package-image" accept="image/*">

                <label for="package-itinerary">Itinerary:</label>
                <textarea id="package-itinerary" name="package-itinerary" required></textarea>
                <input type="hidden" name="listing-type" value="package">
                <button type="submit">Create Listing</button>
            </form>
        </div>
    </section>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const tabLinks = document.querySelectorAll('.tab-link');
            const tabContents = document.querySelectorAll('.tab-content');

            tabLinks.forEach(link => {
                link.addEventListener('click', function () {
                    const tabId = this.getAttribute('data-tab');

                    tabLinks.forEach(link => link.classList.remove('current'));
                    tabContents.forEach(content => content.classList.remove('current'));

                    this.classList.add('current');
                    document.getElementById(tabId).classList.add('current');
                });
            });
        });
    </script>
    <script src="js/creator.js"></script>
    <?php
    // Close connection
    $conn->close();
    ?>
</body>

</html>