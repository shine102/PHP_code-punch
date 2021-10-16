<?php

namespace app\core;

use app\models\RegisterModel;

class Application{
        public string $userClass;
        public static string $ROOT_DIR;
        public Router $router;
        public Request $request;
        public Response $response;
        public static Application $app;
        public ?Controller $controller = null;
        public Database $db;
        public Session $session;
        public ?DbModel $user;
        public string $layout = 'main';
        public View $view;
        public string $fullname;


        public function getController(){
            return $this->controller;
        }
        public function setController(Controller $controller):void
        {
            $this->controller = $controller;
        }

        public function __construct($rootpath, array $config){
            self::$ROOT_DIR = $rootpath;
            self::$app = $this; 
            $this->request = new Request();
            $this->response = new Response();
            $this->session = new Session();
            $this->router = new Router($this->request, $this->response);
            $this->view = new View();

            $this->db = new Database($config['db']);
            $this->userClass = $config['userClass'];

            $primaryValue = $this->session->get('student');
            if ($primaryValue){
                $primaryKey = $this->userClass::primaryKey();
                $this->user = $this->userClass::findOne([$primaryKey => $primaryValue]);
            }
            else {
                $this->user = null;
            }
        }

        public function run(){
            try {
                echo $this->router->resolve();
            }
            catch(\Exception $e){
                $this->response->statusCode($e->getCode());
                echo $this->view->renderView('error', [
                    'exception' => $e
                ]);
            }
        }

        public function login(DbModel $user )
        {
            $this->user = $user;
            $primaryKey = $user->primaryKey();
            $primaryValue = $user->{$primaryKey};
            $this->session->set('student', $primaryValue);
            return true;
        }

        public function logout()
        {
            $this->user = null;
            $this->session->remove('student');
        }

        public static function isGuest()
        {
            return !self::$app->user;
        }

        public static function isTeacher()
        {
            Application::$app->fullname = Application::$app->user->getDisplayName();
            if (RegisterModel::findOne(['fullname' => Application::$app->fullname])->Admin === 1){
                return true;
            }    
            else {
                return false;
            }
        }
    }
