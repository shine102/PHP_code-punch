<?php
    namespace app\core;


use app\core\Application;


abstract class DbModel extends Model
    {
        abstract public function tableName() : string;
        
        abstract public function attributes() : array;

        abstract public function getDisplayName() : string;

        abstract public function getUsername() :string;

        public static function primaryKey(){
            return 'Id';
        }

        public function save(){
            $tableName = $this->tableName();
            $attributes = $this->attributes();
            $params = array_map(fn($attr) => ":$attr", $attributes);
            
            $statement = self::prepare("INSERT INTO $tableName (".implode(',', $attributes).") 
                                        VALUES(".implode(',', $params).")");
            foreach ($attributes as $attribute){
                $statement->bindValue(":$attribute", $this->{$attribute});
            }
            $statement->execute();
            return true;
        }

        public function update($key, $value){
            $tableName = $this->tableName();
            $attributes = $this->attributes();
            $params = array_map(fn($attr) => "$attr", $attributes);
            $statement = "UPDATE $tableName SET ";
            $i = 0;
            foreach ($attributes as $attribute){
                $thing = (string)$this->{$attribute};
                $statement = $statement . $params[$i] ." = '$thing'";
                $i++;
                if ($i<count($attributes)){
                    $statement = $statement . ",";
                }
                
            }
            $statement = $statement . " WHERE $key = '$value'";
            $statement = self::prepare($statement);
            foreach ($attributes as $attribute) {
                $statement->bindParam(":$attribute", $this->{$attribute});
            }
            $statement->execute();
            return true;
        }

        public function delete($key, $value)
        {
            $tableName = 'student';
            Application::$app->fullname = Application::$app->user->getDisplayName();
            $statement = self::prepare("DELETE FROM $tableName WHERE $key = '$value' ");
            $statement->execute();
            return true;
        }

        public static function prepare($sql){
            return Application::$app->db->pdo->prepare($sql);
        }

        public static function findOne($where)
        {
            $tableName = 'student';
            $attributes = array_keys($where);
            $sql = implode("AND ", array_map(fn($attr) => "$attr = :$attr", $attributes));
            $statement = self::prepare("SELECT * FROM $tableName WHERE $sql");
            foreach ($where as $key => $item){
                $statement->bindValue(":$key", $item);
            }
            $statement->execute();
            return $statement->fetchObject(static::class);
        }

        public static function checkAdmin($key, $value)
        {
            $tableName = 'student';
            $statement = self::prepare("SELECT admin FROM $tableName WHERE $key = '$value' ");
            $statement->execute();
            if($statement->fetchAll()[0][0] == 1){
                return false;
            }
            else {
                return true;
            }
        }
      
    }
?>
