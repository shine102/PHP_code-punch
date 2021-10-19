<?php
    namespace app\core\exception;
    class NoUserException extends \Exception{

        protected $message = 'There is no one who got that username';
        protected $code = 656; 
    }
?>