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
            <a href="index.html">
                <img src="images/logoo.png" alt="Travel Bliss Logo" class="logo">
                <span class="logo-text">Travel Bliss</span>
            </a>
            <ul>
                <li><a href="flights.html">Flights</a></li>
                <li><a href="hotels.html">Hotels</a></li>
                <li><a href="packages.html">Packages</a></li>
                <li><a href="creator.html" class="create-button">Create Listing</a></li>
            </ul>
        </nav>
    </header>

    <section class="hotel-details">
        <h1>Hotel Name</h1>
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
            <p><strong>Description:</strong> This is a detailed description of the hotel, its amenities, and services.
                It provides a comfortable stay with luxurious facilities.</p>
        </div>
        <div class="hotel-booking">
            <p><strong>Price:</strong> $200 per night</p>
            <a href="booking.html?hotel=hotel-name" class="book-button">Book Now</a>
        </div>
    </section>
    <script src="js/hotel-details.js"></script>
</body>

</html>