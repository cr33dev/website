<?php // starts the php section
session_start(); // starts the session of php (so php can do its thing)

$mysqli = new mysqli("localhost", "root", "", "mrgreedybuys"); // connects to the sql server using localhost root user and no password and the database name.
if ($mysqli->connect_errno) { // if there is a connection error then:
    die("Failed to connect to MySQL: " . $mysqli->connect_error); // kills connection to sql and prints error
} //ends if

$username = trim($_POST["username"] ?? '');
$password = trim($_POST["password"] ?? '');
$email = trim($_POST["email"] ?? '');

if (!empty($username) && !empty($password)) {
    // Check if username exists
    $stmt = $mysqli->prepare("SELECT id FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        echo "<h1>Registration Failed</h1>";
        echo "<p>Username already exists. Please choose a different username or log in to your account.</p>";
        echo "<p><a href='index.html'>Try Again</a></p>";
        $stmt->close();
        $mysqli->close();
        exit();
    }
    $stmt->close();

    // Hash the password before storing
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $mysqli->prepare("INSERT INTO users (username, password, email) VALUES (?, ?, ?)");
    if (!$stmt) {
        die("Prepare failed: " . $mysqli->error);
    }
    $stmt->bind_param("sss", $username, $hashed_password, $email);
    $stmt->execute();
    $stmt->close();

    $_SESSION["username"] = $username;
    header("Location: index.php");
    exit();
} else {
    echo "<h1>Registration Failed</h1>";
    echo "<p>Username and password are required.</p>";
    echo "<p><a href='login.html'>Try Again</a></p>";
}
$mysqli->close();
