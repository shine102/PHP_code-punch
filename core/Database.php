<?php
    namespace app\core;
    class Database
    {
        public \PDO $pdo;
        public function __construct(array $config)
        {   
            $dsn = $config['dsn'] ?? '';
            $user = $config['user'] ?? '';
            $pass = $config['password'] ?? '';
            $this->pdo = new \PDO($dsn, $user, $pass);
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }


        public function getData($data, $table)
        {
            $statement = $this->pdo->prepare("select $data from $table");
            $statement->execute();
            return $statement->fetchAll(\PDO::FETCH_COLUMN);
        }

        public function preprare($sql)
        {
            return $this->pdo->prepare($sql);
        }
    }

?>