<?php
// DatabaseService::load();

$sql = "SELECT id, osm_id, lat, lon, name, sport, surface FROM sports_fields";
$locations = DatabaseService::runSelect($sql);

$sql = "SELECT id, name FROM tags";
$tags = DatabaseService::runSelect($sql);

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
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sports Meetup - Find Courts</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link rel="stylesheet" href="<?= Config::get("APP_URL"); ?>/css/MainStyle.css">
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
    <script src="<?= Config::get("APP_URL"); ?>/js/eventList.js" defer></script>

</head>
<!-- MODAL FORMULAR addEvent -->
 <?php include_once __DIR__ . '/../partials/eventModal.php'; ?>
 
<body>
<?php include_once __DIR__ . '/../partials/errorDiv.php'; ?>


<?php include_once __DIR__ . '/../partials/navBar.php'; ?>

<div class="container">
    <h1>Terenurile de sport disponibile</h1>
    <div id="map"></div>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <script>
        // Initializare mapa
        var map = L.map('map').setView([47.1585, 27.6014], 13); // Iasi city center coord
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        map.zoomControl.remove(); // Elimina + si -

        // ascunde watermark
        document.querySelector('.leaflet-control-attribution')?.remove();

        function openEventModal(fieldId) {
            document.getElementById('field_id').value = fieldId; // setează hidden field
            document.getElementById('eventModal').style.display = 'block'; 
            document.body.classList.add('modal-open'); // blocare scroll fundal
        }

        document.getElementById('closeModal').onclick = function() {
            document.getElementById('eventModal').style.display = 'none';
            document.body.classList.remove('modal-open');
        };

        window.onclick = function(event) {
            if (event.target == document.getElementById('eventModal')) {
                document.getElementById('eventModal').style.display = 'none';
            }
        };

        var markerMap = new Map()
        var marker

        var locations = <?= json_encode($locations) ?>
        // Adaugarea markerelor pe harta
        locations.forEach((location) => {
            marker = L.marker([Number(location.lat), Number(location.lon)])
                .addTo(map)
                .bindPopup(`
                    <b>ID: ${location.id}</b>
                    ${!!location.name ? "<br>Name: " + location.name : ""}
                    ${!!location.sport ? "<br>Name: " + location.sport : ""}
                    ${!!location.surface ? "<br>Name: " + location.surface : ""}
                    <br><br>
                    <button onclick="window.location.href='/LocalGreetings/public/event/viewField/${location.id}'"
                        style="border-radius: 10px; opacity: 80%; background-color:rgb(46, 206, 218); color: white;"> Vizualizează Evenimente </button>
                    <button style="border-radius: 10px; opacity: 80%; background-color:rgb(64, 172, 67); color: white;" onclick="openEventModal(${location.id})">Adauga Eveniment</button>
                `);
            markerMap.set(Number(location.id), marker)
            
        })
    </script>
    <br><br>
    <div class="upcoming-events">
        <h1>Evenimente: </h1>
            <div class="filter-header">
                <form onsubmit="event.preventDefault(); getEvents(this)">
                    <div class="filter-element">
                        <label>Nume:</label>
                        <input type="text" name="name">
                    </div>

                    <div class="filter-element">
                        <label>Tag-uri</label>
                        <select name="tags[]" multiple>
                            <option value="0">Toate</option>
                            <?php foreach($tags as $tag): ?>
                                <option value="<?= $tag["id"] ?>"><?= $tag["name"] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="filter-element">
                        <label>De la:</label>
                        <input type="datetime-local" name="event_time_start">
                    </div>
                    
                    <div class="filter-element">
                        <label>Pana la:</label>
                        <input type="datetime-local" name="event_time_end">
                    </div>
                    
                    <div class="filter-element">    
                        <label>Max. part.:</label>
                        <input type="number" name="max_participants" min="2">
                    </div>
                    <input type="submit" value="Filtreaza">  
                </form>
            </div>
            <div class="event-header">
                <h2>Name</h2>
                <h2>|</h2>
                <h2>Max</h2>
                <h2>|</h2>
                <h2>Time</h2>
                <h2>|</h2>
                <h2>Tags</h2>
                <h2>|</h2>
                <h2>Actions</h2>
            </div>
            <ul id="event-list"></ul>
        </div>
    </div>
</div>
</body>
</html>
