<?php

namespace app\controllers;

use app\core\Application;

class SiteController
{
    public function home()
    {
        $params = [
            'name' => "User" 
        ];
        $app = new Application(dirname(__DIR__));
        return $app->router->renderView('home', $params);
    }

    public function student()
    {
        $params = [];
        $app = new Application(dirname(__DIR__));
        return $app->router->renderView('student', $params);
    }

    public function login()
    {
        return Application::$app->router->renderView('login');
    }

    public function Teacher(){
        print_r('Show the info');
    }

    public function handleStudent(){
        print_r('Handling submitted data');
    }

    public function handleLogin(){
        return Application::$app->router->renderView('login');
    }
}
