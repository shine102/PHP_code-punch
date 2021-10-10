<?php

    namespace app\core;

use Response;
include ("Response.php");

class Application{

        public static string $ROOT_DIR;
        public Router $router;
        public Request $request;
        public Response $response;
        public static Application $app;

        public function __construct($rootpath){
            self::$ROOT_DIR = $rootpath;
            self::$app = $this; 
            $this->request = new Request();
            $this->response = new Response();
            $this->router = new Router($this->request, $this->response);
        }

        public function run(){
            $this->router->resolve();
        }
    }