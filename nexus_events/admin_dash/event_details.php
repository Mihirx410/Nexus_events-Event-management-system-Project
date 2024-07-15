<?php
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


// // Insert event details into the database if form data is received
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     $event_type = $_POST['event_type'];
//     $event_date = $_POST['event_date'];
//     $status = $_POST['status'];

//     // Insert event details into the database
//     $sql = "INSERT INTO admin_event_details (status) VALUES ('$status')";

//     // if ($conn->query($sql) === TRUE) {
//     //     echo "New record created successfully";
//     // } else {
//     //     echo "Error: " . $sql . "<br>" . $conn->error;
//     // }
// }


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

// Handle form submission for updating event status
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['update_status'])) {
        $eventId = $_POST['event_id'];
        $eventStatus = $_POST['event_status'];

        // Update event status in the registrations table
        $sql = "UPDATE registrations SET status = '$eventStatus' WHERE id = $eventId";
        if ($conn->query($sql) === TRUE) {
            echo "Event status updated successfully";
        } else {
            echo "Error updating event status: " . $conn->error;
        }

        // Update event status in the admin_event_details table
        $sql = "UPDATE admin_event_details SET status = '$eventStatus' WHERE id = $eventId";
        if ($conn->query($sql) === TRUE) {
            echo "Event status updated successfully";
        } else {
            echo "Error updating event status: " . $conn->error;
        }

        // Update query for event_history table
        $sql = "UPDATE event_history SET status = '$eventStatus' WHERE id = $eventId";

        // Execute the SQL statement
        if ($conn->query($sql) === TRUE) {
            echo "Event status updated successfully";
        } else {
            echo "Error updating event status: " . $conn->error;
        }


    }
     elseif (isset($_POST['delete_event'])) {
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
    }
}

?>
<html>
<body>
    <head>
        <h3>Event Details</h3>
        <link rel="stylesheet" href="style.css">
        <script>
            function confirmAction(action) {
                return confirm("Are you sure you want to " + action + "?");
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
                    <!-- Form for updating event status -->
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" onsubmit="return confirmAction('accept this event')">
                        <input type="hidden" name="event_id" value="<?php echo $event['id']; ?>">
                        <input type="hidden" name="event_status" value="accepted">
                        <button type="submit" name="update_status">Accept</button>
                    </form>
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" onsubmit="return confirmAction('decline this event')">
                        <input type="hidden" name="event_id" value="<?php echo $event['id']; ?>">
                        <input type="hidden" name="event_status" value="pending">
                        <button type="submit" name="update_status">Decline</button>
                    </form>
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" onsubmit="return confirmAction('delete this event')">
                        <input type="hidden" name="event_id" value="<?php echo $event['id']; ?>">
                        <button type="submit" name="delete_event">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
