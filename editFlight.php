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

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM Flights WHERE FlightID = $id";
    $result = $conn->query($sql);
    $flight = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
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
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Flight - Travel Bliss</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/creator.css">
</head>
<body>
    <section>
        <h1>Edit Flight</h1>
        <form action="editFlight.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $flight['FlightID']; ?>">
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

            <input type="submit" value="Update">
        </form>
    </section>
</body>
</html>
