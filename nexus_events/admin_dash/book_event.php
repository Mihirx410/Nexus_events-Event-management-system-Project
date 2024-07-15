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


// Handle form submission for booking events
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['book_event'])) {

    $eventName = $_POST['eventName'];
    $venueName = $_POST['venueName'];
    $price = $_POST['price'];
    $firstName = $_POST['firstName'];
    $middleName = isset($_POST['middleName']) ? $_POST['middleName'] : '';
    $lastName = $_POST['lastName'];
    $numOfGuests = $_POST['numOfGuests'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $eventDate = $_POST['eventDate'];

    // Insert data into database
    $sql= "INSERT INTO registrations (event_type, venue, price, first_name, middle_name, last_name, num_of_guests, address, email, phone,event_date) 
    VALUES ('$eventName', '$venueName', '$price', '$firstName', '$middleName', '$lastName', '$numOfGuests', '$address', '$email', '$phone','$eventDate')";

     $sql2="INSERT INTO admin_event_details (event_type, event_date)
     VALUES ('$eventName','$eventDate')";

    if(($conn->query($sql) === TRUE) && ($conn->query($sql2)=== TRUE ))
     {
        echo "New event created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['update_status'])) {
        $eventId = $_POST['event_id'];
        $eventStatus = $_POST['event_status'];

         // Update event status in the admin_event_details table
         $sql = "UPDATE admin_event_details SET status = '$eventStatus' WHERE id = $eventId";
         if ($conn->query($sql) === TRUE) {
             echo "Event status updated successfully";
         } else {
             echo "Error updating event status: " . $conn->error;
         }
    }
}

?>
<html>
    <body>
        <head>
            <h3>Event Booking</h3>
            <link rel="stylesheet" href="style.css">
    <script>
        function confirmAction(action) {
            return confirm("Are you sure you want to " + action + "?");
        }
    </script>
        </head>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"onsubmit="return confirmAction('book the event')">
                <label for="event_name">Event Name:</label><br>
                <input type="text" id="event_name" name="eventName"><br><br>

            <label for="event_date">Event Date:</label><br>
            <input type="date" id="event_date" name="eventDate"><br><br>

            <label for="venuename">Venue Name:</label><br>
        <input type="text" name="venueName"><br><br>

        <label for="venueprice">Price:</label><br>
        <input type="text" id="selectedPrice" name="price"><br><br>

        <label for="firstName">First Name:</label>
        <input type="text" id="firstName" name="firstName" required><br><br>
        
        <label for="middleName">Middle Name:</label>
        <input type="text" id="middleName" name="middleName"><br><br>
        
        <label for="lastName">Last Name:</label>
        <input type="text" id="lastName" name="lastName" required><br><br>

        <label for="numOfGuests">Number of Guests:</label>
        <input type="number" id="numOfGuests" name="numOfGuests" required><br><br>

        <label for="address">Address:</label>
        <textarea id="address" name="address" required></textarea><br><br>
       
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>
        
        <label for="phone">Phone Number:</label>
        <input type="tel" id="phone" name="phone" required><br><br>
            <!-- Add more fields as needed for event booking -->
            <input type="submit" name="book_event" value="Book Event">
        </form>

        
    </body>
</html>