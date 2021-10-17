<?php 
    namespace app\models;

use app\core\DbModel;

class ChatModel extends DbModel{
        
        public string $sender = '';
        public string $message = '';

        public function tableName(): string
        {
            return 'message';
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

        public function getUsername(): string
        {
        return $this->username;
        }
    } 