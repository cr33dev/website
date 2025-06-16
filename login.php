<?php
session_start();

$mysqli = new mysqli("localhost", "root", "", "mrgreedybuys");
if ($mysqli->connect_errno) {
    die("Failed to connect to MySQL: " . $mysqli->connect_error);
}

$username = trim($_POST["username"] ?? '');
$password = trim($_POST["password"] ?? '');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stmt = $mysqli->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result && $result->num_rows === 1) {
        $_SESSION["username"] = $username;
        header("Location: index.php");
        exit();
    } else {
        echo "<h1>Login Failed</h1>";
        echo "<p>Invalid username or password.</p>";
        echo "<p><a href='index.html'>Try Again</a></p>";
    }
    $stmt->close();
} else {
    echo "<h1>Access Denied</h1>";
    echo "<p>Please submit the form properly.</p>";
    echo "<p><a href='index.html'>Go to Login Page</a></p>";
}
$mysqli->close();
?>