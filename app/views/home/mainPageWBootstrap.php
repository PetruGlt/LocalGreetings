<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sportis"; 

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, osm_id, lat, lon, name, sport, surface FROM sports_fields";
$result = $conn->query($sql);


$locations = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $locations[] = $row; 
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sports Meetup - Find Courts</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link rel="stylesheet" href="<?php echo Config::get("APP_URL"); ?>/css/mainStyle.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
</head>
<!-- Modal formular creare eveniment -->
<div class="modal fade" id="eventModal" tabindex="-1" role="dialog" aria-labelledby="eventModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form method="POST" action="add_event.php">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Creează Eveniment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Închide">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="field_id" id="eventFieldId">
                
                <div class="form-group">
                    <label for="eventName">Nume Eveniment</label>
                    <input type="text" class="form-control" name="name" required>
                </div>
                
                <div class="form-group">
                    <label for="category">Categorie</label>
                    <select class="form-control" name="category">
                        <option value="first_come">Primul venit</option>
                        <option value="min_participations">Minim P participări</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="max_participants">Nr. maxim participanți</label>
                    <input type="number" class="form-control" name="max_participants" required>
                </div>

                <div class="form-group">
                    <label for="event_time">Data și ora</label>
                    <input type="datetime-local" class="form-control" name="event_time" required>
                </div>

                <div class="form-group">
                    <label for="description">Descriere</label>
                    <textarea class="form-control" name="description"></textarea>
                </div>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Salvează</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Anulează</button>
            </div>
        </div>
    </form>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    function openEventForm(fieldId) {
        document.getElementById('eventFieldId').value = fieldId;
        $('#eventModal').modal('show');
    }
</script>
<body>

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
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
    var map = L.map('map').setView([47.1585, 27.6014], 13); // Set default view (change coordinates to your city's center)
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    <?php foreach ($locations as $location): ?>
        L.marker([<?php echo $location['lat']; ?>, <?php echo $location['lon']; ?>])
            .addTo(map)
            .bindPopup(`<b>ID: <?php echo $location['id']; ?></b>
             <?php  if($location['name']) echo "<br>Name: ". $location['name']; ?>
             <?php  if($location['sport']) echo "<br>Sport: ". $location['sport']; ?>
             <?php  if($location['surface']) echo "<br>Surface: " . $location['surface']; ?>
              <br><button class='btn btn-primary btn-sm mt-2' onclick='openEventForm(<?php echo $location["id"]; ?>)'>Adaugă Eveniment</button>
              `);
    <?php endforeach; ?>

</script>
    <div class="court-info">
        <h2>Available Courts</h2>
        <ul>
    
        </ul>
    </div>
</div>




</body>
</html>
