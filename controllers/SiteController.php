<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\models\ChangeModel;
use app\models\RegisterModel;
use app\core\exception\UnauthorityException;
use app\models\Login;
use app\core\middlewares\AuthMiddleware;

class SiteController extends Controller
{
    public function __construct()
    {
        $this->registerMiddleware(new AuthMiddleware(['userList','gameplay','homeworkgive','changeInfo', 'profile']));
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
                Application::$app->response->redirect('/');
                exit;
            }
            $this->setLayout('main');
            return $this->render('register', ['model' => $student]);      
        }
        $this->setLayout('main');
        return $this->render('register',  ['model' => $student]);
    }

    public function changeInfo(Request $request){
        $student = new ChangeModel();
        if ($request->isPost())
        {   
            $student->LoadData($request->getBody());
            if ($student->validate() && $student->studentUpdate())
            {
                Application::$app->response->redirect('/userList');
                exit;
            }
            $this->setLayout('main');
            return $this->render('changeInfo', ['model' => $student]);      
        }
        $this->setLayout('main');
        return $this->render('changeInfo',  ['model' => $student]);
    }

    public function delete(Request $request){
        $student = new ChangeModel();
        if(!RegisterModel::findOne(['fullname' => Application::$app->fullname])->Admin === 1){
            throw new UnauthorityException();
            exit(); 
         }
        if ($request->isPost())
        {   
            $student->LoadData($request->getBody());
            if ($student->studentDelete())
            {
                Application::$app->session->setFlash('success', 'Delete student successfully!');
                Application::$app->response->redirect('/userList');
                exit;
            }
            $this->setLayout('main');
            return $this->render('delete', ['model' => $student]);      
        }
        $this->setLayout('main');
        return $this->render('delete',  ['model' => $student]);
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

    public function upload()
    {
        return $this->render('upload');
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
        return $this->render('profile');
    }

    public function gameplay()
    {
        return $this->render('gameplay');
    }
}