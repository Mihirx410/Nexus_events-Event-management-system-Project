<?php 
session_start();
function checkLoggedIn() {
    if (!isset($_SESSION['isAdmin'])) {
        header("Location: ../Authentication/login.html"); // Redirect to the login page
        exit();
    }
}
checkLoggedIn();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <h2>Admin Dashboard</h2>
    
    <div class="welcometext">
        <h1>Welcome to ADMIN Dashboard</h1>
    </div>
    <!-- Add your CSS stylesheets here -->
    <link rel="stylesheet" href="style.css">
    <script>
        function confirmAction(action) {
            return confirm("Are you sure you want to " + action + "?");
        }
    </script>
</head>
<body>
    <
    <!-- Left Sidebar -->
    <div class="sidebar">
        <ul>
            <li><a href="users.php" target="content">User Details</a></li>
            <li><a href="book_event.php" target="content">Book Event</a></li>
            <li><a href="event_details.php" target="content">Event Details</a></li>
        </ul>
    </div>
            <div>
            <form id="logoutForm" method="post" action="../php/logout.php">
            <button type="submit" style=
            "padding: 7px 25px; 
            margin: 2px 8px;
             position: relative;
             padding: 11px 25px;
            margin: -5px 9px;
            position: sticky;
            float: right;
            margin-top: -105px;
            left: 130px;" class="btn btn-primary" name="logout">Logout</button>
            </div>

    <!-- Right Content Area -->
    <div class="main-content">
        <iframe name="content" frameborder="0" width="100%" height="100%"></iframe>
    </div>
</body>
</html>
