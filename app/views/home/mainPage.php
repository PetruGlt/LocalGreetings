
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sports Meetup - Find Courts</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link rel="stylesheet" href="/LocalGreetings/public/css/mainStyle.css">
</head>
<body>

<div class="container">
    <h1>Find Sports Courts in Your Area</h1>
    <div id="map"></div>
    
    <div class="court-info">
        <h2>Available Courts</h2>
        <ul>
            
        </ul>
    </div>
</div>

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>

var map = L.map('map').setView([47.1585, 27.6014], 13); // Set default view (change coordinates to your city's center)

// Add OpenStreetMap tile layer
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);



</script>
</body>
</html>
