<?php
class social extends Controller {

    private $userModel;

    public function __construct() {
        if(!$this->isAuthenticated()) {
            header("Location: /LocalGreetings/public/login/index");
            exit;
        }
        $this->userModel = $this->model('User');
    }

    public function index() {

        $userId = $_SESSION['user_id'];

        // prietenii utilizatorului curent
        $friends = $this->userModel->getFriends($userId);

        // 5 useri random care nu s prieteni si nu sunt utilizatorul curent
        $randomUsers = $this->userModel->getRandomUsers($userId);

        $username = !empty($_GET['username']) ? $_GET['username'] : null;

        $allUsers = $this->userModel->listUsers($userId, $username);

        $this->view('social/index', [
            'friends' => $friends ?? [],
            'randomUsers' => $randomUsers ?? [],
            'allUsers' => $allUsers ?? [],
            'username' => $username
        ]);
    }

    public function sendRequest($friendId) {
        $userId = $_SESSION['user_id'];
        $this->userModel->sendRequest($userId, $friendId);
        header("Location: ../../social/index");
    }

    public function acceptRequest($requestId) {
        $this->userModel->acceptRequest($requestId);
        header("Location: ../../social/index");
    }

    public function pendingRequests() {
        $userId = $_SESSION['user_id'];
        $requests = $this->userModel->listPendingRequests($userId);
        $this->view('social/requests', ['requests' => $requests]);
    }

    public function deleteFriend($friendId) {
        $userId = $_SESSION['user_id'];
        $this->userModel->deleteFriend($userId, $friendId);
        header("Location: ../../social/index");
    }
}
