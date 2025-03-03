<?php
session_start();
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

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['register'])) {
        // Registration process
        $name = $_POST['name'] ?? null;
        $email = $_POST['email'];
        $sex = $_POST['sex'];
        $age = $_POST['age'] ?? null;
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $profile_picture = $_FILES['profile_picture']['name'] ?? null;

        // Upload profile picture
        if ($profile_picture) {
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($profile_picture);
            move_uploaded_file($_FILES['profile_picture']['tmp_name'], $target_file);
        }

        $sql = "INSERT INTO Users (Name, Username, PasswordHash, Email, Sex, Age, ProfilePicture) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssis", $name, $username, $password, $email, $sex, $age, $profile_picture);

        if ($stmt->execute()) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } elseif (isset($_POST['login'])) {
        // Login process
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM Users WHERE Username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user && password_verify($password, $user['PasswordHash'])) {
            $_SESSION['user_id'] = $user['UserID']; 
            $_SESSION['username'] = $user['Username'];

            header("Location: account.php");
            
        } else {
            echo '<script>alert("Invalid username or password.");</script>';
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
    <title>Register/Login - Travel Bliss</title>
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
            <li><a href="account.php" class="account-button">My Account</a></li>
        </ul>
    </nav>
</header>

<body>
    <section>
        <h1 id="form-title">Create an Account</h1>
        <form id="register-form" action="register.php" method="post" enctype="multipart/form-data">
            <label for="name">Name: <span class="optional">(Optional)</span></label>
            <input type="text" id="name" name="name"><br>

            <label for="email">Email: <span class="required">(Required)</span></label>
            <input type="email" id="email" name="email" required><br>

            <label for="sex">Sex: <span class="required">(Required)</span></label>
            <select id="sex" name="sex" required>
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="other">Other</option>
            </select><br>

            <label for="age">Age: <span class="optional">(Optional)</span></label>
            <input type="number" id="age" name="age"><br>

            <label for="username">Username: <span class="required">(Required)</span></label>
            <input type="text" id="username" name="username" required><br>

            <label for="password">Password: <span class="required">(Required)</span></label>
            <input type="password" id="password" name="password" required><br>

            <label for="profile_picture">Profile Picture: <span class="optional">(Optional)</span></label>
            <input type="file" id="profile_picture" name="profile_picture"><br>

            <input type="submit" name="register" value="Register">
        </form>

        <form id="login-form" action="register.php" method="post" style="display: none;">
            <label for="username">Username: <span class="required">(Required)</span></label>
            <input type="text" id="login-username" name="username" required><br>

            <label for="password">Password: <span class="required">(Required)</span></label>
            <input type="password" id="login-password" name="password" required><br>

            <input type="submit" name="login" value="Login">
        </form>

        <p id="toggle-form">
            Already have an account? <a href="#" onclick="toggleForm()">Login here</a>
        </p>
    </section>
    <?php
    // Close connection
    $conn->close();
    ?>
</body>
<script src="js/register.js"></script>

</html>
