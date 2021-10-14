<?php
namespace app\models;
use app\core\DbModel;

class RegisterModel extends DbModel{

    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_DELETED = 2;

    public int $status = self::STATUS_INACTIVE;
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

    public function save()
    {
        $this->status = self::STATUS_INACTIVE;
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        return parent::save();
    }

    public function register(){

        echo "Creating new student";
        return $this->save();
    }

    public function rules(): array
    {
        return [
            'fullname' => [[
                self::RULE_UNIQUE, 'class' => self::class, 
                'attribute' => 'fullname'
            ]],
            'email' => [self::RULE_EMAIL],
            'number' => [[self::RULE_MIN, 'min' => 10]],
            'password' => [[self::RULE_MIN, 'min' => 8]],
            'passwordConfirm' => [[self::RULE_MATCH,'match' => 'password']],
            'username' => [],
        ];
    }

    public function attributes(): array
    {
        return ['fullname', 'email', 'number', 'username', 'password', 'status'];
    }
}



?>