<?php

class EventModel
{   

    public static function findTagByName($name)
    {
        $tagData = DatabaseService::runSelect(
            "SELECT id FROM tags WHERE name = ? LIMIT 1", $name
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
            "SELECT * FROM events WHERE id = ? LIMIT 1", $eventId
        );
        return $eventData;
    }

    public static function findEventsByFieldId($fieldId)
    {
        $eventsData = DatabaseService::runSelect(
            "SELECT * FROM events WHERE field_id = ?", $fieldId
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

    public static function deleteEvent($eventId) {
        $sql = "DELETE FROM events WHERE id = ?";
        DatabaseService::runDML($sql, "i", $eventId);
    }

    public static function getEvents($filters) {

        $queryBuilder = "SELECT e.*, GROUP_CONCAT(CONCAT('#', t.name)) AS tags, sf.lat, sf.lon FROM events AS e
            INNER JOIN sports_fields AS sf ON sf.id = e.field_id
            LEFT JOIN event_tags AS et ON et.event_id = e.id
            LEFT JOIN tags AS t ON t.id = et.tag_id";
        
        $bindParams = [];
        $conjunction = "";

        if(!!$filters) {
            if(isset($filters['name'])) {
                $conjunction .= "AND e.name LIKE ? ";
                $bindParams[] = '%' . $filters['name'] . '%';
            }
            if(isset($filters['tags']) && array_search("0", $filters['tags']) === false) {
                $conjunction .= "AND t.id IN (";
                foreach($filters['tags'] as $tag) {
                    $conjunction .= "?,";
                    $bindParams[] = $tag;
                }
                $conjunction = substr($conjunction, 0, -1) . ") ";
            }
            if(isset($filters['event_time_start'])) {
                $conjunction .= "AND e.event_time_start >= ? ";
                $bindParams[] = $filters['event_time_start']->getTimestamp();
            }
            if(isset($filters['event_time_end'])) {
                $conjunction .= "AND e.event_time_end <= ? ";
                $bindParams[] = $filters['event_time_end']->getTimestamp();
            }
            if(isset($filters['max_participants'])) {
                $conjunction .= "AND e.max_participants <= ? ";
                $bindParams[] = $filters['max_participants'];
            }
            if($conjunction !== "")
                $conjunction = " WHERE " . substr_replace($conjunction, "", 0, 3);
        }

        $queryBuilder .= $conjunction . " GROUP BY e.id";

        $eventsData = DatabaseService::runSelect($queryBuilder, ...$bindParams);
        return $eventsData;
    }

    public static function isParticipant($eventId, $userId) {
        $sql = "SELECT user_id FROM event_participants WHERE event_id = ? AND user_id = ?";
        $participant = DatabaseService::runSelect($sql, (int)$eventId, (int)$userId);
        return !!$participant;
    }

    public static function getEventsForUser($userId) {
        $sql = "SELECT e.* FROM event_participants AS ep
            INNER JOIN events AS e ON e.id = ep.event_id
            WHERE ep.user_id = ?";
        return DatabaseService::runSelect($sql, (int)$userId);
    }

    public static function getParticipants($eventId) {
        $sql = "SELECT u.id, u.username, ep.join_date FROM event_participants AS ep
            INNER JOIN users AS u ON u.id = ep.user_id
            WHERE ep.event_id = ?";
        return DatabaseService::runSelect($sql, (int)$eventId);
    }
    
    public static function participate($eventId, $userId) {
        if(!self::isParticipant($eventId, $userId)) {
            $sql = "INSERT INTO event_participants(event_id,user_id) VALUES (?,?)";
            DatabaseService::runDML(
                $sql,
                "ii",
                $eventId,
                $userId
            );
        }
    }

    public static function cancel($eventId, $userId) {
        if(self::isParticipant($eventId, $userId)) {
            $sql = "DELETE FROM event_participants WHERE event_id = ? AND user_id = ?";
            DatabaseService::runDML(
                $sql,
                "ii",
                $eventId,
                $userId
            );
        }
    }
}