<?php // starts php section
session_start(); // starts the session of php (so php can do its thing)

if (!isset($_SESSION['username'])) { // checks if there is a username for the session
    header('Location: index.html');  //if not, redirects the user to the home page (to login if they want)
    exit(); //exits php
} //closes if

$username = $_SESSION['username']; // makes a variable that stores the username
?><!--closes the php section (so that i can put html)-->
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>MrGreedyBuys</title>
    <link rel="stylesheet" href="css/index.css">
</head>
<header>
    <h1>
        Sell At MrGreedyBuys
    </h1>
    <div class="link-line">
        <a href="sell.php">Sell</a>
        <a href="logout.php">Logout</a>
    </div>
</header>
<body>
    <h1>Welcome to MrGreedyBuys, <?php echo htmlspecialchars($username); ?>!</h1> <!-- php echo outputs the username without any special characters -->
</body>
</html>