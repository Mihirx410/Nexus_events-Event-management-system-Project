<?php
// Function to check if the user is logged in
function checkLoggedIn() {
    if (!isset($_SESSION['isAdmin']) && !isset($_SESSION['isGeneral'])) {
        header("Location: ../Authentication/login.html"); // Redirect to the login page
        exit();
    } else {
        header("Location: ../index.html");  // If already logged in, redirect to index 
        exit();
    }
}
session_start();

// Unset all of the session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to the login page or any other desired page after logout
header("Location: ../Authentication/login.html"); // Redirect to the login page

exit();
?>