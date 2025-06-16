<?php
DatabaseService::load();

$sql = "SELECT id, osm_id, lat, lon, name, sport, surface FROM sports_fields";
$locations = DatabaseService::runLocations($sql);


if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$errorMessage = "";
if (isset($_SESSION['errorMessage'])) {
    $errorMessage = $_SESSION['errorMessage'];
    unset($_SESSION['errorMessage']); 
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sports Meetup - Find Courts</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo Config::get("APP_URL"); ?>/css/mainStyle.css">
    <link rel="stylesheet" href="<?php echo Config::get("APP_URL"); ?>/css/modal.css">
    <link rel="stylesheet" href="<?php echo Config::get("APP_URL"); ?>/css/errorStyles.css">
    <style>
        .error-notification {
            background-color: #f44336;
            color: white;
            padding: 15px 20px;
            margin-bottom: 10px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.3);
            font-family: Arial, sans-serif;
            min-width: 250px;
            opacity: 0.95;
            transition: opacity 0.3s ease;
        }
    </style>
    <script src="<?php echo Config::get("APP_URL"); ?>/js/utils/notifications.js" defer></script>
    

</head>
<!-- MODAL FORMULAR addEvent -->
 <?php include_once __DIR__ . '/../partials/eventModal.php'; ?>
 
<body>
<?php include_once __DIR__ . '/../partials/errorDiv.php'; ?>


<nav>
    <div class="logo">
        Sport<span>IS</span>
    </div>
    <div>
        <a href="#home">Home</a>
        <a href="#about">Events</a>
        <a href="#contact">Social</a>
        <a href="#login">Profile</a>
        <form action="../home/logout" method="post" style="display: inline;">
            <button type="submit" style="background: none; border: none; color: inherit; cursor: pointer;">Logout</button>
        </form>
    </div>
</nav>

<div class="container">
    <h1>Find Sports Courts in Your Area</h1>
    <div id="map"></div>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <script>
        function showError(message) {
            const container = document.getElementById('error-container');
            if (!container) return;

            const notif = document.createElement('div');
            notif.className = 'error-notification';
            notif.textContent = message;

            container.appendChild(notif);

            setTimeout(() => {
                notif.style.opacity = '0';
                setTimeout(() => container.removeChild(notif), 300);
            }, 5000);
        }

        // Initializare mapa
        var map = L.map('map').setView([47.1585, 27.6014], 13); // Set default view (change coordinates to your city's center)
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        function openEventModal(fieldId) {
            document.getElementById('field_id').value = fieldId; // setează hidden field
            document.getElementById('eventModal').style.display = 'block';
        }

        document.getElementById('closeModal').onclick = function() {
            document.getElementById('eventModal').style.display = 'none';
        };

        window.onclick = function(event) {
            if (event.target == document.getElementById('eventModal')) {
                document.getElementById('eventModal').style.display = 'none';
            }
        };


        // Adaugarea markerelor pe harta
        <?php foreach ($locations as $location): ?>
            L.marker([<?php echo $location['lat']; ?>, <?php echo $location['lon']; ?>])
                .addTo(map)
                .bindPopup(`
                    <b>ID: <?php echo $location['id']; ?></b>
                    <?php if($location['name']) echo "<br>Name: ". $location['name']; ?>
                    <?php if($location['sport']) echo "<br>Sport: ". $location['sport']; ?>
                    <?php if($location['surface']) echo "<br>Surface: " . $location['surface']; ?>
                    <br><br>
                    <?php ?> // verifica daca exista evenimente pentru acest teren
                    <button style="border-radius: 10px; opacity: 80%; background-color:rgb(46, 206, 218); color: white;">Vizualizeaza Evenimente</button>
                    <br>
                    <button style="border-radius: 10px; opacity: 80%; background-color:rgb(64, 172, 67); color: white;" onclick="openEventModal(<?php echo $location['id']; ?>)">Adauga Eveniment</button>
                `);
        <?php endforeach; ?>
    </script>
    <div class="upcoming-events">
        <h2>Evenimente: </h2>
        <ul>
    
        </ul>
    </div>
</div>



</body>
</html>
