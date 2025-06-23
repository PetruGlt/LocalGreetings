<?php

require_once __DIR__ . '/../models/EventModel.php';

class Home extends Controller
{
    private $userModel;
    public function __construct() {
        if(!$this->isAuthenticated()) {
            header("Location: /LocalGreetings/public/login/index");
            exit;
        }
        $this->userModel = $this->model('User');
    }

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

        $sursa1 = $newsModel->fetchNews('https://www.digi24.ro/rss/stiri/sport');
        $sursa2 = $newsModel->fetchNews('https://rss.stirileprotv.ro/stiri/sport');
        $sursa3 = $newsModel->fetchNews('https://observatornews.ro/rss/sport/');
    
        $this->view('home/news', [
            'Digi24'=>$sursa1,
            'ProTV'=>$sursa2, 
            'Observator'=>$sursa3
        ]);
    
    }

    public function viewProfile($id = null) {
        $userData = $this->userModel->findById($id);

        $events = EventModel::getEventsForUser($id);

        $createdEvents = EventModel::findByCreator($id);

        $friends = $this->userModel->getFriends($id);
            
        // echo $userData[0]['username'];
        $this->view('home/profilePage', [
            'user' => $userData,
            'events' => $events,
            'createdEvents' => $createdEvents,
            'friends' => $friends
        ]);
    }

    public function viewDocEn(){
        $this->view('docs/descriptionEn');
    }

    public function viewDocRo(){
        $this->view('docs/descriptionRo');
    }
}
