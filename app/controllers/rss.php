<?php
class rss extends Controller {

    public static function reader($url){
        $rss = simplexml_load_file($url);
       
        if (!$rss) {
            die("Error: Could not load RSS feed.");
        }

        echo "<h2>" . $rss->channel->title . "</h2>";
        echo "<p>" . $rss->channel->description . "</p>";
        echo "<ul>";

        foreach ($rss->channel->item as $item) {
            echo "<li>";
            echo "<a href='" . $item->link . "'>" . $item->title . "</a><br>";
            echo "<small>" . $item->pubDate . "</small><br>";
            echo "<p>" . $item->description . "</p>";
            echo "</li>";
        }

        echo "</ul>";
    }

    public function feed() {
        
        require_once __DIR__ . '/../services/DatabaseService.php';
        
        header("Content-Type: application/rss+xml; charset=UTF-8");
        
        $sql = "SELECT id, name, field_id, event_time_start, event_time_end, description FROM events";
        $events = DatabaseService::runSelect($sql);

       
        echo "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>\n";
        echo "<rss version=\"2.0\" xmlns:atom=\"http://www.w3.org/2005/Atom\">\n";
        echo "<channel>\n";
        echo "<title>Evenimente Sportive Locale</title>\n";
        echo "<link>http://localhost/LocalGreetings/</link>\n";
        echo "<description>Flux RSS cu evenimentele urmatoare</description>\n";
        echo "<language>ro-ro</language>\n";

        foreach ($events as $event) {
            echo "<item>\n";
            echo "<title>" . htmlspecialchars($event['name']) . "</title>\n";
            echo "<link>http://localhost/LocalGreetings/event/view/" . $event['field_id'] . "</link>\n"; // TODO
            echo "<description>" . $event['description'] . "</description>\n";
            echo "<pubDate>" . date(DATE_RSS, strtotime($event['event_time_start'])) . "</pubDate>\n";
             echo "<guid>http://localhost/LocalGreetings/event/view/" . $event['id'] . "</guid>\n";// TODO
            echo "</item>\n";
        }

        echo "</channel>\n";
        echo "</rss>\n";
    }
}