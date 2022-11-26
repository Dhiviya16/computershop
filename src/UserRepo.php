<?php

namespace App;

class UserRepo
{
    protected $pdo;

    protected function getPdo(): \PDO
    {
        if ($this->pdo === null) {
            $options = [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            ];

            try {
                $this->pdo = new \PDO(
                    "mysql:host=localhost;dbname=shop_db;charset=utf8mb4",
                    'root',
                    '',
                    $options
                );
            } catch (\PDOException $PDOException) {
                throw new \PDOException($PDOException->getMessage(), (int) $PDOException->getCode());
            }
        }
        return $this->pdo;
    }

    public function loginUser($email, $pass)
    {
        if (empty($email) || empty($pass)) {
            return false;
        } else {
            return $this->getPdo()->prepare('SELECT * FROM users WHERE email= \'$email\' 
                                              AND password=\'$pass\'')
                                  ->fetchAll(\PDO::FETCH_ASSOC);
        }
    }

  

    /**
         * Fetch an array of users from the database
     *
     * @return array
     */
    public function fetchUsers(): array
    {
        return $this->getPdo()->prepare('SELECT * FROM users')
            ->fetchAll(\PDO::FETCH_ASSOC);
    }

   
    public function validateUserIsArray()
    {
        $addUser = array("id" => 16, "name" => "test", "email" => "test@gmail.com",
            "password" => "testing","user_type" => "user");
        if (is_array($addUser)) {
            return true;
        } else {
            return false;
        }
    }
}

   