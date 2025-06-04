<?php

class Home extends Controller
{
    public function hello($name = ' '){
        $user = $this->model('User');
        $user->name = $name;
        
        $this->view('home/hello', ['name'=> $user->name]);
    }
    
    public function loginPage(){
        $this->view('home/loginPage');
    }
    
    public function bla(){
        echo 'alaal';
    }
}
