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

if (isset($_GET['id']) && isset($_GET['type'])) {
    $id = $_GET['id'];
    $type = $_GET['type'];
    if ($type == 'user') {
        $sql = "SELECT * FROM Users WHERE UserID = $id";
        $result = $conn->query($sql);
        $user = $result->fetch_assoc();
    } elseif ($type == 'flight') {
        $sql = "SELECT * FROM Flights WHERE FlightID = $id";
        $result = $conn->query($sql);
        $flight = $result->fetch_assoc();
    } elseif ($type == 'hotel') {
        $sql = "SELECT * FROM Hotels WHERE HotelID = $id";
        $result = $conn->query($sql);
        $hotel = $result->fetch_assoc();
    } elseif ($type == 'package') {
        $sql = "SELECT * FROM Packages WHERE PackageID = $id";
        $result = $conn->query($sql);
        $package = $result->fetch_assoc();
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $type = $_POST['type'];
    if ($type == 'user') {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $sex = $_POST['sex'];
        $age = $_POST['age'];
        $username = $_POST['username'];
        $profile_picture = $_FILES['profile_picture']['name'];

        // Upload profile picture
        if ($profile_picture) {
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($profile_picture);
            move_uploaded_file($_FILES['profile_picture']['tmp_name'], $target_file);
            $sql = "UPDATE Users SET Username='$username', Email='$email', Sex='$sex', Age=$age, ProfilePicture='$profile_picture' WHERE UserID=$id";
        } else {
            $sql = "UPDATE Users SET Username='$username', Email='$email', Sex='$sex', Age=$age WHERE UserID=$id";
        }

        if ($conn->query($sql) === TRUE) {
            header("Location: viewData.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } elseif ($type == 'flight') {
        $flightNumber = $_POST['flight-number'];
        $departure = $_POST['departure'];
        $arrival = $_POST['arrival'];
        $departureTime = $_POST['departure-time'];
        $arrivalTime = $_POST['arrival-time'];
        $price = $_POST['price'];
        $airline = $_POST['airline'];
        $flightImage = $_FILES['flight-image']['name'];

        // Upload flight image
        if ($flightImage) {
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($flightImage);
            move_uploaded_file($_FILES['flight-image']['tmp_name'], $target_file);
            $sql = "UPDATE Flights SET FlightNumber='$flightNumber', Departure='$departure', Arrival='$arrival', DepartureTime='$departureTime', ArrivalTime='$arrivalTime', Price='$price', Airline='$airline', FlightImage='$flightImage' WHERE FlightID=$id";
        } else {
            $sql = "UPDATE Flights SET FlightNumber='$flightNumber', Departure='$departure', Arrival='$arrival', DepartureTime='$departureTime', ArrivalTime='$arrivalTime', Price='$price', Airline='$airline' WHERE FlightID=$id";
        }

        if ($conn->query($sql) === TRUE) {
            header("Location: viewData.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } elseif ($type == 'hotel') {
        $hotelName = $_POST['hotel-name'];
        $location = $_POST['location'];
        $pricePerNight = $_POST['price-per-night'];
        $checkInTime = $_POST['check-in-time'];
        $checkOutTime = $_POST['check-out-time'];
        $amenities = $_POST['amenities'];
        $hotelImage = $_FILES['hotel-image']['name'];

        // Upload hotel image
        if ($hotelImage) {
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($hotelImage);
            move_uploaded_file($_FILES['hotel-image']['tmp_name'], $target_file);
            $sql = "UPDATE Hotels SET HotelName='$hotelName', Location='$location', PricePerNight='$pricePerNight', CheckInTime='$checkInTime', CheckOutTime='$checkOutTime', Amenities='$amenities', HotelImage='$hotelImage' WHERE HotelID=$id";
        } else {
            $sql = "UPDATE Hotels SET HotelName='$hotelName', Location='$location', PricePerNight='$pricePerNight', CheckInTime='$checkInTime', CheckOutTime='$checkOutTime', Amenities='$amenities' WHERE HotelID=$id";
        }

        if ($conn->query($sql) === TRUE) {
            header("Location: viewData.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } elseif ($type == 'package') {
        $packageName = $_POST['package-name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $startDate = $_POST['start-date'];
        $endDate = $_POST['end-date'];
        $itinerary = $_POST['itinerary'];
        $packageImage = $_FILES['package-image']['name'];

        // Upload package image
        if ($packageImage) {
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($packageImage);
            move_uploaded_file($_FILES['package-image']['tmp_name'], $target_file);
            $sql = "UPDATE Packages SET PackageName='$packageName', Description='$description', Price='$price', StartDate='$startDate', EndDate='$endDate', Itinerary='$itinerary', PackageImage='$packageImage' WHERE PackageID=$id";
        } else {
            $sql = "UPDATE Packages SET PackageName='$packageName', Description='$description', Price='$price', StartDate='$startDate', EndDate='$endDate', Itinerary='$itinerary' WHERE PackageID=$id";
        }

        if ($conn->query($sql) === TRUE) {
            header("Location: viewData.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit - Travel Bliss</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/register.css">
</head>
<body>
    <section>
        <h1>Edit <?php echo ucfirst($type); ?></h1>
        <form action="edit.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="hidden" name="type" value="<?php echo $type; ?>">
            <?php if ($type == 'user'): ?>
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="<?php echo $user['Username']; ?>" required><br>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo $user['Email']; ?>" required><br>

                <label for="sex">Sex:</label>
                <select id="sex" name="sex" required>
                    <option value="male" <?php if ($user['Sex'] == 'male') echo 'selected'; ?>>Male</option>
                    <option value="female" <?php if ($user['Sex'] == 'female') echo 'selected'; ?>>Female</option>
                    <option value="other" <?php if ($user['Sex'] == 'other') echo 'selected'; ?>>Other</option>
                </select><br>

                <label for="age">Age:</label>
                <input type="number" id="age" name="age" value="<?php echo $user['Age']; ?>" required><br>

                <label for="username">Username:</label>
                <input type="text" id="username" name="username" value="<?php echo $user['Username']; ?>" required><br>

                <label for="profile_picture">Profile Picture:</label>
                <input type="file" id="profile_picture" name="profile_picture"><br>
            <?php elseif ($type == 'flight'): ?>
                <label for="flight-number">Flight Number:</label>
                <input type="text" id="flight-number" name="flight-number" value="<?php echo $flight['FlightNumber']; ?>" required><br>

                <label for="departure">Departure:</label>
                <input type="text" id="departure" name="departure" value="<?php echo $flight['Departure']; ?>" required><br>

                <label for="arrival">Arrival:</label>
                <input type="text" id="arrival" name="arrival" value="<?php echo $flight['Arrival']; ?>" required><br>

                <label for="departure-time">Departure Time:</label>
                <input type="time" id="departure-time" name="departure-time" value="<?php echo $flight['DepartureTime']; ?>" required><br>

                <label for="arrival-time">Arrival Time:</label>
                <input type="time" id="arrival-time" name="arrival-time" value="<?php echo $flight['ArrivalTime']; ?>" required><br>

                <label for="price">Price:</label>
                <input type="text" id="price" name="price" value="<?php echo $flight['Price']; ?>" required><br>

                <label for="airline">Airline:</label>
                <input type="text" id="airline" name="airline" value="<?php echo $flight['Airline']; ?>" required><br>

                <label for="flight-image">Flight Image:</label>
                <input type="file" id="flight-image" name="flight-image"><br>
            <?php elseif ($type == 'hotel'): ?>
                <label for="hotel-name">Hotel Name:</label>
                <input type="text" id="hotel-name" name="hotel-name" value="<?php echo $hotel['HotelName']; ?>" required><br>

                <label for="location">Location:</label>
                <input type="text" id="location" name="location" value="<?php echo $hotel['Location']; ?>" required><br>

                <label for="price-per-night">Price per Night:</label>
                <input type="text" id="price-per-night" name="price-per-night" value="<?php echo $hotel['PricePerNight']; ?>" required><br>

                <label for="check-in-time">Check-in Time:</label>
                <input type="time" id="check-in-time" name="check-in-time" value="<?php echo $hotel['CheckInTime']; ?>" required><br>

                <label for="check-out-time">Check-out Time:</label>
                <input type="time" id="check-out-time" name="check-out-time" value="<?php echo $hotel['CheckOutTime']; ?>" required><br>

                <label for="amenities">Amenities:</label>
                <input type="text" id="amenities" name="amenities" value="<?php echo $hotel['Amenities']; ?>" required><br>

                <label for="hotel-image">Hotel Image:</label>
                <input type="file" id="hotel-image" name="hotel-image"><br>
            <?php elseif ($type == 'package'): ?>
                <label for="package-name">Package Name:</label>
                <input type="text" id="package-name" name="package-name" value="<?php echo $package['PackageName']; ?>" required><br>

                <label for="description">Description:</label>
                <input type="text" id="description" name="description" value="<?php echo $package['Description']; ?>" required><br>

                <label for="price">Price:</label>
                <input type="text" id="price" name="price" value="<?php echo $package['Price']; ?>" required><br>

                <label for="start-date">Start Date:</label>
                <input type="date" id="start-date" name="start-date" value="<?php echo $package['StartDate']; ?>" required><br>

                <label for="end-date">End Date:</label>
                <input type="date" id="end-date" name="end-date" value="<?php echo $package['EndDate']; ?>" required><br>

                <label for="itinerary">Itinerary:</label>
                <input type="text" id="itinerary" name="itinerary" value="<?php echo $package['Itinerary']; ?>" required><br>

                <label for="package-image">Package Image:</label>
                <input type="file" id="package-image" name="package-image"><br>
            <?php endif; ?>
            <input type="submit" value="Update">
        </form>
    </section>
</body>
</html>
