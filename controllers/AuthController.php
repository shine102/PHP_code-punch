<?php

namespace app\controllers;

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
        $registerModel = new RegisterModel();
        if ($request->isPost()){
            
            $registerModel -> LoadData($request->getBody());

            if ($registerModel->validate() && $registerModel->register())
            {
                print_r('Success');
            }
            else{
                return $this->render('register', ['model' => $registerModel]);    
            }
        }
        else {   
        $this->setLayout('auth');
        return $this->render('register',  ['model' => $registerModel]);
        }
    }
}