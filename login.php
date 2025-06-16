<?php
session_start();

$username = htmlspecialchars(trim($_POST["username"] ?? ''), ENT_QUOTES, 'UTF-8'); # Sanitize input
$password = htmlspecialchars(trim($_POST["password"] ?? ''), ENT_QUOTES, 'UTF-8'); # Sanitize input

$valid_username = "admin";
$valid_password = "admin";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($username === $valid_username && $password === $valid_password) {
        $_SESSION["username"] = $username;
        // Redirect to protected page
        header("Location: index.php");
        exit();
    } else {
        echo "<h1>Login Failed</h1>";
        echo "<p>Invalid username or password.</p>";
        echo "<p><a href='index.html'>Try Again</a></p>";
    }
} else {
    echo "<h1>Access Denied</h1>";
    echo "<p>Please submit the form properly.</p>";
    echo "<p><a href='index.html'>Go to Login Page</a></p>";
}
?>