<?php 
    require_once __DIR__.'/../vendor/autoload.php';

use app\controllers\SiteController;
use app\core\Application;

    $app = new Application(dirname(__DIR__));

    $app->router->get('/', [SiteController::class, 'home']);

    $app->router->get('/teacher', [SiteController::class, 'Teacher']);

    $app->router->get('/student', 'student');
    
    $app->router->post('/student', [SiteController::class, 'handleStudent']);
    
    $app->run();

