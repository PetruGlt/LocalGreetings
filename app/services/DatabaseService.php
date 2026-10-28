<?php

class DatabaseService {

    private static $conn;
    private static $loaded = false;

    public static function load()
    {
        if (self::$loaded) {
            return;
        }
        $servername = Config::get('MYSQL_SERVER', '127.0.0.1');
        $username = Config::get('MYSQL_USER', 'root');
        $password = Config::get('MYSQL_PASSWORD', '');
        $dbname = Config::get('MYSQL_DB', 'sportis');
        $port = (int) Config::get('MYSQL_PORT', 3306);
        $useSsl = Config::get('MYSQL_SSL', false) || $port === 4000;

        if ($useSsl) {
            self::$conn = mysqli_init();
            self::$conn->ssl_set(null, null, null, null, null);
            if (!@self::$conn->real_connect($servername, $username, $password, $dbname, $port, null, MYSQLI_CLIENT_SSL)) {
                die("Database connection failed: " . self::$conn->connect_error);
            }
        } else {
            self::$conn = new mysqli($servername, $username, $password, $dbname, $port);
            if(self::$conn->connect_error) {
                die("Database connection failed: " . self::$conn->connect_error);
            }
        }
        self::$conn->set_charset("utf8mb4");
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