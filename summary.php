<?php
session_start();

if (!isset($_SESSION['bookings']) || empty($_SESSION['bookings'])) {
    echo "No booking details available.";
    exit();
}

$bookings = $_SESSION['bookings'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Summary - Travel Bliss</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/account.css">
</head>
<body>
    <section>
        <h1>Booking Summary</h1>
        <div class="bookings">
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
        </div>
        <button onclick="window.print()">Print Summary</button>
    </section>
</body>
</html>
