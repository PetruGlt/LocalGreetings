<?php
class social extends Controller {

    public function index() {
        
        if (!isset($_SESSION['user_id'])) {
            header("Location: /LocalGreetings/public/login");
            exit;
        }

        $userId = $_SESSION['user_id'];

        // prietenii utilizatorului curent
        $friends = DatabaseService::runSelect("
            SELECT u.id, u.username
            FROM users u
            JOIN friendships f ON (
                (f.friend_id = u.id AND f.user_id = ?) OR
                (f.user_id = u.id AND f.friend_id = ?)
            )
            WHERE f.status = 'accepted' AND u.id != ?
        ", $userId, $userId, $userId);

        // 5 useri random care nu s prieteni si nu sunt utilizatorul curent
        $randomUsers = DatabaseService::runSelect("
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

        //toti utilizatorii (fara userul curent si prietenii deja existenti)
        $allUsers = DatabaseService::runSelect("
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

        $this->view('social/index', [
            'friends' => $friends,
            'randomUsers' => $randomUsers,
            'allUsers' => $allUsers
        ]);
    }

    public function sendRequest($friendId) {
        $userId = $_SESSION['user_id'];
        DatabaseService::runDML("
            INSERT INTO friendships (user_id, friend_id) VALUES (? , ?)", "ii", $userId, $friendId  
        );
        header("Location: ../social/index");
    }

    public function acceptRequest($requestId) {
        DatabaseService::runDML("
            UPDATE friendships SET status = 'accepted' WHERE id = ?", "i", $requestId);
        header("Location: ../social/index");
    }

    public function pendingRequests() {
        $userId = $_SESSION['user_id'];
        $requests = DatabaseService::runSelect("
            SELECT f.id, u.username FROM friendships f
            JOIN users u ON f.user_id = u.id
            WHERE f.friend_id = ? AND f.status = 'pending'
        ", $userId);
        $this->view('social/requests', ['requests' => $requests]);
    }

    public function deleteFriend($friendId) {
        $userId = $_SESSION['user_id'];
        DatabaseService::runDML("
            DELETE FROM friendships 
            WHERE (user_id = ? AND friend_id = ?) OR (user_id = ? AND friend_id = ?)", 
            "iiii", $userId, $friendId, $friendId, $userId
        );
        header("Location: ../social/index");
    }
}
