<?php

class App{

    protected $controller = 'home';

    protected $method = 'index';

    protected $params = [];

    public function __construct()
    {
        $url = $this->parseUrl();

        if (file_exists('../app/controllers/' . $url[2] . 'php')){
            $this->controller = $url[1];
            unset($url[1]);
        }

        require_once '../app/controllers/' . $this->controller . '.php';

        $this->controller = new $this->controller;
        if(isset($url[2])){
            if(method_exists($this->controller, $url[2])){
                $this->method = $url[2];
                unset($url[2]);
            }
        }

        $this->params = $url ? array_values($url) : [];
        // call_user_func_array([$this->controller, $this->method], $this->params);
        call_user_func([$this->controller, $this->method], end($this->params));
    }

    public function parseUrl(){
            return $url = explode("/", filter_var(trim($_SERVER["REQUEST_URI"], "/"), FILTER_SANITIZE_URL));
    }
}