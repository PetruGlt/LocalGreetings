<?php

class Admin extends Controller
{
    private $userModel;

    public function __construct() {
        $this->userModel = $this->model('User');
    }

    public function users() {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $username = !empty($_GET['username']) ? $_GET['username'] : null;
            $allUsers = $this->userModel->adminUserList($username);
            $this->view('admin/users', [
                'allUsers' => $allUsers,
                'username' => $username ?? ""
            ]);
        }
    }

    public function ban($userId) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->userModel->ban($userId);
            header("Location: /LocalGreetings/public/admin/users");
            exit;
        }
    }

    public function tags() {
        $this->view('admin/tags');
    }
}