<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <style>
 /* Reset default browser styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Global styles */
body {
    font-family: 'Poppins', sans-serif;
    background-color:#101820;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    overflow:hidden;
}

.container {
    background-color:rgb(46 254 247 / 60%);
    padding: 40px;
    border-radius: 15px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    max-width: 950px;
    width: 100vw;
    height: auto;
    max-height: 98vh;
    margin: 10px 0px;
    overflow: auto;
    overflow-x:hidden;
    overflow-y:auto;
}

h1 {
    text-align: center;
    margin-bottom: 42px;
    font-size: 28px;
}

form {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
}

.form-group {
    flex-basis: 30%;
    margin-bottom: 25px;
}

label {
    font-weight: bold;
    margin-bottom: 10px;
    display: block;
}

input[type="text"],
input[type="email"],
input[type="tel"],
input[type="number"],
select,
textarea {
    width: 102%;
    padding: 12px;
    border: 1px solid #cccccc;
    border-radius: 6px;
    font-size: 15px;
    overflow:scroll;
}

input[type="date"] { /* Added input[type="date"] to select all date input fields */
    width: 100%;
    padding: 12px;
    border: 1px solid #cccccc;
    border-radius: 6px;
    font-size: 16px;
}

textarea {
    resize: vertical;
    min-height: 100px;
}

.submit-btn {
    background-color: black;
    color: #ffffff;
    padding: 16px 24px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    width: 100%;
    font-size: 18px;
}

.submit-btn:hover {
    background-color: rgba(46, 254, 247, 0.838);
    color:black;
}

/* Responsive design */
@media screen and (max-width: 768px) {
    .container {
        padding: 30px;
        width: 95%;
        max-height: 100vh;
    }

    .form-group {
        flex-basis: 48%;
    }

    .submit-btn {
        font-size: 16px;
    }
}

@media screen and (max-width: 480px) {
    .form-group {
        flex-basis: 100%;
    }
}
    </style>
</head>
<body>

<script>
    // Function to validate form fields
    function validateForm() {
        var eventName = document.forms["registrationForm"]["eventName"].value;
        var venueName = document.forms["registrationForm"]["venueName"].value;
        var price = document.forms["registrationForm"]["price"].value;
        var firstName = document.forms["registrationForm"]["firstName"].value;
        var lastName = document.forms["registrationForm"]["lastName"].value;
        var numOfGuests = document.forms["registrationForm"]["numOfGuests"].value;
        var address = document.forms["registrationForm"]["address"].value;
        var email = document.forms["registrationForm"]["email"].value;
        var phone = document.forms["registrationForm"]["phone"].value;

        // Perform validation here, if needed
        // You can check if fields are not empty or follow any specific format

        return true; // Return true if validation succeeds, false otherwise
    }

</script>


<?php
include "conn.php"; // Assuming this file contains your database connection code

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all required fields are filled out
    if (!empty($_POST['eventName']) && !empty($_POST['venueName']) && !empty($_POST['price']) && !empty($_POST['firstName']) && !empty($_POST['lastName']) && !empty($_POST['numOfGuests']) && !empty($_POST['address']) && !empty($_POST['email']) && !empty($_POST['phone'])) {
        
        // Retrieve form data
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
        $eventDate = $_POST['event_date'];


        // Your database connection code
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "nexus_events";

        // Create connection
        $conn = mysqli_connect($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare SQL statement to insert data into the database
        $sql1= "INSERT INTO registrations (event_type, venue, price, first_name, middle_name, last_name, num_of_guests, address, email, phone,event_date) 
                VALUES ('$eventName', '$venueName', '$price', '$firstName', '$middleName', '$lastName', '$numOfGuests', '$address', '$email', '$phone','$eventDate')";
        $sql2="INSERT INTO admin_event_details (event_type, event_date)
                VALUES ('$eventName','$eventDate')";
        $sql3 = "INSERT INTO event_history (event_type, event_date)
        VALUES ('$eventName', '$eventDate')";

        if (($conn->query($sql1) === TRUE) && ($conn->query($sql2) === TRUE) && ($conn->query($sql3) === TRUE)){
            // Registration successful
            // Extract price information
            $price = $_POST['price'];
            
            // Display a success message with a confirmation dialog including the price
            echo "<script>
                    var price = '" . $price . "';
                    var confirmation = confirm('Do you want to proceed with ' + price +' /- rs');
                    if (confirmation) {
                        window.location.href = 'event_history.php';
                        // Additional message for successful registration
                        alert('Register success');
                    } else {
                        alert('Registration unsuccessful');
                    }
                   
                </script>";
        } else {
            // If there was an error, display an error message
            echo "Error: " . $sql . "<br>" . $conn->error;
        }


        // Close the database connection
        $conn->close();
    } else {
        // If not all required fields are filled out, display an error message
        // echo "All fields must be filled out";
    }
}
?>

<!-- Rest of your HTML code -->

    <?php

        // Fetch data from event_plan.php
        $eventName = isset($_POST['eventType']) ? $_POST['eventType'] : '';

        // Fetch data from venue.php
        $venueName = isset($_POST['venue']) ? $_POST['venue'] : '';
        $price = isset($_POST['price']) ? $_POST['price'] : '';
    ?>
    
    <div class="container">
        <h1>Registration Form</h1>
        <form action="reg_form.php" method="post" onsubmit="return validateForm()" id="registrationForm">
            <div class="form-group">
                <label for="eventname">Event Name:</label>
                <input type="text" name="eventName" value="<?php echo $eventName; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="venuename">Venue Name:</label>
                <input type="text" name="venueName" value="<?php echo $venueName; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="venueprice">Price:</label>
                <input type="text" name="price" value="<?php echo $price; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="firstName">First Name:</label>
                <input type="text" id="firstName" name="firstName" required>
            </div>
            <div class="form-group">
                <label for="middleName">Middle Name:</label>
                <input type="text" id="middleName" name="middleName">
            </div>
            <div class="form-group">
                <label for="lastName">Last Name:</label>
                <input type="text" id="lastName" name="lastName" required>
            </div>
            <div class="form-group">
                <label for="numOfGuests">Number of Guests:</label>
                <input type="number" id="numOfGuests" name="numOfGuests" required>
            </div>
            <div class="form-group">
                <label for="event_date">Event Date:</label>
                <input type="date" id="event_date" name="event_date">
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <textarea id="address" name="address" required></textarea>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone Number:</label>
                <input type="tel" id="phone" name="phone" required>
            </div>
            <button type="submit" class="submit-btn">Register</button>
        </form>
    </div>

</body>
</html>