<?php
namespace app\models;

use app\core\Application;
use app\core\Model;


class Login extends Model
{
    public string $username = '';
    public string $password = '';

    public function rules(): array
    {
        return [
            'username' => [],
            'password' => []
        ];
    }

    public function login()
    {
        $user = RegisterModel::findOne(['username' => $this->username]);
        if(!$user){
            $this->addErrorLogin('username', 'User does not exist!');
            return false;
        }
        if (!password_verify($this->password, $user->password)){
            $this->addErrorLogin('password', 'Password is incorrect!');
            return false;
        }

        return Application::$app->login($user);
    }

    public function labels(): array
    {
        return [
            'username' => 'Enter the username',
            'password' => 'Enter the password'
        ];
    }
}