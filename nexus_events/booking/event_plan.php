<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Planning</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Event Planning</h1>
    <form action="venue.php" method="post" onsubmit="return validateForm()">
        <p style="color:#10236a;; text-align:center; font-size:16px";>You are three steps away from your desiered event...</p>
        <p>Select your event:</p>
        <div class="container">
            <div class="event-card" onclick="selectEvent('Virtual Event')" oneclick ="getoption(this)">
                <img class="event-image" id="1" src="event_img/networking_event.jpeg" alt="Virtual Event Image">
                <p class="event-text">Networking event</p>
            </div>
            <div class="event-card" onclick="selectEvent('Wedding Event')">
                <img class="event-image" id="2" src="event_img/weddingimage2.jpg" alt="Wedding Event Image">
                <p class="event-text">Wedding Event</p>
            </div>
            <!-- Add more event cards as needed -->
            <div class="event-card" onclick="selectEvent('Bday Event')" oneclick ="getoption(this)">
                <img class="event-image"  id="3" src="event_img/birthday.jpeg" alt="Event Image">
                <p class="event-text">Birthday Event</p>
            </div>
            <div class="event-card" onclick="selectEvent('Corporate Event')" oneclick ="getoption(this)">
                <img class="event-image" id="4" src="event_img/corporate.jpeg" alt="Event Image">
                <p class="event-text">Corporate Event</p>
            </div>
            <div class="event-card" onclick="selectEvent('Seminar Event')" oneclick ="getoption(this)">
                <img class="event-image" id="5" src="event_img/seminar.jpeg" alt="Event Image">
                <p class="event-text">Seminar</p>
            </div>
            <div class="event-card" onclick="selectEvent('Charity Event')" oneclick ="getoption(this)">
                <img class="event-image" id="6" src="event_img/charity.jpeg" alt="Event Image">
                <p class="event-text">Charity Event</p>
            </div>
            <input type="hidden" id="selectedEvent" name="eventType" value="">
        </div>
        <input type="submit" value="Next">
    </form>

   <script>
       
        function selectEvent(eventType) {
            document.getElementById('selectedEvent').value = eventType;
            document.getElementById('eventForm').submit();
        }

        function validateForm() {
            var selectedEvent = document.getElementById('selectedEvent').value;

            if (!selectedEvent) {
                alert("Please select an event type.");
                return false;
            }

            return true;
        }
    </script>
</body>
</html>

