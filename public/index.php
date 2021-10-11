<?php 
    require_once __DIR__.'/../vendor/autoload.php';

use app\controllers\SiteController;
use app\controllers\AuthController; 
use app\core\Application;

    $app = new Application(dirname(__DIR__));

    $app->router->get('/', [SiteController::class, 'home']);

    $app->router->get('/login', [AuthController::class, 'login']);

    $app->router->post('/login', [AuthController::class, 'handleLogin']);

    $app->router->get('/register', [AuthController::class, 'register']);

    $app->router->post('/register', [AuthController::class, 'register']);

    $app->router->get('/teacher', [SiteController::class, 'teacher']);

    $app->router->get('/student', [SiteController::class, 'student']);
    
    $app->run();

