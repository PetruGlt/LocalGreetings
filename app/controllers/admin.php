<?php

require_once __DIR__ . '/../models/EventModel.php';

class Admin extends Controller
{
    private $userModel;
    private $tagModel;

    public function __construct() {
        if(!$this->isAdmin()) {
            header("Location: /LocalGreetings/public/login/index");
            exit;
        }
        $this->userModel = $this->model('User');
        $this->tagModel = $this->model('Tag');
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

    public function unban($userId) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->userModel->unban($userId);
            header("Location: /LocalGreetings/public/admin/users");
            exit;
        }
    }

    public function tags() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $tag = !empty($_POST['tag']) ? $_POST['tag'] : null;
            $this->tagModel->create($tag);
        }
        $tagName = null;
        if($_SERVER['REQUEST_METHOD'] === 'GET') 
            $tagName = !empty($_GET['tag']) ? $_GET['tag'] : null;
        $tags = $this->tagModel->list($tagName);
        $this->view('admin/tags', [
            'tags' => $tags,
            'tagInput' => $tagName ?? ""
        ]);
    }

    public function tagDelete($tagId) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->tagModel->delete($tagId);
        }
        header("Location: /LocalGreetings/public/admin/tags");
        exit;
    }

    public function events() {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $filters = [];
            if(!empty($_GET['name']))
                $filters['name'] = $_GET['name'];
            if(!empty($_GET['event_time_start']))
                $filters['event_time_start'] = $_GET['event_time_start'];
            if(!empty($_GET['event_time_end']))
                $filters['event_time_end'] = $_GET['event_time_end'];
            if(!empty($_GET['max_participants']))
                $filters['max_participants'] = $_GET['max_participants'];
            if(!empty($_GET['tags']))
                $filters['tags'] = $_GET['tags'];

            $events = EventModel::getEvents($filters);
            
            $this->view('admin/events', [
                'events' => $events ?? [],
                'filters' => $filters
            ]);
        }
    }

    public function eventDelete($eventId) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            EventModel::deleteEvent($eventId);
        }
        header("Location: /LocalGreetings/public/admin/events");
        exit;
    }
}