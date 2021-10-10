<?php

use app\core\Application;

class SiteController
{
    public function home()
    {
        $params = [
            'name' => "User" 
        ];
        return Application::$app->router->renderView('home', $params);
    }

    public function Teacher(){
        print_r('Show the info');
    }

    public function handleStudent(){
        print_r('Handling submitted data');
    }
}
