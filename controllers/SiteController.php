<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;

class SiteController extends Controller
{
    public function home()
    {
        $params = [
            'name' => "User" 
        ];
        return $this->render('home', $params);
    }

    public function student()
    {
        $params = [];
        return $this->render('student', $params);
    }

    public function teacher(){
        print_r('Show the info');
    }
}
