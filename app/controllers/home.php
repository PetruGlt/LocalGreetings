<?php

class Home extends Controller
{
    public function hello($name = ' '){
        $user = $this->model('User');
        $user->name = $name;
        
        $this->view('home/hello', ['name'=> $user->name]);
    }
    
    public function index(){
        $this->view('home/mainPage');
    }
    
    public function bla(){
        echo 'alaal';
    }
}
