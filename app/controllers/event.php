<?php

class Event extends Controller
{
    public function addEvent()
    {
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            require_once __DIR__ . '/../services/DatabaseService.php';
            DatabaseService::load();

            $name = $_POST['name'];
            $userId = $_SESSION['user_id'];
            $fieldId = $_POST['field_id'];
            $maxParticipants = $_POST['max_participants'];
            $eventTimeStart = $_POST['event_time_start'];
            $eventTimeEnd = $_POST['event_time_end'];
            $description = $_POST['description'];

            $start = new DateTime($eventTimeStart);
            $end = new DateTime($eventTimeEnd);

            $interval = $start->diff($end);
            $Hours = ($interval->days * 24) + $interval->h + ($interval->i / 60) + ($interval->s / 3600);

            if ($Hours > 6) {
                $errorMessage = "Durata evenimentului nu poate depasi 6 ore.";
                $_SESSION['errorMessage'] = $errorMessage;
                header("Location: ../home/mainPage"); 
                exit;
            }


            $sql = "INSERT INTO events (name, creator_id, field_id, max_participants, event_time_start, event_time_end, description)
                VALUES (?, ?, ?, ?, ?, ?, ?)";

            $success = DatabaseService::runDML($sql, "siiisss", $name, $userId, $fieldId, $maxParticipants, $eventTimeStart, $eventTimeEnd, $description);

            if ($success) {
                header("Location: ../home/mainPage"); 
                exit;
            } else {
                echo "Eroare la salvarea evenimentului!";
            }
        }
    }
}
