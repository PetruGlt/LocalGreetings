<?php

class EventModel
{   

    public static function findTagByName($name)
    {
        $tagData = DatabaseService::runSelect(
            "SELECT id FROM tags WHERE name = '" . $name . "' LIMIT 1"
        );
        return $tagData;
    }

    public static function registerEvent($name, $userId, $fieldId, $maxParticipants, $eventTimeStart, $eventTimeEnd, $description)
    {
        $sql = "INSERT INTO events (name, creator_id, field_id, max_participants, event_time_start, event_time_end, description)
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $success = DatabaseService::runDML($sql, "siiisss", $name, $userId, $fieldId, $maxParticipants, $eventTimeStart, $eventTimeEnd, $description);
        return $success;
    }
    
    public static function findEventById($eventId)
    {
        $eventData = DatabaseService::runSelect(
            "SELECT * FROM events WHERE id = " . $eventId . " LIMIT 1"
        );
        return $eventData;
    }

    public static function findEventsByFieldId($fieldId)
    {
        $eventsData = DatabaseService::runSelect(
            "SELECT * FROM events WHERE field_id = " . $fieldId
        );
        return $eventsData;
    }

    public static function insertTagInTags($tagName){
        DatabaseService::runDML(
            "INSERT INTO tags (name) VALUES (?)",
            "s",
            $tagName
        );
    }

    public static function insertEventTag($eventID, $tagID){
        DatabaseService::runDML(
            "INSERT INTO event_tags (event_id, tag_id) VALUES (?, ?)",
            "ii",
            $eventID,
            $tagID
        );
    }

    public static function getEvents($filters) {
        $eventsData = DatabaseService::runSelect(
            "SELECT * FROM events"
        );
        return $eventsData;
    }
    
}