<?php
class social extends Controller {

    public function index() {
        $userId = $_SESSION['user_id'];
        $friends = DatabaseService::runSelect("
            SELECT u.id, u.username
            FROM users u
            JOIN friendships f ON 
                (f.friend_id = u.id AND f.user_id = $userId OR f.user_id = u.id AND f.friend_id = $userId)
                AND f.status = 'accepted'
            WHERE u.id != $userId
        ");
        $this->view('social/index', ['friends' => $friends]);
    }

    public function sendRequest($friendId) {
        $userId = $_SESSION['user_id'];
        DatabaseService::runDML("
            INSERT INTO friendships (user_id, friend_id) VALUES (? , ?)", "ii", $userId, $friendId  
        );
        header("Location: /LocalGreetings/public/social/index");
    }

    public function acceptRequest($requestId) {
        DatabaseService::runDML("
            UPDATE friendships SET status = 'accepted' WHERE id = ?", "i", $requestId);
        header("Location: /LocalGreetings/public/social/index");
    }

    public function pendingRequests() {
        $userId = $_SESSION['user_id'];
        $requests = DatabaseService::runSelect("
            SELECT f.id, u.username FROM friendships f
            JOIN users u ON f.user_id = u.id
            WHERE f.friend_id = $userId AND f.status = 'pending'
        ");
        $this->view('social/requests', ['requests' => $requests]);
    }
}
