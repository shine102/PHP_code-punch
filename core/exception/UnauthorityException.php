<?php
    namespace app\core\exception;
    class UnauthorityException extends \Exception{

        protected $message = 'You don\'t have permission to do this... btw, check the title';
        protected $code = 666; 
    }
?>