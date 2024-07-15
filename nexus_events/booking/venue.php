<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Venue Selection</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
        $eventType = isset($_POST['eventType']) ? $_POST['eventType'] : '';
    ?>
    <h1>Venue Selection</h1>
    <form action="reg_form.php" method="post" onsubmit="return validateForm()">
        <input type="hidden" name="eventType" value="<?php echo $eventType; ?>">
        <p>Select a venue for your event:</p>
        <div class="container">
            <div class="event-card" onclick="selectVenue('Narayani Heights, Ahmedabad','5000')">
                <img class="event-image" src="venue_img/narayani-heights-ahemdabad-venue.jpg" alt="venue Image">
                <p class="event-text">Narayani Heights, Ahmedabad &nbsp&nbsp price:&nbsp5000rs/-</p>
                <p>Capacity:  small event</p>
            </div>
            <div class="event-card" onclick="selectVenue('Karia Lake Party Plot, Ahmedabad','10000')">
                <img class="event-image" src="venue_img/karia-lake-party-plot-naroda-ahmedabad343.jpg" alt="venue Image">
                <p class="event-text">Karia Lake Party Plot, Ahmedabad price:&nbsp10000rs/-</p>
                <p>Capacity:  small event</p>
            </div>
            <!-- Add more event cards as needed -->
            <div class="event-card" onclick="selectVenue('Effice Sarovar Portico, Bhavnagar','15000')">
                <img class="event-image" src="venue_img/sarovar1.jpg" alt="venue Image">
                <p class="event-text">Effice Sarovar Portico, Bhavnagar  price:&nbsp15000rs/-</p>
                <p>Capacity:  medium event</p>
            </div>
            <div class="event-card" onclick="selectVenue('Laxmi Vilas Palace, Baroda','20000')">
                <img class="event-image" src="venue_img/laxmi vilas - baroda.jpg" alt="venue Image">
                <p class="event-text">Laxmi Vilas Palace, Baroda &nbsp&nbsp&nbsp&nbsp&nbsp price:&nbsp20000rs/-</p>
                <p>Capacity:  medium event</p>
            </div>
            <div class="event-card" onclick="selectVenue('Daksh Resort, Gir-Somnath','25000')">
                <img class="event-image" src="venue_img/daksh resort.jpg" alt="Event Image">
                <p class="event-text">Daksh Resort, Gir-Somnath &nbsp &nbsp &nbsp  price:&nbsp25000rs/-</p>
                <p>Capacity:  large event</p>
            </div>
            <div class="event-card" onclick="selectVenue('Top-3 Lords Resort, Bhavnagar','15000')">
                <img class="event-image" src="venue_img/top3 lord.jpg" alt="Event Image">
                <p class="event-text">Top-3 Lords Resort, Bhavnagar  price:&nbsp30000rs/-</p>
                <p>Capacity:  large event</p>
            </div>
            <!-- Add more venue cards as needed -->
            <input type="hidden" id="selectedVenue" name="venue" value="">
            <input type="hidden" id="selectedPrice" name="price" value="">
        </div>
        <input type="submit" value="Next">
    </form>

    <script>
        function selectVenue(venue, price) {
            document.getElementById('selectedVenue').value = venue;
            document.getElementById('selectedPrice').value = price;
            // Display selected venue and price on the form
            document.getElementById('venueDisplay').innerHTML = "Selected Venue: " + venue;
            document.getElementById('priceDisplay').innerHTML = "Price: " + price;
        }

        function validateForm() {
            var selectedVenue = document.getElementById('selectedVenue').value;

            if (!selectedVenue) {
                alert("Please select a venue.");
                return false;
            }
            return true;
        }
    </script>
</body>
</html>
