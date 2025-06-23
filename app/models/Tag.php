<?php

class Tag 
{
    public function create($name) {
        DatabaseService::runDML(
            "INSERT INTO tags (name) VALUES (?)",
            "s",
            $name
        );
    }

    public function list($name = null) {
        $sql = "SELECT id, name FROM tags";
        $tags = null;

        if($name != null) {
            $sql .= " WHERE name LIKE ?";
            $name = '%' . $name . '%';
            $tags = DatabaseService::runSelect(
                $sql,
                $name
            );
        } else {
            $tags = DatabaseService::runSelect(
                $sql
            );
        }
        return $tags ?? [];
    } 

    public function delete($tagId) {
        DatabaseService::runDML("
            DELETE FROM event_tags WHERE tag_id = ?
        ", "i", (int) $tagId);
        DatabaseService::runDML("
            DELETE FROM tags WHERE id = ?
        ", "i", (int) $tagId);
    }

    public function getTagsForField($fieldId) {
        return DatabaseService::runSelect(
            "SELECT et.event_id, t.name 
             FROM event_tags et
             JOIN tags t ON et.tag_id = t.id
             WHERE et.event_id IN (SELECT id FROM events WHERE field_id = ?)", 
            (int)$fieldId
        );
    }

    public function getTagsByEvent($eventId) {
        return DatabaseService::runSelect(
            "SELECT t.name 
             FROM event_tags et
             JOIN tags t ON et.tag_id = t.id
             WHERE et.event_id = ?", (int)$eventId
            );
    }

    public function checkEventTag($eventId, $tagId) {
        $tags = DatabaseService::runSelect("SELECT * FROM event_tags WHERE event_id = ? AND tag_id = ?", $eventId, $tagId);
        return empty($tags);
    }
}