<?php

class Login extends Controller
{
    public function index()
    {
        $this->view('loginPage');
    }

    public function authenticate()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            require_once __DIR__ . '/../services/LoginService.php';
            $loginService = new LoginService();
            $user = $loginService->auth($email,$password);

            if ($user) {
                
                $_SESSION['user_id'] = $user['ID'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['email'] = $user['email'];
                
                // $this->view('home/mainPage');
                header('Location: ../home/mainPage');
                exit;
            } else {
                $errorMessage = "Date de autentificare incorecte. Vă rugăm să încercați din nou.";
                $this->view('loginPage', ['errorMessage' => $errorMessage]);
            }
        } else {
            // If not a POST request, redirect to login page
            $this->view('loginPage');
        }
    }
    
}