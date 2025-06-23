<?php

class Controller
{
    public function model($model)
    {
        require_once __DIR__ . '/../models/' . $model . '.php';
        return new $model();
    }

    public function view($view, $data = []){

        extract($data); // Extracts the array keys as variables
        require_once __DIR__ . '/../views/' . $view . '.php';
        
    }

    protected function isAuthenticated() {
        return isset($_SESSION['user_id']);
    }

    protected function isAdmin() {
        return isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1;
    }
}