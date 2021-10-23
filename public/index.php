<?php 
    require_once __DIR__.'/../vendor/autoload.php';

use app\controllers\SiteController; 
use app\core\Application;
use app\models\RegisterModel;

$config = [
        'userClass' => RegisterModel::class,
        'db' => [
                'dsn' => 'mysql:host=sql6.freemysqlhosting.net;dbname=sql6445102',
                'user' => 'sql6445102',
                'password' => 't7JZbAcjpP'
            ]
        ];

    $app = new Application(dirname(__DIR__), $config);

    $app->router->get('/', [SiteController::class, 'home']);

    $app->router->get('/hwdelete', [SiteController::class, 'hwdelete']);

    $app->router->get('/login', [SiteController::class, 'login']);

    $app->router->post('/login', [SiteController::class, 'login']);

    $app->router->get('/upload', [SiteController::class, 'upload']);

    $app->router->post('/upload', [SiteController::class, 'upload']);

    $app->router->get('/logout', [SiteController::class, 'logout']);

    $app->router->get('/register', [SiteController::class, 'register']);

    $app->router->post('/register', [SiteController::class, 'register']);

    $app->router->get('/userlist', [SiteController::class, 'userList']);

    $app->router->get('/homeworkgive', [SiteController::class, 'homeworkgive']);

    $app->router->post('/homeworkgive', [SiteController::class, 'homeworkgive']);

    $app->router->get('/gameplay', [SiteController::class, 'gameplay']);
    
    $app->router->post('/gameplay', [SiteController::class, 'gameplay']);

    $app->router->get('/profile', [SiteController::class, 'profile']);
    
    $app->router->post('/profile', [SiteController::class, 'profile']);

    $app->router->get('/about', [SiteController::class, 'about']);

    $app->router->get('/changeInfo', [SiteController::class, 'changeInfo']);
    
    $app->router->post('/changeInfo', [SiteController::class, 'changeInfo']);

    $app->router->get('/delete', [SiteController::class, 'delete']);
    
    $app->router->post('/delete', [SiteController::class, 'delete']);
    
    
    $app->run();

