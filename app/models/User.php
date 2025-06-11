<?php
// MODEL: Handles data access
class User
{   
    public function findByEmail($email)
    {
        return DatabaseService::runSelect(
            "SELECT * FROM users WHERE email = '" . $email . "' LIMIT 1"
        );
    }

    public function findByUsername($username)
    {
        $users = DatabaseService::runSelect(
            "SELECT * FROM users WHERE username = '" . $username . "' LIMIT 1"
        );
        return count($users) != 0 ? $users : null;
    }

    public function registerUser($username, $email, $password)
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        DatabaseService::runDML(
            "INSERT INTO users (username, email, password) VALUES (?, ?, ?)",
            "sss",
            $username,
            $email,
            $hashedPassword
        );
    }
    
}