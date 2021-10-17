<?php
    namespace app\core\exception;
    class UnauthorityException extends \Exception{

        protected $message = 'You don\'t have permission to change info of this user... btw, check the title';
        protected $code = 666; 
    }
?>