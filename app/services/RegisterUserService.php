<?php

class RegisterUserService {
    protected $user;

    public function __construct() {
        require_once __DIR__ . '/../models/User.php';
        $this->user = new User();
    }

    public function register($username, $email, $password) {
        if (empty($username) || empty($email) || empty($password)) {
            return false; // Return false if any field is empty
        }

        // Check if the email already exists
        $existingUser = $this->user->findByEmail($email);
        if ($existingUser) {
            return false; // Email already registered
        }

        $existingUserByUsername = $this->user->findByUsername($username);
        if ($existingUserByUsername) {
            return false; // Username already taken
        }

        // Register the new user
        $registrationSuccess = $this->user->registerUser($username, $email, $password);
        return $registrationSuccess; // Return true if registration was successful, false otherwise
    }
}