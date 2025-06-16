<?php
session_start();

$username = htmlspecialchars(trim($_POST["username"] ?? ''), ENT_QUOTES, 'UTF-8'); # Sanitize input
$password = htmlspecialchars(trim($_POST["password"] ?? ''), ENT_QUOTES, 'UTF-8'); # Sanitize input

$authenticated = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Open the CSV file
    if (($handle = fopen("users.csv", "r")) !== FALSE) {
        // Skip the header
        fgetcsv($handle);
        // Check each row
        while (($data = fgetcsv($handle)) !== FALSE) {
            if (count($data) >= 2) {
                $csv_username = trim($data[0]);
                $csv_password = trim($data[1]);
                if ($username === $csv_username && $password === $csv_password) {
                    $authenticated = true;
                    break;
                }
            }
        }
        fclose($handle);
    }
    if ($authenticated) {
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