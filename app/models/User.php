<?php
// MODEL: Handles data access
class User
{
    protected $conn;

    public function __construct()
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "sportis";
        $this->conn = new mysqli($servername, $username, $password, $dbname);
        if($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
        // echo "Connected successfully";
    }

    
    public function findByEmail($email)
    {
       $sql = "SELECT * FROM users WHERE email = '" . $email . "' LIMIT 1";
       $result = $this->conn->query($sql);
    //    echo "Finding user by email: " . $email . "\n";
         if ($result->num_rows > 0) 
            // echo "User found: " . "\n";
        return $result->fetch_assoc();
    }

    public function findByUsername($username)
    {
        $sql = "SELECT * FROM users WHERE username = '" . $username . "' LIMIT 1";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) 
            return $result->fetch_assoc();
        return null;
    }

    public function registerUser($username, $email, $password)
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $hashedPassword);
        
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    
}