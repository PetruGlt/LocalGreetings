<?php

class DatabaseService {

    private static $conn;
    private static $loaded = false;

    public static function load()
    {
        if (self::$loaded) {
            return;
        }
        $servername = Config::get('MYSQL_SERVER');
        $username = Config::get('MYSQL_USER');
        $password = Config::get('MYSQL_PASSWORD');
        $dbname = Config::get('MYSQL_DB');
        self::$conn = new mysqli($servername, $username, $password, $dbname);
        if(self::$conn->connect_error) {
            die("Connection failed: " . self::$conn->connect_error);
        }
        self::$loaded = true;
    }

    public static function runSelect($sql, ...$vars) {
        $rows = null;
        $result = self::$conn->execute_query($sql, $vars);
        if ($result->num_rows > 0) {
            $rows = $result->fetch_all(MYSQLI_ASSOC);
            $result->free_result();
        }
        return $rows;
    }

    public static function runDML($stmt, $types, ...$vars) {
        $stmt = self::$conn->prepare($stmt);
        $stmt->bind_param($types, ...$vars);
        
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public static function getLastInsertId() {
        return self::$conn->insert_id;
    }

}