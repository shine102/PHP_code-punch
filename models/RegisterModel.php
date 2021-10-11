<?php
namespace app\models;
use app\core\Model;

class RegisterModel extends Model{
    public string $fullname;
    public string $email;
    public string $number;
    public string $password;
    public string $username;
    public string $passwordConfirm;

    public function register(){
        echo "Creating new student";
    }

    public function rule(): array
    {
        return [
            
        ];
    }
}



?>