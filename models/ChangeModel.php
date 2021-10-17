<?php
namespace app\models;

use app\core\Application;
use app\core\DbModel;

class ChangeModel extends DbModel{
    
    public string $fullname = '';
    public string $email = '';
    public string $number = '';
    public string $password = '';
    public string $username = '';
    public string $passwordConfirm = '';

    public function __construct()
    {
        if (!Application::$app->isTeacher()){
            $this->fullname = Application::$app->user->getDisplayName();
            $this->username = Application::$app->user->getUsername();
        }
    }

    public function tableName(): string
    {
        return 'student';
    }

    public function rules(): array
    {
        return [
            'fullname' => [],
            'email' => [self::RULE_EMAIL],
            'number' => [[self::RULE_MIN, 'min' => 10], [self::RULE_MAX, 'max' => 10]],
            'password' => [[self::RULE_MIN, 'min' => 10]],
            'passwordConfirm' => [[self::RULE_MATCH,'match' => 'password']],
            'username' => [],
        ];
    }

    public function attributes(): array
    {
        return ['fullname', 'email','username','number', 'password'];
    }

    public function labels() :array
    {
        return [
            'fullname' => 'Fullname',
            'email' => 'Email',
            'number' => 'Phone Number',
            'username' => 'Username',
            'password' => 'Password',
            'passwordConfirm' => 'Confirm the Password'
        ];
    }

    public function primaryKey() : string
    {
        return 'fullname';
    }

    public function getDisplayName(): string
    {
        return $this->fullname;
    }

    public function getUsername(): string
    {
        return $this->username;
    }


    public function studentUpdate()
    {
        $key = 'username';
        $value = $this->username;
        
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        if (parent::findOne(['username' => $this->username])){
            return parent::update($key, $value);
        }
        }

    public function studentDelete(){
        $key = 'username';
        $value = $this->username;
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        if (parent::findOne(['username' => $this->username])){
            return parent::delete($key, $value);
        }
    }
}



?>