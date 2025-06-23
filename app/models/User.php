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
    
    public function adminUserList($username = null) {
        $sql = "SELECT id, username FROM users WHERE is_admin = 0";
        $users = null;
        
        if($username != null) {
            $sql .= " AND username LIKE ?";
            $username = '%' . $username . '%';
            $users = DatabaseService::runSelect(
                $sql,
                $username
            );
        } else {
            $users = DatabaseService::runSelect(
                $sql
            );
        }
        return $users ?? [];
    }

    public function ban($userId) {
        DatabaseService::runDML("
            UPDATE users SET is_banned = 1 WHERE id = ?
        ", "i", (int) $userId);
    }
}