<?php
namespace app\models;
use app\core\Model;

class RegisterModel extends Model{
    public string $fullname = '';
    public string $email = '';
    public string $number = '';
    public string $password = '';
    public string $username = '';
    public string $passwordConfirm = '';

    public function register(){
        echo "Creating new student";
    }

    public function rules(): array
    {
        return [
            'fullname' => [],
            'email' => [self::RULE_EMAIL],
            'number' => [[self::RULE_MIN, 'min' => 10]],
            'password' => [[self::RULE_MIN, 'min' => 8]],
            'passwordConfirm' => [[self::RULE_MATCH,'match' => 'password']],
            'username' => [],
        ];
    }
}



?>