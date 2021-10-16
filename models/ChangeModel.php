<?php
namespace app\models;

use app\core\DbModel;

class ChangeModel extends DbModel{
    public string $fullname = '';
    public string $email = '';
    public string $number = '';
    public string $password = '';
    public string $username = '';
    public string $passwordConfirm = '';


    public function tableName(): string
    {
        return 'student';
    }

    public function rules(): array
    {
        return [
            'fullname' => [[
                self::RULE_UNIQUE, 'class' => self::class, 
                'attribute' => 'fullname'
            ]],
            'email' => [self::RULE_EMAIL],
            'number' => [[self::RULE_MIN, 'min' => 10], [self::RULE_MAX, 'max' => 10]],
            'password' => [[self::RULE_MIN, 'min' => 10]],
            'passwordConfirm' => [[self::RULE_MATCH,'match' => 'password']],
            'username' => [],
        ];
    }

    public function attributes(): array
    {
        return ['fullname', 'email', 'number', 'username', 'password'];
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

    public function studentUpdate($key, $value)
    {
        $key = 'fullname';
        $value = $this->fullname;
        $fullname = $this->fullname;
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        if (parent::findOne(['fullname' => $this->fullname])){
            parent::update($key, $value);
        }
    }
}



?>