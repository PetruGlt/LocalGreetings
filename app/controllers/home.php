<?php

class Home extends Controller
{
    public function hello($name = ' '){
        $user = $this->model('User');
        $user->name = $name;
        
        $this->view('home/hello', ['name'=> $user->name]);
    }
    
    public function index(){
        if($this->isAuthenticated())
            $this->view('home/mainPage');
        else {
            header('Location: ../login/loginPage');
            exit;
        }
    }
    
    public function bla(){
        echo 'alaal';
    }
}
