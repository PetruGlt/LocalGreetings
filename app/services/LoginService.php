<?php

class LoginService {
    protected $user;

    public function __construct() {
        require_once __DIR__ . '/../models/User.php';
        $this->user = new User();
    }

    public function auth($email, $password) {

        if (empty($email) || empty($password)) {
            return false; 
        }

        $user = $this->user->findByEmail($email);
        // echo $user ? "User found: " . $user['username'] . $user['email'] . "Pass:" . $user['password'] . "\n" : "No user found with that email.\n";

        if ($user && $password == $user['password']) {
            // echo "User authenticated successfully.\n";
            return $user;
            
        }

        return false;
    }
}