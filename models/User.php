<?php
class User {

    private $login;
    private $hashed_password;

    public function __construct($login, $hashed_password)
    {
        $this->login = $login;
        $this->hashed_password = $hashed_password;
    }

    public function setUser() {
    
        $query = Dbh_static::$connection->prepare('INSERT INTO users (login, hashed_password) VALUES (?, ?);');
        $query->execute(array($this->login, $this->hashed_password));
        $query = null;
    }

    public static function getUserByLogin($login) {
    
        $query = Dbh_static::$connection->prepare('SELECT * FROM users WHERE login = ?;');
        $query->execute(array($login));
        $result = $query->fetch(PDO::FETCH_ASSOC);
        $query = null;

        return $result;
    }

}