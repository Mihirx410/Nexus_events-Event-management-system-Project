<?php
session_start();

// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$database = "nexus_events";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to fetch events from the database
function getEvents($conn) {
    $sql = "SELECT * FROM registrations";
    $result = $conn->query($sql);

    $events = array();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $events[] = $row;
        }
    }
    return $events;
}

// Handle form submission for deleting an event
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_event'])) {
    $eventId = $_POST['event_id'];

    // Delete event from the registrations table
    $sql = "DELETE FROM registrations WHERE id = $eventId";
    if ($conn->query($sql) === TRUE) {
        echo "Event deleted successfully";
    } else {
        echo "Error deleting event: " . $conn->error;
    }

    // Delete event from the admin_event_details table
    $sql = "DELETE FROM admin_event_details WHERE id = $eventId";
    if ($conn->query($sql) === TRUE) {
        echo "Event deleted successfully";
    } else {
        echo "Error deleting event: " . $conn->error;
    }

    $sql = "DELETE FROM event_history WHERE id = $eventId";
    if ($conn->query($sql) === TRUE) {
        echo "Event deleted successfully";
    } else {
        echo "Error deleting event: " . $conn->error;
    }
}

// Check if the user is logged in
if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] === true) {
    // User is an admin, display the home page link
    $homePageLink = "../admin_dash/dashboard.php";
} elseif (isset($_SESSION['isGeneral']) && $_SESSION['isGeneral'] === true) {
    // User is a general user, display the home page link
    $homePageLink = "../index.php";
} else {
    // User is not logged in, display a message
    $homePageLink = "#";
    echo "You must be logged in to access the home page.";
}
?>

<html>
<body>
<head>
    <h2>Event Details</h2>
    <style>
        /* Main CSS */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

        :root {
            --background-color1: #f8f9fa;
            --background-color2: #ffffff;
            --background-color3: #e9ecef;
            --background-color4: #dee2e6;
            --primary-color: #007bff;
            --secondary-color: #6c757d;
            --border-color: #ced4da;
            --one-use-color: #28a745;
            --two-use-color: #dc3545;
        }

        body {
            background-color: #101820;
            color: white;
        }

        section {
            margin-bottom: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid var(--border-color);
            padding: 10px;
        }

        th {
            background-color: rgb(46 254 247 / 60%);
            color: #fff;
            text-align: left;
            font-weight: 600;
        }

        td {
            text-align: center;
        }

        button {
            background-color: #42a5f5;
            color: #fff;
            border: none;
            padding: 10px 20px;
            margin: 4px 2px;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: rgba(46, 254, 247, 0.838);
        }

        input[type="text"],
        input[type="date"] {
            padding: 8px;
            width: 100%;
            border: 1px solid var(--border-color);
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: var(--primary-color);
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
        }

        input[type="submit"]:hover {
            background-color: var(--secondary-color);
        }

        /* Sidebar CSS */
        .sidebar {
            position: fixed;
            left: 0;
            top: 60px; /* Adjusted to leave space for the navbar */
            bottom: 0;
            width: 250px;
            background-color: var(--background-color2);
            overflow: auto;
        }

        li {
            padding: 20px;
            margin: 10px 0;
            border-radius: 5px;
            background-color: var(--primary-color);
            list-style: none;
        }

        li a {
            text-decoration: none;
            color: #fff;
            font-size: 16px;
            font-weight: 500;
        }

        /* Main content CSS */
        .main-content {
            margin-left: 250px; /* Width of the sidebar */
            padding: 20px;
            min-height: calc(100vh - 60px); /* Adjusted to leave space for the navbar */
            background-color: var(--background-color2);
        }

        .welcometext {
            font-size: 20px;
            text-decoration: underline;
            color: var(--primary-color);
            margin-bottom: 20px;
        }

        a{
        text-decoration: none;
        background-color: black;
        border-radius: 30px;
        padding: 13px 15px;
        text-align: center;
        color: white;
        margin: 0px 570px;
        font-size:20px;
        display:flex;
        position:relative;
        justify-content:center;
        top:200px;
        }

        a:hover{
            background-color: rgba(46, 254, 247, 0.838);
            border-radius:30px;
            color:black;
        }

        h2{
            text-align:center;
            margin:20px 20px;
            color:white;
        }
    </style>

    <script>
        function confirmAction(action) {
            return confirm("Are you sure you want to cancel" + action + "?");
        }
    </script>
</head>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Date</th>
        <th>Status</th>
        <th>Action</th>
    </tr>
    <?php $events = getEvents($conn); ?>
    <?php foreach($events as $event): ?>
        <tr>
            <td><?php echo $event['id']; ?></td>
            <td><?php echo $event['event_type']; ?></td>
            <td><?php echo $event['event_date']; ?></td>
            <td>
                <!-- Display event status -->
                <?php echo $event['status']; ?>
            </td>
            <td>
                <!-- Form for deleting event -->
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" onsubmit="return confirmAction('/delete this event')">
                    <input type="hidden" name="event_id" value="<?php echo $event['id']; ?>">
                    <button type="submit" name="delete_event">Cancel Booking</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<div class="home_button">
    <a href="<?php echo $homePageLink; ?>">Go back to home page</a>
</div>
</body>
</html>