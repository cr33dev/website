<?php
session_start();

// If no user in session, redirect to login page
if (!isset($_SESSION['username'])) {
    header('Location: index.html');  // or your login page
    exit();
}

$username = $_SESSION['username'];
?>

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
    <h1>Welcome to MrGreedyBuys, <?php echo htmlspecialchars($username); ?>!</h1>
</body>
</html>