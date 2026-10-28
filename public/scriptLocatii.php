<?php
/**
 * CREATE TABLE `sports_fields` 
 * ( `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY, `osm_id` INT NOT NULL, 
 * `type` VARCHAR(50) NOT NULL, `lat` DECIMAL(9, 6), `lon` DECIMAL(9, 6), 'name' VARCHAR(100), `sport` VARCHAR(50) );
*/
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../app/core/Config.php';

Config::load();

$servername = Config::get('MYSQL_SERVER', '127.0.0.1');
$username = Config::get('MYSQL_USER', 'root');
$password = Config::get('MYSQL_PASSWORD', '');
$dbname = Config::get('MYSQL_DB', 'sportis'); 
$port = (int) Config::get('MYSQL_PORT', 3306);

$conn = new mysqli($servername, $username, $password, $dbname, $port);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$conn->set_charset("utf8mb4");

$overpassApiUrl = "https://overpass-api.de/api/interpreter";
$bodyData = "
[out:json][timeout:25];
area[\"name\"=\"Iași\"]->.searchArea; 
(
    nwr[\"leisure\"=\"pitch\"](area.searchArea);
    nwr[\"leisure\"=\"park\"](area.searchArea);
);
out tags geom;
";

$response = file_get_contents($overpassApiUrl, false, stream_context_create([
    'http' => [
        'method' => 'POST',
        'header' => 'Content-Type: application/x-www-form-urlencoded',
        'content' => "data=" . urlencode($bodyData)
    ]
]));

$data = json_decode($response, true);

if (!empty($data['elements'])) {
    foreach ($data['elements'] as $element) {
        
        $osm_id = $element['id'];
        $type = $element['type'];  
          
        $name = isset($element['tags']['name']) ? $element['tags']['name'] : null;
        $sport = isset($element['tags']['sport']) ? $element['tags']['sport'] : null;
        $surface = isset($element['tags']['surface']) ? $element['tags']['surface'] : null;
        
        if ($type === 'node' && isset($element['lat']) && isset($element['lon'])) {
            $lat = $element['lat'];
            $lon = $element['lon'];
        } else {
            $lat = null;
            $lon = null;
        
        if ($type === 'way' && isset($element['geometry'])) {
           
            $lat = $element['geometry'][0]['lat'];  
            $lon = $element['geometry'][0]['lon'];  
        }

      
        $stmt = $conn->prepare("INSERT INTO sports_fields (osm_id, type, lat, lon, name, sport, surface) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("issdsss", $osm_id, $type, $lat, $lon, $name, $sport, $surface); 

        if (!$stmt->execute()) {
            echo "Error: " . $stmt->error;
        }
    }
    }
} else {
    echo "No data found from Overpass API.";
}

$conn->close();
?>
