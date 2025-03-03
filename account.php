<?php
session_start();

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

if (!isset($_SESSION['user_id'])) {
    echo "<div class='login-message'>";
    echo "<p>You need to log in first.</p>";
    echo "<a href='register.php' class='login-link'>Log in</a>";
    echo "</div>";
    echo "<style>
            .login-message {
                text-align: center;
                margin-top: 50px;
                padding: 20px;
                border: 1px solid #ccc;
                border-radius: 10px;
                background-color: #f9f9f9;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                max-width: 400px;
                margin-left: auto;
                margin-right: auto;
            }
            .login-message p {
                font-size: 18px;
                color: #333;
            }
            .login-link {
                display: inline-block;
                margin-top: 10px;
                padding: 10px 20px;
                background-color: #007BFF;
                color: white;
                text-decoration: none;
                border-radius: 5px;
            }
            .login-link:hover {
                background-color: #0056b3;
            }
          </style>";
    exit();
}

// Fetch user details
$user_id = $_SESSION['user_id']; // Assuming the user is logged in and user_id is stored in the session
$sql = "SELECT * FROM Users WHERE UserID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();

// Fetch bookings for the user
$sql = "SELECT * FROM Bookings WHERE UserID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$bookings_result = $stmt->get_result();
$bookings = [];
while ($row = $bookings_result->fetch_assoc()) {
    $bookings[] = $row;
}
$stmt->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Account - Travel Bliss</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/account.css">
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
        </ul>
    </nav>
</header>

<body>
    <section>
        <h1>My Account</h1>
        <p>Welcome, <?php echo htmlspecialchars($user['Username']); ?>!</p>
        <div class="account-details">
            <h2>Account Details</h2>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($user['Email']); ?></p>
            <p><strong>Username:</strong> <?php echo htmlspecialchars($user['Username']); ?></p>
            <!-- Add more account details as needed -->
        </div>
        <div class="account-actions">
            <a href="unavailable.html" class="edit-button">Edit Account</a>
            <a href="logout.php" class="logout-button">Logout</a>
        </div>
        <div class="bookings">
            <h2>My Bookings</h2>
            <?php if (count($bookings) > 0): ?>
                <ul>
                    <?php foreach ($bookings as $booking): ?>
                        <?php if (!is_null($booking['FlightNumber'])): ?>
                            <li>
                                <h3>Booked Flights</h3>
                                <p><strong>Flight Number:</strong> <?php echo htmlspecialchars($booking['FlightNumber']); ?></p>
                                <p><strong>Departure:</strong> <?php echo htmlspecialchars($booking['Departure']); ?></p>
                                <p><strong>Arrival:</strong> <?php echo htmlspecialchars($booking['Arrival']); ?></p>
                                <p><strong>Departure Time:</strong> <?php echo htmlspecialchars($booking['DepartureTime']); ?></p>
                                <p><strong>Arrival Time:</strong> <?php echo htmlspecialchars($booking['ArrivalTime']); ?></p>
                                <p><strong>Seat:</strong> <?php echo htmlspecialchars($booking['Seat']); ?></p>
                                <p><strong>Price:</strong> $<?php echo htmlspecialchars($booking['Price']); ?></p>
                            </li>
                        <?php endif; ?>
                        <?php if (!is_null($booking['HotelName'])): ?>
                            <li>
                                <h3>Booked Hotels</h3>
                                <p><strong>Hotel Name:</strong> <?php echo htmlspecialchars($booking['HotelName']); ?></p>
                                <p><strong>Address:</strong> <?php echo htmlspecialchars($booking['HotelLocation']); ?></p>
                                <p><strong>Price per Night:</strong> $<?php echo htmlspecialchars($booking['PricePerNight']); ?></p>
                            </li>
                        <?php endif; ?>
                        <?php if (!is_null($booking['PackageName'])): ?>
                            <li>
                                <h3>Booked Packages</h3>
                                <p><strong>Package Name:</strong> <?php echo htmlspecialchars($booking['PackageName']); ?></p>
                                <?php if (isset($booking['PackageDescription'])): ?>
                                    <p><strong>Description:</strong> <?php echo htmlspecialchars($booking['PackageDescription']); ?></p>
                                <?php endif; ?>
                                <p><strong>Price:</strong> $<?php echo htmlspecialchars($booking['Price']); ?></p>
                            </li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
                <button id="pay-now-button">Pay Now</button>
                <button id="view-summary-button">View Summary</button>
                <button id="generate-summary-button">Generate Summary</button>
            <?php else: ?>
                <p>No bookings found.</p>
            <?php endif; ?>
        </div>

        <div id="payment-popup" class="popup">
            <div class="popup-content">
                <span class="close-button">&times;</span>
                <h2>Payment</h2>
                <p>Total Amount: $<span id="total-amount"></span></p>
                <form id="payment-form">
                    <label for="card-number">Card Number:</label>
                    <input type="text" id="card-number" name="card-number" required>
                    <label for="expiry-date">Expiry Date:</label>
                    <input type="text" id="expiry-date" name="expiry-date" required>
                    <label for="cvv">CVV:</label>
                    <input type="text" id="cvv" name="cvv" required>
                    <button type="submit">Confirm Payment</button>
                </form>
            </div>
        </div>
    </section>
    <script src="js/account.js"></script>
    <?php
    // Close connection
    $conn->close();
    ?>
</body>

</html>
