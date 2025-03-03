<?php
$servername = "127.0.0.1";
$username = "root";
$password = "weneklek";
$dbname = "travel_bliss";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $price = $_POST['price'];
    error_log("Price received: " . $price);
    $price = floatval($price);
    error_log("Price after floatval: " . $price);

    $sql = "INSERT INTO TestPrices (Price) VALUES (?)"; // Create a table called TestPrices with a DECIMAL Price column
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("d", $price);

    if ($stmt->execute()) {
        error_log("Price inserted successfully");
    } else {
        error_log("Error inserting price: " . $stmt->error);
    }

    $stmt->close();
}
$conn->close();
?>

<form method="post">
    Price: <input type="number" step="0.01" name="price">
    <button type="submit">Submit</button>
</form>
