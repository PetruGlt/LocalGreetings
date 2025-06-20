<?php
// MODEL: Handles data access
class User
{   
    public function findByEmail($email)
    {
        $user = DatabaseService::runSelect(
            "SELECT * FROM users WHERE email = ? LIMIT 1", $email
        );
        return $user != null ? $user[0] : null;
    }

    public function findByUsername($username)
    {
        $users = DatabaseService::runSelect(
            "SELECT * FROM users WHERE username = ? LIMIT 1", $username
        );
        return $users != null ? $users[0] : null;
    }

    public function registerUser($username, $email, $password)
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $now = date('Y-m-d H:i:s');
        $success = DatabaseService::runDML(
            "INSERT INTO users (username, email, password, registration_date) VALUES (?, ?, ?, ?)",
            "ssss",
            $username,
            $email,
            $hashedPassword,
            $now
        );
        return $success;
    }
    
}