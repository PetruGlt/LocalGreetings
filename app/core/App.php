<?php

class App{

    protected $controller = 'home';

    protected $method = 'hello';

    protected $params = [];

    public function __construct(){
        //   print_r($this->parseUrl());

        $url = $this->parseUrl();

        if(isset($url[0]))
        if(file_exists(__DIR__ . '/../controllers/'. $url[0] . '.php' )){
            $this->controller = $url[0];
            unset($url[0]);
        }

        require_once __DIR__ . '/../controllers/' . $this->controller . '.php';

        // echo $this->controller;

        $this->controller = new $this->controller;

        // var_dump($this->controller);

        if(isset($url[1]))
        {
            if(method_exists($this->controller, $url[1]))
            {
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        $this->params = $url ? array_values($url) : [];

        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function parseUrl(){
        if(isset($_GET['url'])){
            // echo $_GET['url'];
            return $url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
    }
}