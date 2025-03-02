<?php
// Database connection
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "travel_bliss";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $sex = $_POST['sex'];
    $age = $_POST['age'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $profile_picture = $_FILES['profile_picture']['name'];

    // Upload profile picture
    if ($profile_picture) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($profile_picture);
        move_uploaded_file($_FILES['profile_picture']['tmp_name'], $target_file);
    }

    $sql = "INSERT INTO Users (Username, PasswordHash, Email, Sex, Age, ProfilePicture) VALUES ('$username', '$password', '$email', '$sex', $age, '$profile_picture')";
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
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
    <title>Register - Travel Bliss</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/register.css">
</head>

<header>
    <nav>
        <a href="index.php">
            <img src="images/logoo.png" alt="Travel Bliss Logo" class="logo">
            <span class="logo-text">Travel Bliss</span>
        </a>
        <ul>
            <li><a href="flights.php">Flights</a></li>
            <li><a href="hotels.php">Hotels</a></li>
            <li><a href="packages.php">Packaged Tour</a></li>
            <li><a href="creator.php" class="create-button">Create Listing</a></li>
        </ul>
    </nav>
</header>

<body>
    <section>
        <h1>Create an Account</h1>
        <form action="register.php" method="post" enctype="multipart/form-data">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required><br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br>

            <label for="sex">Sex:</label>
            <select id="sex" name="sex" required>
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="other">Other</option>
            </select><br>

            <label for="age">Age:</label>
            <input type="number" id="age" name="age" required><br>

            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required><br>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br>

            <label for="profile_picture">Profile Picture:</label>
            <input type="file" id="profile_picture" name="profile_picture"><br>

            <input type="submit" value="Register">
        </form>
    </section>
    <?php
    // Close connection
    $conn->close();
    ?>
</body>
<script src="/js/register.js"></script>

</html>
