<?php
    namespace app\core\exception;
    class heckerException extends \Exception{

        protected $message = 'It seem that you are trying to bypass our website, so get the result hehe';
        protected $code = 400; 
    }
?>