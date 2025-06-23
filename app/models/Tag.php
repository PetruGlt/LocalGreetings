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
}