<?php

namespace app\core;

use app\core\Application;
class Controllers
{
    public function render($view, $params = []){
        return Application::$app->router->renderView($view, $params);
    }
}