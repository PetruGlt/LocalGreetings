<?php
class rss extends Controller {

    public function feed($fieldId = null, $tagName = null) {
        
        require_once __DIR__ . '/../services/DatabaseService.php';
        
        header("Content-Type: application/rss+xml; charset=UTF-8");
        
        $sql = "SELECT e.id, e.name, e.field_id, e.event_time_start, e.event_time_end, e.description FROM events e";
        
        $conditions = [];
        
        if (isset($_POST['fieldId'])) $fieldId = $_POST['fieldId'];
        if (isset($_POST['tagName'])) $tagName = $_POST['tagName'];
        
        if ($tagName != null) {
            $sql .= "
                JOIN event_tags et ON e.id = et.event_id
                JOIN tags t ON et.tag_id = t.id
            ";
            $conditions[] = "t.name = '$tagName'";
        }

        if ($fieldId !== null && is_numeric($fieldId)) {
            $fieldId = intval($fieldId);
            $conditions[] = "e.field_id = $fieldId";
        }

        if(!empty($conditions)){
            $sql .= " WHERE " . implode(" AND ", $conditions);      
        }
        // var_dump($sql);

        $events = DatabaseService::runSelect($sql);
       
        echo "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>\n";
        echo "<rss version=\"2.0\" xmlns:atom=\"http://www.w3.org/2005/Atom\">\n";
        echo "<channel>\n";
        echo "<title>Evenimente Sportive Locale</title>\n";
        echo "<link>http://localhost/LocalGreetings/</link>\n";
        echo "<description>Flux RSS cu evenimentele urmatoare</description>\n";
        echo "<language>ro-ro</language>\n";

        if ($events && is_array($events)) 
        {
            foreach ($events as $event) {
            echo "<item>\n";
            echo "<title>" . htmlspecialchars($event['name']) . "</title>\n";
            echo "<link>http://localhost/LocalGreetings/public/event/viewField/" . $event['field_id'] . "</link>\n";
            echo "<description>" . $event['description'] . "</description>\n";
            echo "<pubDate>" . date(DATE_RSS, strtotime($event['event_time_start'])) . "</pubDate>\n";
            echo "<guid>http://localhost/LocalGreetings/public/event/viewEvent/" . $event['id'] . "</guid>\n";
            echo "</item>\n";
            }
        }
        else echo "NO EVENTS FOUND\n";

        echo "</channel>\n";
        echo "</rss>\n";
    }

     public function send() {
        if (!isset($_SESSION['email'])) {
            header("Location: /LocalGreetings/public/login");
            exit;
        }

        require_once '../app/models/RSSMailer.php';
        RSSMailer::send( $_SESSION['email'], "http://localhost/LocalGreetings/public/rss/feed");
    }

    public function sendFiltered() {
        if (!isset($_SESSION['email'])) {
            header("Location: /LocalGreetings/public/login");
            exit;
        }

        $fieldId = $_POST['fieldId'] ?? null;
        $tagName = $_POST['tagName'] ?? null;
        
        $rssUrl = "http://localhost/LocalGreetings/public/rss/feed/";
        
        if($fieldId != null){
            $rssUrl = $rssUrl . $fieldId;
            if($tagName != null) $rssUrl = $rssUrl . "/" . $tagName;
        }
        else if($tagName != null){
            $rssUrl = $rssUrl . "null/". $tagName;
        }

        require_once '../app/models/RSSMailer.php';

        try{ 
            RSSMailer::send($_SESSION['email'], $rssUrl);
            $_SESSION['errorMessage'] = "Email trimis cu succes la ". $_SESSION['email'];
        } catch (Exception $e){
            echo "Eroare la trimitere mail: ";
        }
        header('Location: /LocalGreetings/public/home/mainPage');
        exit;
    }
}