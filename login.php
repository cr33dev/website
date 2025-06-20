<?php //starts the php section
session_start(); //starts the session of php (so php can do its thing)

$mysqli = new mysqli("localhost", "root", "", "mrgreedybuys"); // connects to the database I made
if ($mysqli->connect_errno) { // checks if any errors accrued in an if statement
    die("Failed to connect to MySQL: " . $mysqli->connect_error); // kills sql and displays the error if the database cannot be connected to
} //ends if

$username = trim($_POST["username"] ?? ''); //trims the username input from the form
$password = trim($_POST["password"] ?? ''); //trims the password input from the form

if ($_SERVER["REQUEST_METHOD"] == "POST") { // checks request type. if it is "POST" then it will continue
    $stmt = $mysqli->prepare("SELECT password FROM users WHERE username = ?"); // makes a variable with the sql query
    $stmt->bind_param("s", $username); // inserts the username and password into the query.
    $stmt->execute(); // executes the sql query
    $stmt->bind_result($hashed_password);
    if ($stmt->fetch() && password_verify($password, $hashed_password)) { // checks the amount of rows returned and if it is under 2
        $_SESSION["username"] = $username; // stores the username as a variable in the session
        header("Location: index.php"); // redirects the user to the index page
        exit(); // exits php
    } else { // if there are too many rows returned, or no rows returned it will stop and error message
        echo "<h1>Login Failed</h1>";
        echo "<p>Invalid username or password.</p>";
        echo "<p><a href='index.html'>Try Again</a></p>";
    }
    $stmt->close(); //closes the sql statement to free up space
} else { // if the request is not "POST" then it stops and error messages
    echo "<h1>Access Denied</h1>";
    echo "<p>Please submit the form properly.</p>";
    echo "<p><a href='index.html'>Go to Login Page</a></p>";
}
$mysqli->close(); // closes mysql connection
?> <!-- closes php section -->