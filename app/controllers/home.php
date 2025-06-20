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
    
    public function logout(){
        session_unset();
        session_destroy();
        header('Location: ../login/loginPage');
        exit;
    }

    public function news(){
        
        $newsModel = $this->model('News');

        $sursa1 = $newsModel->fetchNews('https://www.digi24.ro/rss');
        $sursa2 = $newsModel->fetchNews('https://rss.app/feeds/XUK3Z066WY4rYJ8k.xml');
        $sursa3 = $newsModel->fetchNews('https://observatornews.ro/rss');
    
        $this->view('home/news', [
            'Digi24'=>$sursa1,
            'ProTV'=>$sursa2, 
            'Observator'=>$sursa3
        ]);
    
    }

    public function viewProfile($id = null) {
        $userData = DatabaseService::runSelect(
            "SELECT * FROM users WHERE id = " . $id . " LIMIT 1"
        );
        // echo $userData[0]['username'];
        $this->view('home/profilePage', ['user' => $userData[0]]);

    }

}
