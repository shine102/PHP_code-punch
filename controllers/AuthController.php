<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\models\RegisterModel;

class AuthController extends Controller
{
    public function login(){
        $this->setLayout('auth');
        return $this->render('login');
    }

    public function register(Request $request)
    {
        $student = new RegisterModel();
        if ($request->isPost())
        {   
            $student -> LoadData($request->getBody());

            if ($student->validate() && $student->save())
            {
                Application::$app->session->setFlash('success', 'Create a student successfully!');
                Application::$app->response->redirect('/');
                exit;
            }
            $this->setLayout('auth');
            return $this->render('register', ['model' => $student]);      
        }
        $this->setLayout('auth');
        return $this->render('register',  ['model' => $student]);
    }
}