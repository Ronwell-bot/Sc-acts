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

// Read user data
$sql_users = "SELECT * FROM Users";
$result_users = $conn->query($sql_users);

// Read flight data
$sql_flights = "SELECT * FROM Flights";
$result_flights = $conn->query($sql_flights);

// Read hotel data
$sql_hotels = "SELECT * FROM Hotels";
$result_hotels = $conn->query($sql_hotels);

// Read package data
$sql_packages = "SELECT * FROM Packages";
$result_packages = $conn->query($sql_packages);

// Read booking data
$sql_bookings = "SELECT * FROM Bookings";
$result_bookings = $conn->query($sql_bookings);

// Read destination data
$sql_destinations = "SELECT * FROM Destinations";
$result_destinations = $conn->query($sql_destinations);

// Read review data
$sql_reviews = "SELECT * FROM Reviews";
$result_reviews = $conn->query($sql_reviews);

// Handle delete action
if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    $id = $_GET['id'];
    $type = $_GET['type'];
    $table = ucfirst($type) . 's';
    $column = ucfirst($type) . 'ID';

    $sql_delete = "DELETE FROM $table WHERE $column = $id";
    $conn->query($sql_delete);
    header("Location: viewData.php");
    exit();
}

// Handle edit action
if (isset($_POST['action']) && $_POST['action'] == 'edit') {
    $id = $_POST['id'];
    $type = $_POST['type'];
    $table = ucfirst($type) . 's';
    $column = ucfirst($type) . 'ID';
    $fields = [];

    foreach ($_POST as $key => $value) {
        if ($key != 'action' && $key != 'id' && $key != 'type') {
            $fields[] = "$key = '$value'";
        }
    }

    $sql_edit = "UPDATE $table SET " . implode(', ', $fields) . " WHERE $column = $id";
    $conn->query($sql_edit);
    header("Location: viewData.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data - Travel Bliss</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/register.css">
    <link rel="stylesheet" href="css/viewData.css"> <!-- Ensure the new CSS file is linked -->
    <style>
        #data-section {
            display: none;
        }
        .error-input {
            border: 2px solid red;
        }
    </style>
</head>

<body>
    <section>
        <h2>Enter Password to View Data</h2>
        <input type="password" id="password-input" placeholder="Enter password">
        <button onclick="checkPassword()">Submit</button>
    </section>

    <section id="data-section">
        <div class="data-group">
            <h2>Registered Users</h2>
            <button onclick="hideData()">Hide Data</button>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Sex</th>
                    <th>Age</th>
                    <th>Profile Picture</th>
                    <th>Actions</th>
                </tr>
                <?php
                if ($result_users->num_rows > 0) {
                    while($row = $result_users->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['UserID']}</td>
                                <td>{$row['Username']}</td>
                                <td>{$row['Email']}</td>
                                <td>{$row['Sex']}</td>
                                <td>{$row['Age']}</td>
                                <td><img src='uploads/{$row['ProfilePicture']}' alt='Profile Picture' width='50'></td>
                                <td>
                                    <a href='edit.php?id={$row['UserID']}&type=user'>Edit</a> |
                                    <a href='delete.php?id={$row['UserID']}&type=user'>Delete</a>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>No users found</td></tr>";
                }
                ?>
            </table>
        </div>

        <div class="data-group">
            <h2>Flight Listings</h2>
            <table>
                <tr>
                    <th>Flight Number</th>
                    <th>Departure</th>
                    <th>Arrival</th>
                    <th>Departure Time</th>
                    <th>Arrival Time</th>
                    <th>Price</th>
                    <th>Airline</th>
                    <th>Flight Image</th>
                    <th>Actions</th>
                </tr>
                <?php
                if ($result_flights->num_rows > 0) {
                    while($row = $result_flights->fetch_assoc()) {
                        $formattedPrice = $row['Price'] > 0 ? '$' . number_format($row['Price'], 2) : 'Price Not Available';
                        echo "<tr>
                                <td>{$row['FlightNumber']}</td>
                                <td>{$row['Departure']}</td>
                                <td>{$row['Arrival']}</td>
                                <td>{$row['DepartureTime']}</td>
                                <td>{$row['ArrivalTime']}</td>
                                <td>{$formattedPrice}</td>
                                <td>{$row['Airline']}</td>
                                <td><img src='uploads/{$row['FlightImage']}' alt='Flight Image' width='50'></td>
                                <td>
                                    <a href='edit.php?id={$row['FlightID']}&type=flight'>Edit</a> |
                                    <a href='delete.php?id={$row['FlightID']}&type=flight'>Delete</a>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='9'>No flights found</td></tr>";
                }
                ?>
            </table>
        </div>

        <div class="data-group">
            <h2>Hotel Listings</h2>
            <table>
                <tr>
                    <th>Hotel Name</th>
                    <th>Location</th>
                    <th>Price per Night</th>
                    <th>Check-in Time</th>
                    <th>Check-out Time</th>
                    <th>Amenities</th>
                    <th>Hotel Image</th>
                    <th>Actions</th>
                </tr>
                <?php
                if ($result_hotels->num_rows > 0) {
                    while($row = $result_hotels->fetch_assoc()) {
                        $formattedPrice = $row['PricePerNight'] > 0 ? '$' . number_format($row['PricePerNight'], 2) : 'Price Not Available';
                        echo "<tr>
                                <td>{$row['HotelName']}</td>
                                <td>{$row['Location']}</td>
                                <td>{$formattedPrice}</td>
                                <td>{$row['CheckInTime']}</td>
                                <td>{$row['CheckOutTime']}</td>
                                <td>{$row['Amenities']}</td>
                                <td><img src='uploads/{$row['HotelImage']}' alt='Hotel Image' width='50'></td>
                                <td>
                                    <a href='edit.php?id={$row['HotelID']}&type=hotel'>Edit</a> |
                                    <a href='delete.php?id={$row['HotelID']}&type=hotel'>Delete</a>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>No hotels found</td></tr>";
                }
                ?>
            </table>
        </div>

        <div class="data-group">
            <h2>Package Listings</h2>
            <table>
                <tr>
                    <th>Package Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Itinerary</th>
                    <th>Package Image</th>
                    <th>Actions</th>
                </tr>
                <?php
                if ($result_packages->num_rows > 0) {
                    while($row = $result_packages->fetch_assoc()) {
                        $formattedPrice = $row['Price'] > 0 ? '$' . number_format($row['Price'], 2) : 'Price Not Available';
                        echo "<tr>
                                <td>{$row['PackageName']}</td>
                                <td>{$row['Description']}</td>
                                <td>{$formattedPrice}</td>
                                <td>{$row['StartDate']}</td>
                                <td>{$row['EndDate']}</td>
                                <td>{$row['Itinerary']}</td>
                                <td><img src='uploads/{$row['PackageImage']}' alt='Package Image' width='50'></td>
                                <td>
                                    <a href='edit.php?id={$row['PackageID']}&type=package'>Edit</a> |
                                    <a href='delete.php?id={$row['PackageID']}&type=package'>Delete</a>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>No packages found</td></tr>";
                }
                ?>
            </table>
        </div>

        <div class="data-group">
            <h2>Bookings</h2>
            <table>
                <tr>
                    <th>Booking ID</th>
                    <th>User ID</th>
                    <th>Destination ID</th>
                    <th>Booking Date</th>
                    <th>Status</th>
                </tr>
                <?php
                if ($result_bookings->num_rows > 0) {
                    while($row = $result_bookings->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['BookingID']}</td>
                                <td>{$row['UserID']}</td>
                                <td>{$row['DestinationID']}</td>
                                <td>{$row['BookingDate']}</td>
                                <td>{$row['Status']}</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No bookings found</td></tr>";
                }
                ?>
            </table>
        </div>

        <div class="data-group">
            <h2>Destinations</h2>
            <table>
                <tr>
                    <th>Destination ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Location</th>
                    <th>Image URL</th>
                </tr>
                <?php
                if ($result_destinations->num_rows > 0) {
                    while($row = $result_destinations->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['DestinationID']}</td>
                                <td>{$row['Name']}</td>
                                <td>{$row['Description']}</td>
                                <td>{$row['Location']}</td>
                                <td><img src='{$row['ImageURL']}' alt='Destination Image' width='50'></td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No destinations found</td></tr>";
                }
                ?>
            </table>
        </div>

        <div class="data-group">
            <h2>Reviews</h2>
            <table>
                <tr>
                    <th>Review ID</th>
                    <th>User ID</th>
                    <th>Destination ID</th>
                    <th>Rating</th>
                    <th>Comment</th>
                    <th>Created At</th>
                </tr>
                <?php
                if ($result_reviews->num_rows > 0) {
                    while($row = $result_reviews->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['ReviewID']}</td>
                                <td>{$row['UserID']}</td>
                                <td>{$row['DestinationID']}</td>
                                <td>{$row['Rating']}</td>
                                <td>{$row['Comment']}</td>
                                <td>{$row['CreatedAt']}</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No reviews found</td></tr>";
                }
                ?>
            </table>
        </div>
    </section>
    <?php
    // Close connection
    $conn->close();
    ?>
    <script>
        function checkPassword() {
            const password = document.getElementById('password-input').value;
            if (password === 'password' || password === 'ps') {
                document.getElementById('data-section').style.display = 'block';
            } else {
                alert('Incorrect password');
            }
        }
        function hideData() {
            const dataSection = document.getElementById('data-section');
            dataSection.style.display = 'none';
        }

    </script>
</body>

</html>
