<?php

namespace app\controllers;

use app\core\Controller;

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
        $params = [];
        return $this->render('teacher', $params);
    }
}
