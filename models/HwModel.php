<?php
namespace app\models;

use app\core\Application;
use app\core\DbModel;
use app\core\exception\ForbiddenException;

class HwModel extends DbModel{
    public string $name = '';
    public string $author = '';

    public function tableName(): string
    {
        return 'homework';
    }

    public function attributes(): array
    {
        return ['name', 'author'];   
    }

    public function getDisplayName() : string
    {
        return $this->name;
    }

    public function labels() : array
    {
        return [
            'name' => 'Homework name'
        ];
    }

    public function rules() :array
    {
        return [];
    }

    public function getUsername(): string
    {
        return $this->author;
    }
    
    public function homeworkDelete()
    {
        $key = 'name';
        $value = $_GET['name'];
        if(Application::isTeacher()){
            
            if (unlink(__DIR__ . "/../public/homework/given/". $value)){
                return parent::delete($key, $value);
            }
            else {
                var_dump('cant do this');
            }
            
        }
        else {
            throw new ForbiddenException();
        }

    }
}