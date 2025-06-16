<?php // starts php section
session_start(); // starts the session of php (so php can do its thing)
session_destroy(); // destroys the session so that the users credentials are forgotten
header('Location: index.html'); // redirects the user to the home page (to login if they want)
exit; // exits the php
?> <!--this ends the php section (so that you can put something else)-->