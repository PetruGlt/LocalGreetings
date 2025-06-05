<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sports Meetup - Find Courts</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link rel="stylesheet" href="/LocalGreetings/public/css/mainStyle.css">
    <!-- Optional: Link to external CSS for the navbar -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Custom CSS for Navbar */
        nav {
            background-color: #333;
            padding: 10px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-left: 20px;
            padding-right: 20px;
        }
        nav .logo {
            font-family: 'Arial', sans-serif;
            font-size: 32px;
            font-weight: bold;
            color: #ffffff;
            text-transform: uppercase;
            letter-spacing: 2px;
            display: inline-block;
        }
        nav .logo span {
            color: #4CAF50; /* Accent color for the "IS" part */
        }
        nav a {
            color: white;
            padding: 14px 20px;
            text-decoration: none;
            display: inline-block;
        }
        nav a:hover {
            background-color: #575757;
        }
        .container {
            padding-top: 60px; 
        }
        #map {
            height: 500px; 
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav>
    <div class="logo">
        Sport<span>IS</span>
    </div>
    <div>
        <a href="#home">Home</a>
        <a href="#about">Events</a>
        <a href="#contact">Social</a>
        <a href="#login">Profile</a>
    </div>
</nav>

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
