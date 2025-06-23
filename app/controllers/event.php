<?php

require_once __DIR__ . '/../models/EventModel.php';

class Event extends Controller
{
    private $tagModel;
    private $userModel;

    public function __construct() {
        if(!$this->isAuthenticated()) {
            header("Location: /LocalGreetings/public/login/index");
            exit;
        }
        $this->tagModel = $this->model('Tag');
        $this->userModel = $this->model('User');
    }

    public function viewField($fieldId) {

        $events = EventModel::findEventsByFieldId($fieldId);
        if (empty($events)) {
            $_SESSION['errorMessage'] = "Nu exista evenimente pentru acest teren.";
            header("Location: /LocalGreetings/public/home/mainPage");
            
            exit;
        }

        $tags = $this->tagModel->getTagsForField($fieldId);
        
        $eventTags = [];
        if(!empty($tags)){
            foreach ($tags as $tag) {
                if($tag != null)
                    $eventTags[$tag['event_id']][] = $tag['name'];
                else continue;
            }
        }
        
        for( $i = 0; $i < count($events); $i++ ) {
            $creator = $this->userModel->findById($events[$i]['creator_id']);
            $events[$i]['creator_username'] = $creator['username'] ?? 'Necunoscut';
        }

        $this->view("event/viewField", ["events" => $events, "fieldId" => $fieldId, "eventTags" => $eventTags, "title" => "Lista evenimente pentru terenul $fieldId"]);
    }

    public function viewEvent($eventId) {
        $event = EventModel::findEventById($eventId);
        
        if (empty($event)) {
            $_SESSION['errorMessage'] = "Evenimentul nu a fost găsit.";
            header("Location: /LocalGreetings/public/home/mainPage");
            exit;
        }

        $event = $event[0];

        $hasStarted = new DateTime($event['event_time_start']) <= new DateTime();

        $fieldId = $event['field_id'];
        $tags = $this->tagModel->getTagsByEvent($eventId);
        if(!empty($tags))
            $tags = array_map(function ($tag) {
                return $tag["name"];
            }, $tags);

        $creator = $this->userModel->findById($event['creator_id']);
        $event['creator_username'] = $creator['username'] ?? 'Necunoscut';

        $errorMessage = "";
        if(isset($_SESSION['errorMessage'])) {
            $errorMessage = $_SESSION['errorMessage'];
            unset($_SESSION['errorMessage']);
        }

        $this->view("event/viewEvent", [
            "event" => $event,
            "fieldId" => $fieldId,
            "eventTags" => $tags,
            "isParticipant" => EventModel::isParticipant($eventId, $_SESSION['user_id']),
            "participants" => EventModel::getParticipants($eventId) ?? [],
            'isOwnEvent' => $event['creator_id'] == $_SESSION['user_id'],
            'errorMessage' => $errorMessage,
            'hasStarted' => $hasStarted
        ]);
    }

    public function editEvent($eventId) {
        $event = EventModel::findEventById($eventId);
        
        if (empty($event)) {
            $_SESSION['errorMessage'] = "Evenimentul nu a fost găsit.";
            header("Location: /LocalGreetings/public/home/mainPage");
            exit;
        }

        $event = $event[0];

        $fieldId = $event['field_id'];
        $tags = $this->tagModel->getTagsByEvent($eventId);
        if(!empty($tags))
            $tags = array_map(function ($tag) {
                return $tag["name"];
            }, $tags);
        $this->view("event/editEvent", [
            "event" => $event,
            "fieldId" => $fieldId,
            "eventTags" => $tags,
            "participants" => EventModel::getParticipants($eventId) ?? []
        ]);
    }

    public function addEvent()
    {
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $userId = $_SESSION['user_id'];
            $fieldId = $_POST['field_id'];
            $maxParticipants = $_POST['max_participants'];
            $eventTimeStart = $_POST['event_time_start'];
            $eventTimeEnd = $_POST['event_time_end'];
            $description = $_POST['description'];
            $tags = $_POST['tags'] ?? '';


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

                foreach($tags as $tag){
                    if($this->tagModel->checkEventTag($eventID, $tag)) {
                        EventModel::insertEventTag($eventID, $tag);
                    }
                }
                
                header("Location: ../home/mainPage"); 
                exit;
            } else {
                echo "Eroare la salvarea evenimentului!";
            }

        }
    }

    public function getEvents() {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {

            $filters = [];
            if(isset($_GET['name']))
                $filters['name'] = $_GET['name'];
            if(isset($_GET['event_time_start']))
                $filters['event_time_start'] = new DateTime($_GET['event_time_start']);
            if(isset($_GET['event_time_end']))
                $filters['event_time_end'] = new DateTime($_GET['event_time_end']);
            if(isset($_GET['max_participants']))
                $filters['max_participants'] = $_GET['max_participants'];
            if(isset($_GET['tags']))
                $filters['tags'] = $_GET['tags'];

            $events = EventModel::getEvents($filters);
            
            echo json_encode($events ?? []);

        }
    }
    
    public function deleteEvent($eventId) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $event = EventModel::findEventById($eventId);
            if (empty($event)) {
                http_response_code(404);
                die('Evenimentul nu a fost gasit');
            }
            if ($event[0]['creator_id'] != $_SESSION['user_id']) {
                http_response_code(403);
                die('Acces interzis.');
            }
            EventModel::deleteEvent($eventId);
        }
        header("Location: /LocalGreetings/public/home/mainPage");
        exit;
    }

    public function update($eventId) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $description = $_POST['description'];
            $eventTimeStart = $_POST['event_time_start'];
            $eventTimeEnd = $_POST['event_time_end'];
            $maxParticipants = $_POST['max_participants'];

            EventModel::updateEvent($eventId, $description, $eventTimeStart, $eventTimeEnd, $maxParticipants);
        }
        header("Location: /LocalGreetings/public/event/editEvent/" . $eventId);
        exit;
    }

    public function participate($eventId) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(EventModel::isFull($eventId)) {
                $_SESSION['errorMessage'] = 'Evenimentul e plin!';
                echo "Full";
            } else {
                EventModel::participate($eventId, $_SESSION['user_id']);
                echo "Success";
            }
        }
    }

    public function cancel($eventId) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            EventModel::cancel($eventId, $_SESSION['user_id']);
            echo "Success";
        }
    }
}
