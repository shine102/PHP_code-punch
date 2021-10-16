<?php 
    namespace app\models;

use app\core\DbModel;

class ChatModel extends DbModel{
        
        public string $sender = '';
        public array $message = '';

        public function tableName(): string
        {
            return 'message';
        }
        
        public function save()
        {
            return parent::save();
        }

        public function update($key, $value)
        {
            $key = ChatModel::primaryKey();
            $value = $this->sender;
            return parent::update($key, $value);
        }

        public function rules() :array
        {
            return [];
        }

        public function attributes(): array
        {
            return ['message'];
        }

        public function primaryKey() : string
        {
            return 'sender';
        }
    
        public function getDisplayName(): string
        {
            return $this->sender;
        }
    } 