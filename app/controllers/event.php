<?php

class Event extends Controller
{
    public function addEvent()
    {
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            require_once __DIR__ . '/../services/DatabaseService.php';
            DatabaseService::load();
            require_once __DIR__ . '/../models/EventModel.php';

            $name = $_POST['name'];
            $userId = $_SESSION['user_id'];
            $fieldId = $_POST['field_id'];
            $maxParticipants = $_POST['max_participants'];
            $eventTimeStart = $_POST['event_time_start'];
            $eventTimeEnd = $_POST['event_time_end'];
            $description = $_POST['description'];
            $rawTags = $_POST['tags'] ?? '';
            $tagsArray = array_filter(array_map('trim', explode(',', $rawTags)));


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

            $success = EventModel::registerEvent($name, $userId, $fieldId, $maxParticipants, $eventTimeStart, $eventTimeEnd, $description);

            if ($success) {
                 $eventID = DatabaseService::getLastInsertId();

                foreach($tagsArray as $tag){
                    $tagCheck = EventModel::findTagByName($tag);
                    if(!empty($tagCheck)) {
                        $tagID = $tagCheck['id'];
                    } else {
                        EventModel::insertTagInTags($tag);
                        $tagID = DatabaseService::getLastInsertId();
                    }
                    $exists = DatabaseService::runSelect("SELECT * FROM event_tags WHERE event_id = $eventID AND tag_id = $tagID");
                    if(empty($exists)) {
                        EventModel::insertEventTag($eventID, $tagID);
                    }
                }
                
                header("Location: ../home/mainPage"); 
                exit;
            } else {
                echo "Eroare la salvarea evenimentului!";
            }

        }
    }
}
