<?php

class Event {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function createEvent($data) {
        $stmt = $this->db->prepare("INSERT INTO events (name, user_id, field_id, max_participant, datetime, description) VALUES (?, ?, ?, ?, ?, ?)");
        return $stmt->execute([
            $data['name'],
            $data['user_id'],
            $data['field_id'],
            $data['max_participants']
            $data['datetime']
            $data['description']
        ]);
    }
}
