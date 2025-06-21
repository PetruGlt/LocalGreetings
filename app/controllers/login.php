<?php

class Login extends Controller
{
    public function index()
    {
        $this->view('login/loginPage');
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
                
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['email'] = $user['email'];
                
                // $this->view('home/mainPage');
                header('Location: ../home/mainPage');
                exit;
            } else {
                $errorMessage = "Date de autentificare incorecte. Vă rugăm să încercați din nou.";
                $this->view('login/loginPage', ['errorMessage' => $errorMessage]);
            }
        } else {
            // If not a POST request, redirect to login page
            $this->view('login/loginPage');
        }
    }

    public function createAccount(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $confirmPassword = $_POST['confirm_password'] ?? '';

            if($password !== $confirmPassword) {
                $errorMessage = "Parolele nu se potrivesc. Vă rugăm să încercați din nou.";
                $this->view('login/registerPage', ['errorMessage' => $errorMessage]);
                return;
            }

            require_once __DIR__ . '/../services/RegisterUserService.php';
            $registerService = new RegisterUserService();
            $user = $registerService->register($username,$email,$password);
            

            if ($user) {
                
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['email'] = $user['email'];
                
                // $this->view('home/mainPage');
                header('Location: ../login/loginPage');
                exit;
            } else {
                $errorMessage = "Username sau email deja inregistrat. Va rugam sa incercati din nou.";
                $this->view('login/registerPage', ['errorMessage' => $errorMessage]);
            }
        } else {
            $this->view('login/loginPage');
        }
    }

    public function register()
    {
        // Redirect to the registration page
        $this->view('login/registerPage');
    }   

    
}