<?php // starts the PHP section
session_start(); //starts the session of php (so php can do its thing)

// Get username and password from POST
$username = htmlspecialchars(trim($_POST["username"] ?? ''), ENT_QUOTES, 'UTF-8');
$password = htmlspecialchars(trim($_POST["password"] ?? ''), ENT_QUOTES, 'UTF-8');

// Check if the username password is already registered

if (($handle = fopen("users.csv", "r")) !== FALSE) { //sets variable to open the csv in read
    fgetcsv($handle); // opens the csv and skips the header row
    while (($data = fgetcsv($handle)) !== FALSE) { //loops through the csv file while there is data in it
        if (count($data) >= 2) { // only goes through when it picks up the username and password for each row
            $csv_username = trim($data[0]); // gets the username
            if ($username === $csv_username) { // checks if the username is the same as the one in the csv
                fclose($handle); //if yes, closes the csv file
                echo "<h1>Registration Failed</h1>"; //displays a message
                echo "<p>Username already exists. Please choose a different username or log in to your account.</p>"; // displays a message
                echo "<p><a href='index.html'>Try Again</a></p>"; // link to try again
                exit(); //stops php
            }
        }
    }
    fclose($handle); // closes the csv file (all username data is unique)
}

if (!empty($username) && !empty($password)) { // checks username and password for being empty
    if (($handle = fopen("users.csv", "a")) !== FALSE) { // sets variable to open the csv in append
        fputcsv($handle, [$username, $password]); // writes the username and password in the csv file
        fclose($handle); // close the csv file
    } //end if
    $_SESSION["username"] = $username; // creates variable for username in session
    header("Location: index.php"); // redirects to index.php
    exit(); // exits php
} else { //ends if and starts else
    echo "<h1>Registration Failed</h1>"; // on failure, displays a message
    echo "<p>Username and password are required.</p>"; // on failure, displays a message
    echo "<p><a href='register.html'>Try Again</a></p>"; // on failure, displays a message
} //ends else
?> ends the PHP section (so that you can put something else)