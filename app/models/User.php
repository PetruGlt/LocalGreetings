<?php
// MODEL: Handles data access
class User
{   
    public function findById($userId)
    {
        $user = DatabaseService::runSelect(
            "SELECT * FROM users WHERE id = ? LIMIT 1", $userId
        );
        return $user != null ? $user[0] : null;
    }

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
        $sql = "SELECT id, username, is_banned FROM users WHERE is_admin = 0";
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

    public function unban($userId) {
        DatabaseService::runDML("
            UPDATE users SET is_banned = 0 WHERE id = ?
        ", "i", (int) $userId);
    }

    public function getFriends($userId){
        return DatabaseService::runSelect("
            SELECT u.id, u.username, f.created_at
            FROM users u
            JOIN friendships f ON (
                (f.friend_id = u.id AND f.user_id = ?) OR
                (f.user_id = u.id AND f.friend_id = ?)
            )
            WHERE f.status = 'accepted' AND u.id != ?
        ", $userId, $userId, $userId);
    }

    public function getRandomUsers($userId){
        return DatabaseService::runSelect("
            SELECT u.id, u.username
            FROM users u
            WHERE u.id != ? AND u.id NOT IN (
                SELECT CASE 
                    WHEN f.user_id = ? THEN f.friend_id
                    ELSE f.user_id
                END
                FROM friendships f
                WHERE (f.user_id = ? OR f.friend_id = ?) AND f.status = 'accepted'
            )
            ORDER BY RAND() LIMIT 5
        ",  $userId, $userId, $userId, $userId);
    }

    public function listUsers($userId, $username = null) {
        if(!empty($username))
            return DatabaseService::runSelect("
                SELECT u.id, u.username
                FROM users u
                WHERE u.id != ? AND u.id NOT IN (
                    SELECT CASE 
                        WHEN f.user_id = ? THEN f.friend_id
                        ELSE f.user_id
                    END
                    FROM friendships f
                    WHERE (f.user_id = ? OR f.friend_id = ?) AND f.status = 'accepted'
                ) AND u.username LIKE ?
            ",  $userId, $userId, $userId, $userId, '%' . $username . '%');
        else
            return DatabaseService::runSelect("
                SELECT u.id, u.username
                FROM users u
                WHERE u.id != ? AND u.id NOT IN (
                    SELECT CASE 
                        WHEN f.user_id = ? THEN f.friend_id
                        ELSE f.user_id
                    END
                    FROM friendships f
                    WHERE (f.user_id = ? OR f.friend_id = ?) AND f.status = 'accepted'
                )
            ",  $userId, $userId, $userId, $userId);
    }

    public function sendRequest($userId, $friendId){        
        $existing = DatabaseService::runSelect("
        SELECT id FROM friendships
        WHERE (user_id = ? AND friend_id = ?) 
        OR (user_id = ? AND friend_id = ?)"
        , $userId, $friendId, $friendId, $userId);

        if (!empty($existing)) {
            return false; 
        }

        return DatabaseService::runDML("
            INSERT INTO friendships (user_id, friend_id) VALUES (? , ?)", "ii", $userId, $friendId  
        );
    }

    public function acceptRequest($requestId){
         return DatabaseService::runDML("
            UPDATE friendships SET status = 'accepted' WHERE id = ?", "i", $requestId);
    }

    public function listPendingRequests($userId){
        return DatabaseService::runSelect("
            SELECT f.id, u.username FROM friendships f
            JOIN users u ON f.user_id = u.id
            WHERE f.friend_id = ? AND f.status = 'pending'
        ", $userId);
    }

    public function deleteFriend($userId, $friendId){
        return DatabaseService::runDML("
            DELETE FROM friendships 
            WHERE (user_id = ? AND friend_id = ?) OR (user_id = ? AND friend_id = ?)", 
            "iiii", $userId, $friendId, $friendId, $userId
        );
    }
}