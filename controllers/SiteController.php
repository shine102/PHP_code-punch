<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\models\ChangeModel;
use app\models\RegisterModel;
use app\models\ChatModel;
use app\models\Login;
use app\core\middlewares\AuthMiddleware;

class SiteController extends Controller
{
    public function __construct()
    {
        $this->registerMiddleware(new AuthMiddleware(['userList','teacher','gameplay','homeworkgive','changeInfo','register']));
    }

    public function login(Request $request){
        $loginForm = new Login();
        if ($request->isPost()){
            $loginForm->loadData($request->getBody());
            if ($loginForm->validate() && $loginForm->login()){
                Application::$app->response->redirect('/');
                return;
            }

        }
        $this->setLayout('auth');
        return $this->render('login', [
            'model' => $loginForm
        ]);
    }

    public function register(Request $request)
    {
        $student = new RegisterModel();
        if ($request->isPost())
        {   
            $student->LoadData($request->getBody());

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

    public function logout()    
    {
        Application::$app->logout();
        Application::$app->response->redirect('/');
    }

    public function userList()
    {
        return $this->render('userList');
    }

    public function about()
    {
        return $this->render('about');
    }

    public function home()
    {
        return $this->render('home');
    }

    public function homeworkgive(){
        return $this->render('homeworkgive');
    }

    public function profile(Request $request)
    {   
        $profile = new ChatModel();
        if ($request->isPost()){
            // $profile -> LoadData($request->getBody());

            if ($profile->validate() && $profile->save())
            {
                Application::$app->session->setFlash('sended', 'Send message successfully!');
                Application::$app->response->redirect('/profile');
                exit;
            }
        }
        return $this->render('profile');
    }

    public function gameplay()
    {
        return $this->render('gameplay');
    }

    public function changeInfo(Request $request){
        $student = new ChangeModel();
        if ($request->isPost())
        {   
            $student->LoadData($request->getBody());

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